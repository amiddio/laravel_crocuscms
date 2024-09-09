<?php

namespace App\Console\Commands\Admin;

use App\Models\Admin\Admin;
use App\Repositories\Admin\AdminRepository;
use App\Repositories\Admin\AdminRoleRepository;

class AdminSetRole extends BaseWithValidationCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:role';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Assign a role to the admin';

    /**
     * Execute the console command.
     */
    public function handle(AdminRepository $adminRepository, AdminRoleRepository $adminRoleRepository): int
    {
        $roles = $this->getRoles($adminRoleRepository);

        $login = $this->askValid(
            question: __('Enter login'),
            field: 'login',
            abort: true
        );
        if ($login === null) {
            return 0;
        }

        $adminRole = $this->choice(
            __('Choose admin Role'),
            $roles->toArray()
        );
        $role = $adminRoleRepository->findByCondition(fieldName: 'name', value: $adminRole);
        if (!$role) {
            $this->error(__("Admin role ':role' not found", ['role' => $adminRole]));
            $this->newLine();
            return 0;
        }

        $admin = $adminRepository->findByCondition(fieldName: 'login', value: $login);
        if ($admin !== null && $adminRepository->update(instance: $admin, data: ['admin_role_id' => $role->id])) {
            $this->info(
                __(
                    'Successfully assigned a role \':role\' to admin \':admin\'',
                    ['role' => $role->name, 'admin' => $login]
                )
            );
        } else {
            $this->error(__('Failed to assign a role \':role\' to admin \':admin\'', ['role' => $role->name, 'admin' => $login]));
        }

        $this->newLine();

        return 1;
    }

    /**
     * @return array
     */
    protected function rules(): array
    {
        return [
            'login' => ['required', 'exists:' . Admin::class . ',login'],
        ];
    }

    /**
     * @return array
     */
    protected function errorMessages(): array
    {
        return [
            'login.required' => __('The login is required.'),
            'login.exists' => __('Entered login does not exist.'),
        ];
    }
}
