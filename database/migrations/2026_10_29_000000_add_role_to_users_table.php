<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('role')->default('user')->after('password');
            $table->foreignId('profile_id')->nullable()->change();
            $table->foreignId('role_id')->nullable()->change();
        });

        if (Schema::hasTable('roles')) {
            $adminRoleIds = DB::table('roles')->where('name', 'admin')->pluck('id');

            if ($adminRoleIds->isNotEmpty()) {
                DB::table('users')->whereIn('role_id', $adminRoleIds)->update(['role' => 'admin']);
            }
        }
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('role');
        });
    }
};