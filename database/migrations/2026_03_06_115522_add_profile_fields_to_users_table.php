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
        Schema::table('users', function (Blueprint $table) {
            $table->string('cpf')->unique()->nullable()->after('email');
            $table->string('phone')->nullable()->after('cpf');
            $table->date('birth_date')->nullable()->after('phone');
            $table->string('cep')->nullable()->after('birth_date');
            $table->string('address')->nullable()->after('cep');
            $table->string('number')->nullable()->after('address');
            $table->string('complement')->nullable()->after('number');
            $table->string('neighborhood')->nullable()->after('complement');
            $table->string('city')->nullable()->after('neighborhood');
            $table->string('state', 2)->nullable()->after('city');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'cpf',
                'phone',
                'birth_date',
                'cep',
                'address',
                'number',
                'complement',
                'neighborhood',
                'city',
                'state'
            ]);
        });
    }
};
