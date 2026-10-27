<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class FrameworkSchemaTest extends TestCase
{
    use RefreshDatabase;

    /**
     * The framework tables are required when the matching drivers are selected
     * (Laravel 11+ defaults to the "database" cache, session and queue stores).
     * A missing "cache" table used to break the spatie permission migration
     * with "Base table or view not found: 1146 Table 'research.cache' doesn't exist".
     *
     * @return array<int, array{0: string}>
     */
    public static function frameworkTableProvider(): array
    {
        return [
            ['cache'],
            ['cache_locks'],
            ['jobs'],
            ['job_batches'],
            ['failed_jobs'],
            ['sessions'],
            ['personal_access_tokens'],
            ['password_reset_tokens'],
        ];
    }

    #[DataProvider('frameworkTableProvider')]
    public function test_framework_tables_are_migrated(string $table): void
    {
        $this->assertTrue(Schema::hasTable($table), "Table [{$table}] is missing.");
    }

    public function test_database_cache_store_can_store_values(): void
    {
        $store = Cache::store('database');

        $store->put('research-portal-probe', 'ok', 60);

        $this->assertSame('ok', $store->get('research-portal-probe'));
    }
}
