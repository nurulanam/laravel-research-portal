<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\backend\AuthorizeCustomer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\backend\ProjectController;

class CustomerProfileController extends Controller
{
    public $user_id;
    public function __construct()
    {
        $this->user_id = Auth::id();
    }

    public function store(Request $request)
    {
        $request->validate([
            'card_number' => 'required|numeric|regex:/^\d{13,19}$/',
            'expiration_year' => 'required|numeric|digits:4',
            'expiration_month' => 'required|numeric|between:1,12',
            'cvv' => 'required|numeric|digits_between:3,4',
        ]);
        $expiration_date = $request->expiration_year.'-'.$request->expiration_month;
        $userType = Auth::user()->getRoleNames();

        $customer_profile = ProjectController::createCustomerProfile($request->card_number, $expiration_date, $request->cvv, $userType[0]);
        if (($customer_profile != null) && ($customer_profile->getMessages()->getResultCode() == "Ok")) {

            $payment_profiles = $customer_profile->getCustomerPaymentProfileIdList();
            $profile_id = $customer_profile->getCustomerProfileId();
            $payment_id = $payment_profiles[0];
            $card_digit = substr($request->card_number, -4);

            $new_customer = new AuthorizeCustomer();
            $new_customer->user_id = Auth::id();
            $new_customer->profile_id = $profile_id;
            $new_customer->payment_id = $payment_id;
            $new_customer->card_digit = $card_digit;
            $new_customer->save();
            return redirect()->back()->with('success', 'Your card saved successfully');
        }elseif ($customer_profile->getMessages()->getResultCode() == "Error"){
            $errorMessages = $customer_profile->getMessages()->getMessage();
            return redirect()->back()->with('error', $errorMessages[0]->getText());
        }
        return redirect()->back()->with('error', 'Please recheck your card info');
    }

    public function update(Request $request)
    {
        $request->validate([
            'card_number' => 'required|numeric|regex:/^\d{13,19}$/',
            'expiration_year' => 'required|numeric|digits:4',
            'expiration_month' => 'required|numeric|between:1,12',
            'cvv' => 'required|numeric|digits_between:3,4',
        ]);
        $user_id = Auth::id();
        $expiration_date = $request->expiration_year.'-'.$request->expiration_month;
        $find_customer = ProjectController::checkCutomerProfile();
        if ($find_customer != null){
            $profile_id = $find_customer->profile_id;
            $payment_id = $find_customer->payment_id;
            $card_digit = substr($request->card_number, -4);

            $update_customer_profile = ProjectController::updateCustomerPaymentProfile($profile_id, $payment_id, $request->card_number, $expiration_date, $request->cvv);
            if (($update_customer_profile != null) && ($update_customer_profile->getMessages()->getResultCode() == "Ok") )
            {
                $update_customer = AuthorizeCustomer::where('user_id', '=', $user_id)->first();
                $update_customer->card_digit = $card_digit;
                $update_customer->update();

                return redirect()->back()->with('success', 'Your card info updated successfully');
            }elseif(($update_customer_profile == null) || $update_customer_profile->getMessages()->getResultCode() == "Error"){
                return redirect()->back()->with('error', 'Your card info not updated, please recheck.');
            }
        }else{
            return redirect()->back()->with('error', 'Don\'t have amy existing card');
        }
        return redirect()->back()->with('error', 'Please recheck your card info');
    }
}
