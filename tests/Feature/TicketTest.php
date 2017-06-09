<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TicketTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions, WithoutMiddleware;

    protected $path = '/internal/tickets/';

    /** @test */
    public function it_has_a_valid_route()
    {
        $this->get($this->path)
             ->assertStatus(200)
             ->assertSee('New Ticket Index page.');
    }
}
