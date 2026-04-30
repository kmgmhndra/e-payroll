<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SettingController extends Controller
{
    public function index()
    {
        // Ambil data dari tabel settings
        $settings = DB::table('settings')->pluck('value', 'key');

        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'bendahara_nama' => 'required|string',
            'bendahara_nip' => 'required|string',
            'bendahara_jabatan' => 'required|string',
            'kabag_umum_nama' => 'required|string',
            'kabag_umum_nip' => 'required|string',
            'kabag_umum_jabatan' => 'required|string',
        ]);

        // Update atau Insert data ke tabel settings
        $data = [
            'bendahara_nama' => $request->bendahara_nama,
            'bendahara_nip' => $request->bendahara_nip,
            'bendahara_jabatan' => $request->bendahara_jabatan,
            'kabag_umum_nama' => $request->kabag_umum_nama,
            'kabag_umum_nip' => $request->kabag_umum_nip,
            'kabag_umum_jabatan' => $request->kabag_umum_jabatan,
        ];

        foreach ($data as $key => $value) {
            DB::table('settings')->updateOrInsert(
                ['key' => $key],
                ['value' => $value, 'updated_at' => now()]
            );
        }

        return redirect()->back()->with('success', 'Data Pejabat berhasil diperbarui!');
    }
}