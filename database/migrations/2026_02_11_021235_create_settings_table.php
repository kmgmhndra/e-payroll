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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique(); 
            $table->text('value')->nullable(); 
            $table->timestamps();
        });

        // Insert Data Default sesuai Template Anda
        DB::table('settings')->insert([
            [
                'key' => 'bendahara_nama', 
                'value' => 'I Wayan Oka Putra Suartana' // Ganti nama default di sini
            ], 
            [
                'key' => 'bendahara_nip', 
                'value' => '198801212012121002'
            ],
            [
                'key' => 'bendahara_jabatan', 
                'value' => 'Pejabat Pengelola Administrasi Belanja Pegawai'
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
