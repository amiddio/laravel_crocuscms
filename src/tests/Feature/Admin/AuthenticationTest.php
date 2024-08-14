<?php

namespace Tests\Feature\Admin;

use App\Models\Admin\Admin;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    private static string $adminPrefix = '';

    public function setUp(): void
    {
        parent::setUp();

        self::$adminPrefix = config('admin.admin_panel_prefix');
    }

    public function testLoginScreenCanBeRendered(): void
    {
        $response = $this->get(self::$adminPrefix . '/login');

        $response->assertStatus(200);
    }

    public function testAdminCanAuthenticateUsingLoginScreen(): void
    {
        $admin = Admin::factory()->create();

        $response = $this->post(self::$adminPrefix . '/login', [
            'login' => $admin->login,
            'password' => 'Qwerty#2024$',
            'remember' => 1,
        ]);

        $this->assertAuthenticated(guard: 'admin');
        $response->assertRedirect(route('admin.dashboard'));
    }

    public function testAdminCanNotAuthenticateWithInvalidPassword(): void
    {
        $admin = Admin::factory()->create();

        $response = $this->post(self::$adminPrefix . '/login', [
            'login' => $admin->login,
            'password' => 'wrong-password',
            'remember' => 1,
        ]);

        $this->assertGuest(guard: 'admin');
    }

    public function testAdminCanLogout(): void
    {
        $admin = Admin::factory()->create();

        $response = $this->actingAs($admin)->post(self::$adminPrefix . '/logout');

        $this->assertGuest(guard: 'admin');
        $response->assertRedirect(route('admin.login'));
    }

}
