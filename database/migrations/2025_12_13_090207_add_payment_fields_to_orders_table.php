<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->bigInteger('uang_dibayar')->after('total')->default(0);
            $table->bigInteger('kembalian')->after('uang_dibayar')->default(0);
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn([
                'uang_dibayar',
                'kembalian'
            ]);
        });
    }
};
