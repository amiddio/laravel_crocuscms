<?php

namespace Tests\Feature\Console;

use Database\Factories\Admin\AdminFactory;
use Tests\TestCase;

class AdminCreateTest extends TestCase
{
    private static string $command = 'admin:create';

    public function setUp(): void
    {
        parent::setUp();

        AdminFactory::new()->create([
            'name' => 'John Dow',
            'login' => 'sadmin',
            'password' => 'Qwerty#2024$',
            'is_active' => true,
        ]);
    }

    public function testAdminSuccessCreated(): void
    {
        $this->artisan(self::$command)
            ->expectsQuestion(__('Enter admin name [press \'Enter\' to leave blank]'), 'Alex')
            ->expectsQuestion(__('Enter admin login'), 'admin')
            ->expectsQuestion(__('Enter admin password'), 'Qwerty#2021$')
            ->expectsQuestion(__('Repeat password'), 'Qwerty#2021$')
            ->expectsOutput(__('Admin created successfully!'))
            ->assertExitCode(1);

        $this->assertDatabaseHas('admins', ['login' => 'admin']);
    }

    public function testAdminLoginFieldValidation(): void
    {
        $this->artisan(self::$command)
            ->expectsQuestion(__('Enter admin name [press \'Enter\' to leave blank]'), '')
            ->expectsQuestion(__('Enter admin login'), '')
            ->expectsOutput(__('The login is required.'))
            ->expectsQuestion(__('Enter admin login'), 'qa')
            ->expectsOutput(__('The login must be at least 3 characters long.'))
            ->expectsQuestion(__('Enter admin login'), 'qwertyuiopasdfghjklzxcvbnmqwert')
            ->expectsOutput(__('The login must not be greater than 30 characters.'))
            ->expectsQuestion(__('Enter admin login'), 'Admin')
            ->expectsOutput(__('The login must be lowercase.'))
            ->expectsQuestion(__('Enter admin login'), 'sadmin')
            ->expectsOutput(__('The entered login already registered.'))
            ->expectsQuestion(__('Enter admin login'), 'admin')
            ->expectsQuestion(__('Enter admin password'), 'Qwerty#2021$')
            ->expectsQuestion(__('Repeat password'), 'Qwerty#2021$')
            ->expectsOutput(__('Admin created successfully!'))
            ->assertExitCode(1);

        $this->assertDatabaseHas('admins', ['login' => 'admin']);
    }

    public function testAdminPasswordFieldValidation(): void
    {
        $this->artisan(self::$command)
            ->expectsQuestion(__('Enter admin name [press \'Enter\' to leave blank]'), 'Admin')
            ->expectsQuestion(__('Enter admin login'), 'admin')
            ->expectsQuestion(__('Enter admin password'), '')
            ->expectsOutput(__('The password is required.'))
            ->expectsQuestion(__('Enter admin password'), 'Qwerty#2021$')
            ->expectsQuestion(__('Repeat password'), '')
            ->expectsOutput(__('The repeat password is required.'))
            ->expectsQuestion(__('Repeat password'), 'Qwerty#2021$$')
            ->expectsOutput(__('The entered passwords must match.'))
            ->expectsQuestion(__('Repeat password'), 'Qwerty#2021$')
            ->expectsOutput(__('Admin created successfully!'))
            ->assertExitCode(1);

        $this->assertDatabaseHas('admins', ['login' => 'admin']);
    }

}
