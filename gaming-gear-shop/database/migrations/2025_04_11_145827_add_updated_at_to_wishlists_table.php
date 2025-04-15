<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Chỉ thêm cột nếu nó chưa tồn tại
        if (!Schema::hasColumn('wishlists', 'updated_at')) {
            Schema::table('wishlists', function (Blueprint $table) {
                // Thêm cột updated_at, cho phép NULL, đặt sau created_at
                $table->timestamp('updated_at')->nullable()->after('created_at');
            });
        }
    }

    public function down(): void
    {
         if (Schema::hasColumn('wishlists', 'updated_at')) {
            Schema::table('wishlists', function (Blueprint $table) {
                $table->dropColumn('updated_at');
            });
         }
    }
};
