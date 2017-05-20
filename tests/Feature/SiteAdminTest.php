<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SiteAdminTest extends TestCase
{
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
     * Test can not open site
     *
     * @dataProvider disallowedSiteDomainsProvider
     * @return void
     */
    public function testCanNotOpenSiteAdminPanel($hostname)
    {
        $response = $this->get("http://{$hostname}/");

        $response->assertStatus(400);
        $response->assertSee("Domain not allowed");
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

    /**
     * Disallowed site domains provider
     *
     * @return array
     */
    public function disallowedSiteDomainsProvider()
    {
        return [[
                'disallowed-1-foo.com'
            ], [
                'disallowed-2-bar.com'
            ], [
                'disallowed-3-baz.com'
            ],
        ];
    }
}
