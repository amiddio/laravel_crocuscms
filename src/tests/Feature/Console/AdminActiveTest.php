<?php

namespace Tests\Feature\Console;

use Database\Factories\Admin\AdminFactory;
use Tests\TestCase;

class AdminActiveTest extends TestCase
{
    private static string $command = 'admin:active';

    private static string $login = 'sadmin';

    public function setUp(): void
    {
        parent::setUp();

        AdminFactory::new()->create([
            'name' => 'John Dow',
            'login' => self::$login,
            'password' => 'Qwerty#2024$',
            'is_active' => true,
        ]);
    }

    public function testSetAdminToInactive(): void
    {
        $this->artisan(self::$command)
            ->expectsQuestion(__('Enter login'), self::$login)
            ->expectsQuestion(__('Set \':admin\' to active or inactive?', ['admin' => self::$login]), 2)
            ->expectsOutput(
                __('Set \':admin\' to :status successfully!', ['admin' => self::$login, 'status' => 'inactive'])
            )
            ->assertExitCode(1);

        $this->assertDatabaseHas('admins', ['login' => self::$login, 'is_active' => false]);
    }

    public function testSetAdminToActive(): void
    {
        $this->artisan(self::$command)
            ->expectsQuestion(__('Enter login'), self::$login)
            ->expectsQuestion(__('Set \':admin\' to active or inactive?', ['admin' => self::$login]), 1)
            ->expectsOutput(
                __('Set \':admin\' to :status successfully!', ['admin' => self::$login, 'status' => 'active'])
            )
            ->assertExitCode(1);

        $this->assertDatabaseHas('admins', ['login' => self::$login, 'is_active' => true]);
    }

    public function testAdminNotExists(): void
    {
        $this->artisan(self::$command)
            ->expectsQuestion(__('Enter login'), 'admin')
            ->expectsOutput(__('Entered login does not exist.'))
            ->assertExitCode(0);
    }
}
