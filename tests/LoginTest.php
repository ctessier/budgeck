<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LoginTest extends TestCase
{
    /**
     * @var Budgeck\Models\User
     */
    private $user;

    /**
     * Setup login tests.
     */
    public function setUp()
    {
        parent::setUp();

        $this->user = factory(Budgeck\Models\User::class)->create();
        factory(Budgeck\Models\Account::class)->create([
            'is_default' => true,
            'user_id'    => $this->user->id,
        ]);
    }
    /**
     * Test login.
     *
     * @return void
     */
    public function testLogin()
    {
        $this->call('GET', '/');
        $this->assertRedirectedToRoute('login');

        $this->be($this->user);

        $this->call('GET', '/');
        $this->assertRedirectedToRoute('history');
    }
}
