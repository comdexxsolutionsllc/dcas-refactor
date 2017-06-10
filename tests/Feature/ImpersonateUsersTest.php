<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ImpersonateUsersTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions;

    /** @test */
    public function non_admins_cannot_impersonate_users()
    {
        $user = factory('App\User')->create();

        $this->get(route('impersonate', $user))->assertRedirect('login');

        $this->actingAs($user)->get(route('impersonate', $user))->assertStatus(403);
    }

    /** @test */
    public function admins_can_impersonate_users()
    {
        $admin = factory('App\User')->states('admin')->create();
        $user = factory('App\User')->create();

        $this->actingAs($admin)->get(route('impersonate', $user));

        $this->assertEquals(auth()->user()->id, $user->id);
    }

    /** @test */
    public function admins_can_unimpersonate_users()
    {
        $admin = factory('App\User')->states('admin')->create();
        $user = factory('App\User')->create();

        $this->actingAs($admin)->get(route('impersonate', $user));
        $this->get(route('fallbackOriginalAccount', $user));

        $this->assertEquals(auth()->user()->id, $admin->id);
    }
}
