<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('taxas', function (Blueprint $table) {
            $table->integer('parcela')->default(1)->after('bandeira');
        });
    }

    public function down(): void
    {
        Schema::table('taxas', function (Blueprint $table) {
            $table->dropColumn('parcela');
        });
    }
};
