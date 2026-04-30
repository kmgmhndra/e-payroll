<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('pangkat_golongan')->nullable()->after('no_rekening');
            $table->string('jabatan')->nullable()->after('pangkat_golongan');
            $table->integer('grade')->nullable()->after('jabatan');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['pangkat_golongan', 'jabatan', 'grade']);
        });
    }
};
