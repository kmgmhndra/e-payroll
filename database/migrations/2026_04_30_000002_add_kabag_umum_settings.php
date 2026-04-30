<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('settings')->insert([
            [
                'key' => 'kabag_umum_nama',
                'value' => 'I NENGAH SUKADANA',
            ],
            [
                'key' => 'kabag_umum_nip',
                'value' => '197703042001121002',
            ],
            [
                'key' => 'kabag_umum_jabatan',
                'value' => 'Kepala Bagian Umum',
            ],
        ]);
    }

    public function down(): void
    {
        DB::table('settings')->whereIn('key', [
            'kabag_umum_nama',
            'kabag_umum_nip',
            'kabag_umum_jabatan',
        ])->delete();
    }
};
