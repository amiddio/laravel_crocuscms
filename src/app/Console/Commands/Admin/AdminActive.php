<?php

namespace App\Console\Commands\Admin;

use App\Models\Admin\Admin;
use App\Repositories\Admin\AdminRepository;

class AdminActive extends BaseWithValidationCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:active';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Set an admin to active/inactive';

    /**
     * Execute the console command.
     */
    public function handle(AdminRepository $adminRepository): void
    {
        $login = $this->askValid(
            question: __('Enter login'),
            field: 'login',
            abort: true
        );

        $isActive = $this->choice(
            __('Set \':admin\' to active or inactive?', ['admin' => $login]),
            [1 => 'on', 2 => 'off']
        );

        $isActive = filter_var($isActive, FILTER_VALIDATE_BOOLEAN);

        $admin = $adminRepository->findByCondition(fieldName: 'login', value: $login);
        if ($admin !== null && $adminRepository->update(instance: $admin, data: ['is_active' => $isActive])) {
            $this->info(
                __(
                    'Set \':admin\' to :status successfully!',
                    ['admin' => $login, 'status' => $isActive ? 'active' : 'inactive']
                )
            );
        } else {
            $this->error(__('Failed to update \':admin\'!', ['admin' => $login]));
        }

        $this->newLine();
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
