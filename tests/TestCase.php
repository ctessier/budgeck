<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Artisan;

class TestCase extends Illuminate\Foundation\Testing\TestCase
{
    /**
     * The base URL to use while testing the application.
     *
     * @var string
     */
    protected $baseUrl = 'http://localhost';

    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__.'/../bootstrap/app.php';

        $app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

        return $app;
    }

    /**
     * Setup testing environment (run migrations and unguard models)
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        Artisan::call('migrate');
        Model::unguard();
    }

    /**
     * Tear down testing environment (reguard models and reset migrations)
     *
     * @return void
     */
    public function tearDown()
    {
        Model::reguard();
        Artisan::call('migrate:reset');
        parent::tearDown();
    }
}
