<?php

namespace App\Console\Commands\Admin;

use App\Models\Admin\Admin;
use App\Repositories\Admin\AdminRepository;
use App\Repositories\Admin\AdminRoleRepository;
use Illuminate\Validation\Rules\Password;

class AdminCreate extends BaseWithValidationCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new admin';

    /**
     * @var string
     */
    protected string $password = '';

    /**
     * Execute the console command.
     */
    public function handle(AdminRepository $adminRepository, AdminRoleRepository $adminRoleRepository): int
    {
        $roles = $this->getRoles($adminRoleRepository);

        $name = $this->askValid(
            question: __('Enter admin name [press \'Enter\' to leave blank]'),
            field: 'name'
        );

        $login = $this->askValid(
            question: __('Enter admin login'),
            field: 'login'
        );
        if ($login === null) {
            return 0;
        }

        $this->password = $this->askValid(
            question: __('Enter admin password'),
            field: 'password',
            secret: true
        );
        $this->askValid(
            question: __('Repeat password'),
            field: 'password_confirmation',
            secret: true
        );

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

        $data = [
            'name' => $name,
            'login' => $login,
            'password' => $this->password,
            'is_active' => true,
            'admin_role_id' => $role->id,
        ];

        if (!$adminRepository->create($data)) {
            $this->error(__('Failed to create admin!'));
        } else {
            $this->info(__('Admin created successfully!'));
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
            'name' => ['nullable', 'min:3', 'max:30'],
            'login' => ['required', 'lowercase', 'min:3', 'max:30', 'unique:' . Admin::class . ',login'],
            'password' => ['required', Password::defaults()],
            'password_confirmation' => ['required', "in:{$this->password}"],
        ];
    }

    /**
     * @return array
     */
    protected function errorMessages(): array
    {
        return [
            'name.min' => __('The name must be at least :min characters long.'),
            'name.max' => __('The name must not be greater than :max characters.'),
            'login.required' => __('The login is required.'),
            'login.min' => __('The login must be at least :min characters long.'),
            'login.max' => __('The login must not be greater than :max characters.'),
            'login.lowercase' => __('The login must be lowercase.'),
            'login.unique' => __('The entered login already registered.'),
            'password.required' => __('The password is required.'),
            'password_confirmation.required' => __('The repeat password is required.'),
            'password_confirmation.in' => __('The entered passwords must match.'),
        ];
    }

}
