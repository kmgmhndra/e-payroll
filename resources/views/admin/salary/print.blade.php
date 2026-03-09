<!DOCTYPE html>
<html>
<head>
    @php
        use Carbon\Carbon;
        
        // LOGIKA NAMA BULAN
        if (is_numeric($salary->month)) {
            $namaBulan = Carbon::createFromDate($salary->year, $salary->month, 1)->locale('id')->isoFormat('MMMM');
        } else {
            try {
                $namaBulan = Carbon::parse($salary->month)->locale('id')->isoFormat('MMMM');
            } catch (\Exception $e) {
                $namaBulan = $salary->month;
            }
        }

        // FORMAT TANGGAL CETAK (HARI INI)
        $tanggalCetak = Carbon::now()->locale('id')->isoFormat('D MMMM Y');
    @endphp

    <title>Slip Gaji {{ $namaBulan }} {{ $salary->year }}</title>
    <style>
        @page { margin: 0px; }
        body { margin: 0px; font-family: Arial, sans-serif; font-size: 12px; }

        /* Background Image */
        .background {
            position: absolute;
            top: 0; left: 0;
            width: 100%; height: 100%;
            z-index: -1;
        }
        .background img {
            width: 100%; height: 100%;
        }

        /* Style Text Overlay */
        .text-overlay {
            position: absolute;
        }

        .money {
            text-align: right;
            width: 120px; 
        }
        
        .bold { font-weight: bold; }
        .small { font-size: 11px; }
    </style>
</head>
<body>

    <div class="background">
        <img src="{{ public_path('img/template_slip.jpg') }}" alt="Template">
    </div>

    <div class="text-overlay bold" style="top: 218px; left: 515px; width: 150px; text-align: center;">
        {{ strtoupper($namaBulan) }} {{ $salary->year }}
    </div>

    <div class="text-overlay bold" style="top: 218px; left: 165px; width: 50px; text-align: center;">
        {{ $salary->no_urut }}
    </div>

    <div class="text-overlay bold" style="top: 245px; left: 185px;">
        {{ $salary->user->name }}
    </div>

    <div class="text-overlay" style="top: 270px; left: 185px;">
        {{ $salary->user->no_rekening ?? '-' }}
    </div>

    <div class="text-overlay money" style="top: 343px; left: 218px;">
        {{ number_format($salary->income_details['Gaji Induk'] ?? 0, 0, ',', '.') }}
    </div>

    <div class="text-overlay money" style="top: 370px; left: 218px;">
        {{ number_format($salary->income_details['Tunjangan Kinerja'] ?? 0, 0, ',', '.') }}
    </div>

    <div class="text-overlay money bold" style="top: 420px; left: 218px;">
        {{ number_format($salary->total_income, 0, ',', '.') }}
    </div>

    <div class="text-overlay money" style="top: 343px; left: 570px;">
        {{ number_format($salary->deduction_details['Angsuran BPD'] ?? 0, 0, ',', '.') }}
    </div>

    <div class="text-overlay money" style="top: 368px; left: 570px;">
        {{ number_format($salary->deduction_details['Iuran Tabungan Korpri'] ?? 0, 0, ',', '.') }}
    </div>

    <div class="text-overlay money" style="top: 393px; left: 570px;">
        {{ number_format($salary->deduction_details['Iuran Korpri'] ?? 0, 0, ',', '.') }}
    </div>

    <div class="text-overlay money" style="top: 418px; left: 570px;">
        {{ number_format($salary->deduction_details['Arisan DW'] ?? 0, 0, ',', '.') }}
    </div>

    <div class="text-overlay money" style="top: 443px; left: 570px;">
        {{ number_format($salary->deduction_details['Simpan Pinjam'] ?? 0, 0, ',', '.') }}
    </div>
    
    <div class="text-overlay money" style="top: 468px; left: 570px;">
        {{ number_format($salary->deduction_details['Iuran Hindu'] ?? 0, 0, ',', '.') }}
    </div>

    <div class="text-overlay money" style="top: 493px; left: 570px;">
        {{ number_format($salary->deduction_details['Pengajian'] ?? 0, 0, ',', '.') }}
    </div>

    <div class="text-overlay money" style="top: 518px; left: 570px;">
        {{ number_format($salary->deduction_details['Simpatik'] ?? 0, 0, ',', '.') }}
    </div>

    <div class="text-overlay money" style="top: 543px; left: 570px;">
        {{ number_format($salary->deduction_details['Dana Sosial Budaya'] ?? 0, 0, ',', '.') }}
    </div>

    <div class="text-overlay money" style="top: 568px; left: 570px;">
        {{ number_format($salary->deduction_details['Sumbangan DW'] ?? 0, 0, ',', '.') }}
    </div>

     <div class="text-overlay money" style="top: 593px; left: 570px;">
        {{ number_format($salary->deduction_details['PIPAS'] ?? 0, 0, ',', '.') }}
    </div>

    <div class="text-overlay money" style="top: 618px; left: 570px;">
        {{ number_format($salary->deduction_details['Lain-lain 1'] ?? 0, 0, ',', '.') }}
    </div>

    <div class="text-overlay money" style="top: 643px; left: 570px;">
        {{ number_format($salary->deduction_details['Lain-lain 2'] ?? 0, 0, ',', '.') }}
    </div>

    <div class="text-overlay money" style="top: 665px; left: 570px;">
        {{ number_format($salary->deduction_details['Lain-lain 3'] ?? 0, 0, ',', '.') }}
    </div>

    <div class="text-overlay money bold" style="top: 688px; left: 570px;">
        {{ number_format($salary->total_deduction, 0, ',', '.') }}
    </div>

    <div class="text-overlay money bold" style="top: 798px; left: 570px; font-size: 13px;">
        {{ number_format($salary->take_home_pay, 0, ',', '.') }}
    </div>

    <div class="text-overlay" style="top: 858px; left: 410px; width: 300px; text-align: left;">
        Denpasar, {{ $tanggalCetak }}
    </div>

    <div class="text-overlay" style="top: 873px; left: 410px; width: 300px; text-align: left;">
        {!! str_replace('Belanja Pegawai', '<br>Belanja Pegawai', $bendahara['jabatan'] ?? 'Pejabat Pengelola Administrasi Belanja Pegawai') !!}
    </div>

    <div class="text-overlay bold" style="top: 970px; left: 410px; width: 300px; text-align: left; text-decoration: underline;">
        {{ $bendahara['nama'] ?? 'I Wayan Sudirta' }}
    </div>

    <div class="text-overlay" style="top: 988px; left: 410px; width: 300px; text-align: left;">
        NIP. {{ $bendahara['nip'] ?? '-' }}
    </div>

</body>
</html>