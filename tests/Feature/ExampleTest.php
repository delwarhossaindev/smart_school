<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * With the public website disabled, the home page leads to the login page.
     */
    public function test_the_home_page_redirects_to_login(): void
    {
        $this->get('/')->assertRedirect('/login');
    }

    public function test_old_addresses_lead_to_the_new_pages(): void
    {
        $this->get('/auth/login')->assertRedirect('/login');
        $this->get('/auth/forgot')->assertRedirect('/forgot-password');
        $this->get('/administrator/role/index')->assertRedirect('/administrator/roles');
        $this->get('/administrator/permission/index')->assertRedirect('/administrator/permissions');
    }
}
