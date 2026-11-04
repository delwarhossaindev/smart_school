<?php

namespace Tests\Feature;

use App\Legacy\Database\Builder;
use Tests\TestCase;

class LegacyApplicationTest extends TestCase
{
    public function test_login_page_renders_with_and_without_the_url_suffix(): void
    {
        foreach (['/auth/login', '/auth/login.html'] as $uri) {
            $this->get($uri)->assertOk()->assertSee('id="login"', false);
        }
    }

    public function test_protected_page_redirects_guests_to_login(): void
    {
        $this->get('/academic/classes/index.html')
            ->assertStatus(307)
            ->assertRedirectContains('auth/login.html');
    }

    public function test_extra_segments_are_routed_to_the_controller_action(): void
    {
        $route = app('router')->getRoutes()->match(request()->create('/academic/classes/index/5'));

        $this->assertSame('5', $route->parameter('args'));
        $this->assertSame('index', $route->defaults['_ci']['method']);
    }

    public function test_custom_routes_shadow_controller_routes(): void
    {
        $route = app('router')->getRoutes()->match(request()->create('/dashboard'));

        $this->assertSame('web', $route->defaults['_ci']['module']);
    }

    public function test_unknown_page_returns_404(): void
    {
        $this->get('/academic/nosuchcontroller/index')->assertNotFound();
    }

    public function test_a_method_named_like_a_controller_is_not_routable_under_the_module(): void
    {
        $this->get('/assignment/assignment/1')->assertNotFound();
    }

    public function test_builder_compiles_select_like_codeigniter(): void
    {
        $sql = (new Builder())
            ->select('S.*, C.name AS class_name')
            ->from('students AS S')
            ->join('classes AS C', 'C.id = S.class_id', 'left')
            ->where('S.status', 1)
            ->where('S.age >', 5)
            ->where('S.deleted IS NULL')
            ->like('S.name', 'a_b')
            ->order_by('S.id', 'DESC')
            ->limit(10, 20)
            ->get_compiled_select();

        $this->assertSame(
            "SELECT `S`.*, `C`.`name` AS `class_name`\n"
            ."FROM `students` AS `S`\n"
            ."LEFT JOIN `classes` AS `C` ON `C`.`id` = `S`.`class_id`\n"
            ."WHERE `S`.`status` = 1\n"
            ."AND `S`.`age` > 5\n"
            ."AND S.deleted IS NULL\n"
            ."AND `S`.`name` LIKE '%a!_b%' ESCAPE '!'\n"
            ."ORDER BY `S`.`id` DESC\n"
            .'LIMIT 20, 10',
            $sql
        );
    }

    public function test_builder_returns_false_instead_of_throwing_on_a_failed_query(): void
    {
        $this->assertFalse((new Builder())->get('no_such_table'));
    }
}
