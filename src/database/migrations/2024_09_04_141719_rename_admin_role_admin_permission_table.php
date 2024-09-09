<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::rename('admin_role_admin_permission', 'admin_permission_admin_role');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::rename('admin_permission_admin_role', 'admin_role_admin_permission');
    }
};
