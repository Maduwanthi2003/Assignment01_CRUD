<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasColumn('users', 'role')) {
            Schema::table('users', function (Blueprint $table) {
                $table->string('role', 20)->default('staff')->after('password');
            });
        }

        // Safely identify and preserve the existing administrator account
        // Uses resilient heuristics: name or email containing admin, known admin email, or earliest registered user
        $adminUser = DB::table('users')
            ->where('name', 'LIKE', '%admin%')
            ->orWhere('email', 'LIKE', '%admin%')
            ->orWhere('email', '=', 'maduwanthidrp@gmail.com')
            ->orderBy('id', 'asc')
            ->first();

        if ($adminUser) {
            DB::table('users')
                ->where('id', $adminUser->id)
                ->update(['role' => 'admin']);
        } else {
            $firstUser = DB::table('users')->orderBy('id', 'asc')->first();
            if ($firstUser) {
                DB::table('users')
                    ->where('id', $firstUser->id)
                    ->update(['role' => 'admin']);
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('users', 'role')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('role');
            });
        }
    }
};
