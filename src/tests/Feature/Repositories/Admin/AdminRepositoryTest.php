<?php

namespace Tests\Feature\Repositories\Admin;

use App\Models\Admin\Admin;
use App\Repositories\Admin\AdminRepository;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AdminRepositoryTest extends TestCase
{

    protected AdminRepository $adminRepository;

    public function setUp(): void
    {
        parent::setUp();

        $this->adminRepository = new AdminRepository();
    }

    public function testAdminCanCreate(): void
    {
        $this->adminRepository->create([
            'name' => 'John Dow',
            'login' => 'sadmin',
            'password' => 'Qwerty#2024$',
            'is_active' => true,
        ]);

        $this->assertDatabaseHas('admins', ['login' => 'sadmin']);
    }

    public function testAdminCanNotCreate(): void
    {
        $admin = Admin::factory()->create();

        $result = $this->adminRepository->create([
            'name' => 'John Dow',
            'login' => $admin->login,
            'password' => 'Qwerty#2024$',
            'is_active' => true,
        ]);

        $this->assertNull($result);
    }

    public function testAdminCanUpdate(): void
    {
        $admin = Admin::factory()->create();

        $result = $this->adminRepository->update($admin, [
            'name' => 'John Dow',
            'is_active' => false,
        ]);

        $this->assertNotNull($result);
        $this->assertDatabaseHas('admins', ['login' => $admin->login, 'name' => 'John Dow']);
        $this->assertDatabaseHas('admins', ['login' => $admin->login, 'is_active' => false]);
    }

    public function testAdminPasswordCanUpdate(): void
    {
        $newPassword = 'Some-Password-12';
        $admin = Admin::factory()->create();

        $result = $this->adminRepository->update($admin, [
            'password' => $newPassword,
        ]);

        $this->assertNotNull($result);
        $this->assertTrue(Hash::check($newPassword, $admin->password));
    }

    public function testEmptyAdminPasswordCanNotUpdate(): void
    {
        $newPassword = '';
        $admin = Admin::factory()->create();

        $result = $this->adminRepository->update($admin, [
            'password' => $newPassword,
        ]);

        $this->assertNotNull($result);
        $this->assertFalse(Hash::check($newPassword, $admin->password));
    }

    public function testAdminDelete(): void
    {
        $admin = Admin::factory()->create();

        $result = $this->adminRepository->delete($admin);

        $this->assertTrue($result);
        $this->assertDatabaseMissing('admins', ['login' => $admin->login]);
    }

    public function testAdminCanNotDelete(): void
    {
        $result = $this->adminRepository->delete(new Admin());

        $this->assertNotTrue($result);
    }

    public function testAdminFind(): void
    {
        $admin = Admin::factory()->create();

        $result = $this->adminRepository->find($admin->id);

        $this->assertEquals($admin->id, $result->id);
    }

    public function testAdminNotFind(): void
    {
        $admin = Admin::factory()->create();

        $result = $this->adminRepository->find((int)$admin->id . '78059');

        $this->assertNull($result);
    }

    public function testAdminsPaginate(): void
    {
        $admins = Admin::factory()->count(15)->create();

        $result = $this->adminRepository->paginate($admins[0]->login);

        $this->assertEquals($result->count(), AdminRepository::PER_PAGE);
    }

    public function testExcludeCurrentAdminFromPaginate(): void
    {
        $admins = Admin::factory()->count(1)->create();

        $result = $this->adminRepository->paginate($admins[0]->login);

        $this->assertEquals($result->count(), 0);
    }

}
