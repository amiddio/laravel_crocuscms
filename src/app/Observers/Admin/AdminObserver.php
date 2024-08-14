<?php

namespace App\Observers\Admin;

use App\Models\Admin\Admin;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminObserver
{
    const AVATAR_FILE_SYMBOLS_LENGTH = 25;

    private string $storage_dir;

    public function __construct()
    {
        $this->storage_dir = config('admin.path.admin_avatar');
    }

    /**
     * Handle the User "saving" event.
     */
    public function saving(Admin $admin): void
    {
        // Saving avatar file to storage
        if (request()->has('avatar')) {

            $generate_avatar_filename = function (Admin $admin) {
                $image = request()->file('avatar');
                return $admin->getKey() . '_' . Str::random(self::AVATAR_FILE_SYMBOLS_LENGTH) . '.' . $image->getClientOriginalExtension();
            };

            $path = Storage::putFileAs(
                $this->storage_dir,
                request()->file('avatar'),
                $generate_avatar_filename($admin)
            );

            $admin->setAttribute('avatar', File::basename($path));
        }

        // Delete avatar from storage and model
        if (request()->has('delete_avatar')) {
            Storage::delete($this->storage_dir . '/' . $admin->avatar);
            $admin->setAttribute('avatar', null);
        }
    }

    /**
     * Handle the User "deleting" event.
     */
    public function deleting(Admin $admin): void
    {
        // Delete avatar file from storage before user delete
        if ($admin->avatar) {
            $avatar_file_path = $this->storage_dir . '/' . $admin->avatar;
            if (Storage::exists($avatar_file_path)) {
                Storage::delete($avatar_file_path);
            }
        }
    }

}
