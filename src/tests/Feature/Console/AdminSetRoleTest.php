<?php

namespace Tests\Feature\Console;

use App\Models\Admin\Admin;
use App\Models\Admin\AdminRole;
use Database\Factories\Admin\AdminFactory;
use Database\Factories\Admin\AdminRoleFactory;
use Database\Seeders\AdminRoleSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdminSetRoleTest extends TestCase
{

    private static string $command = 'admin:role';

    private static string $managerRole = 'Manager';

    public function setUp(): void
    {
        parent::setUp();

        $this->seed(AdminRoleSeeder::class);

        AdminRoleFactory::new()->create([
            'name' => self::$managerRole,
        ]);

        AdminFactory::new()->create([
            'name' => 'John Dow',
            'login' => 'sadmin',
            'password' => 'Qwerty#2024$',
            'is_active' => true,
            'admin_role_id' => null,
        ]);
    }

    public function testAdminSetRoleSuccess(): void
    {
        $this->artisan(self::$command)
            ->expectsQuestion(__('Enter login'), 'sadmin')
            ->expectsQuestion(__('Choose admin Role'), config('admin.super_admin_role_name'))
            ->expectsOutput(__('Successfully assigned a role \':role\' to admin \':admin\'',
                ['role' => config('admin.super_admin_role_name'), 'admin' => 'sadmin'])
            )
            ->assertExitCode(1);

        $this->assertDatabaseHas('admins',
            ['login' => 'sadmin', 'admin_role_id' => AdminRole::where('name', config('admin.super_admin_role_name'))->value('id')]
        );
    }

    public function testAdminSetSecondRoleSuccess(): void
    {
        $this->artisan(self::$command)
            ->expectsQuestion(__('Enter login'), 'sadmin')
            ->expectsQuestion(__('Choose admin Role'), self::$managerRole)
            ->expectsOutput(__('Successfully assigned a role \':role\' to admin \':admin\'',
                    ['role' => self::$managerRole, 'admin' => 'sadmin'])
            )
            ->assertExitCode(1);

        $this->assertDatabaseHas('admins',
            ['login' => 'sadmin', 'admin_role_id' => AdminRole::where('name', self::$managerRole)->value('id')]
        );
    }

    public function testRoleNotExist(): void
    {
        $this->artisan(self::$command)
            ->expectsQuestion(__('Enter login'), 'sadmin')
            ->expectsQuestion(__('Choose admin Role'), 'Notexist')
            ->expectsOutput(__('Admin role \':role\' not found', ['role' => 'Notexist']))
            ->assertExitCode(0);

        $this->assertDatabaseHas('admins', ['login' => 'sadmin', 'admin_role_id' => null]);
    }

}
