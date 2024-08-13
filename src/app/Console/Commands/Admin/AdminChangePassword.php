<?php

namespace App\Console\Commands\Admin;

use App\Models\Admin\Admin;
use App\Repositories\Admin\AdminRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AdminChangePassword extends BaseWithValidationCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:password';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Change admin password';

    /**
     * @var string
     */
    protected string $password = '';

    /**
     * Execute the console command.
     */
    public function handle(AdminRepository $adminRepository): int
    {
        $login = $this->askValid(
            question: __('Enter login'),
            field: 'login',
            abort: true
        );
        if ($login === null) {
            return 0;
        }

        $this->password = $this->askValid(
            question: __('Enter new password'),
            field: 'password',
            secret: true
        );
        $this->askValid(
            question: __('Repeat password'),
            field: 'password_confirmation',
            secret: true
        );

        $data = ['password' => $this->password];

        $admin = $adminRepository->findByCondition(fieldName: 'login', value: $login);

        if ($admin !== null && $adminRepository->update(instance: $admin, data: $data)) {
            $this->info(__('The password of \':admin\' updated successfully!', ['admin' => $login]));
        } else {
            $this->error(__('The password could not be updated. Please, try again.'));
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
            'login.required' => __('The login is required.'),
            'login.exists' => __('Entered login does not exist.'),
            'password.required' => __('The password is required.'),
            'password_confirmation.required' => __('The repeat password is required.'),
            'password_confirmation.in' => __('The entered passwords must match.'),
        ];
    }

}
