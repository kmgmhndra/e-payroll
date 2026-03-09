<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('salaries', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('month'); 
            $table->integer('year'); 
            
            // === [WAJIB DITAMBAHKAN] ===
            // Tanpa kolom ini, nomor slip gaji tidak akan bisa disimpan!
            $table->integer('no_urut')->default(0); 
            // ===========================
            
            // Ganti 'json' menjadi 'longText' agar muat menampung teks enkripsi yang panjang
            $table->longText('income_details')->nullable(); 
            $table->longText('deduction_details')->nullable();

            // Kolom Total
            $table->bigInteger('total_income')->default(0);      
            $table->bigInteger('total_deduction')->default(0);   
            $table->bigInteger('take_home_pay')->default(0);     

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('salaries');
    }
};