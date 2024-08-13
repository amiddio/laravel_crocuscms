<?php

namespace Tests\Feature\Console;

use App\Repositories\Admin\AdminRepository;
use Database\Factories\Admin\AdminFactory;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AdminChangePasswordTest extends TestCase
{
    private static string $command = 'admin:password';

    private static string $login = 'sadmin';

    private AdminRepository $adminRepository;

    public function setUp(): void
    {
        parent::setUp();

        AdminFactory::new()->create([
            'name' => 'John Dow',
            'login' => self::$login,
            'password' => 'Qwerty#2024$',
            'is_active' => true,
        ]);

        $this->adminRepository = new AdminRepository();
    }

    public function testAdminChangePasswordTest(): void
    {
        $newPassword = 'Qwerty#2024$%';

        $this->artisan(self::$command)
            ->expectsQuestion(__('Enter login'), self::$login)
            ->expectsQuestion(__('Enter new password'), $newPassword)
            ->expectsQuestion(__('Repeat password'), $newPassword)
            ->expectsOutput(__('The password of \':admin\' updated successfully!', ['admin' => self::$login]))
            ->assertExitCode(1);

        $admin = $this->adminRepository->findByCondition('login', self::$login);

        $this->assertTrue(Hash::check($newPassword, $admin->password));
    }

    public function testAdminNotExists(): void
    {
        $this->artisan(self::$command)
            ->expectsQuestion(__('Enter login'), 'admin')
            ->expectsOutput(__('Entered login does not exist.'))
            ->assertExitCode(0);
    }

}
