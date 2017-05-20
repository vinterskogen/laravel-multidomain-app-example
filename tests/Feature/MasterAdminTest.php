<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class MasterAdminTest extends TestCase
{
    /**
     * Test open master admin panel
     *
     * @return void
     */
    public function testOpenMasterAdminPanel()
    {
        $hostname = 'master.foobar.com';
        $response = $this->get("http://{$hostname}/");

        $response->assertStatus(200);
        $response->assertSee('Master admin panel');
    }
}
