<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Route;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class RouteRegistrationTest extends TestCase
{
    /**
     * Every route name that the Blade templates link to must be registered,
     * otherwise the page throws a RouteNotFoundException.
     *
     * @return array<int, array{0: string}>
     */
    public static function routeNameProvider(): array
    {
        return array_map(fn (string $name) => [$name], [
            'dashboard.index',
            'profile.index',
            'profile.avatar',
            'profile.edit.contact',
            'profile.contact.details',
            'profile.edit.demographics',
            'profile.demographics',
            'profile.edit.employment',
            'profile.employment',
            'profile.edit.skill',
            'profile.store.skill',
            'project.index',
            'project.create',
            'project.store',
            'project.update',
            'project.edit',
            'project.preview',
            'project.participants',
            'project.participant.response',
            'project.delete',
            'project.invite',
            'project.reject',
            'project.send.zoom',
            'project.hire',
            'project.withdraw.response',
            'project.accept',
            'project.deny',
            'project.screener',
            'project-apply.index',
            'project-apply.store',
            'messages.index',
            'messages.store',
            'messages.show',
            'messages.refresh',
            'customer.profile.store',
            'customer.profile.update',
            'billing.index',
            'change-password.index',
            'change-password.store',
            'login',
            'register',
            'password.request',
            'password.email',
            'password.reset',
            'password.update',
            'logout',
            'verification.notice',
            'verification.verify',
            'verification.send',
            'password.confirm',
        ]);
    }

    #[DataProvider('routeNameProvider')]
    public function test_route_names_used_by_views_are_registered(string $name): void
    {
        $this->assertTrue(Route::has($name), "Route [{$name}] is not registered.");
    }
}
