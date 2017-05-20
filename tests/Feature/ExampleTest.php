<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExampleTest extends TestCase
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

    /**
     * Test open site admin panel
     *
     * @dataProvider siteDomainsProvider
     * @return void
     */
    public function testOpenSiteAdminPanel($hostname)
    {
        $response = $this->get("http://{$hostname}/manager");

        $response->assertStatus(200);
        $response->assertSee("Admin panel of site {$hostname}");
    }

    /**
     * Test open site
     *
     * @dataProvider siteDomainsProvider
     * @return void
     */
    public function testOpenSite($hostname)
    {
        $response = $this->get("http://{$hostname}.com/");

        $response->assertStatus(200);
        $response->assertSee("Site {$hostname}");
    }

    /**
     * Site domains provider
     *
     * @return array
     */
    public function siteDomainsProvider()
    {
        return [[
                'site-1-foo.com'
            ], [
                'site-2-bar.com'
            ], [
                'site-3-baz.com'
            ],
        ];
    }
}
