<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\DB;
use RuntimeException;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, CreatesApplicationSchema;

    protected function setUp(): void
    {
        parent::setUp();

        // .env points at a shared database, which the tests must never write to.
        if (DB::connection()->getDriverName() !== 'sqlite') {
            throw new RuntimeException('The tests only run on the in-memory sqlite database from phpunit.xml.');
        }

        $this->createApplicationSchema();
    }
}
