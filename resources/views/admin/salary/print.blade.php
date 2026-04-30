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

        // BULAN SEBELUMNYA (untuk Tunjangan Kinerja & Uang Makan)
        $bulanSebelumnya = $salary->bulan_sebelumnya;
    @endphp

    <title>Slip Gaji {{ $namaBulan }} {{ $salary->year }}</title>
    <style>
        @page { 
            margin: 20mm; 
        }
        body { 
            margin: 0; 
            font-family: 'Times New Roman', Times, serif; 
            font-size: 9pt; 
            color: #000;
            line-height: 1.3;
        }

        /* === PAGE BORDER === */
        .page-border {
            border: 1.5px solid #000;
            padding: 15px 20px;
            min-height: calc(100vh - 40mm);
        }

        /* === HEADER === */
        .header-table {
            width: 100%;
            border-bottom: 2px solid #000;
            padding-bottom: 4px;
            margin-bottom: 8px;
        }
        .header-table td {
            vertical-align: middle;
        }
        .header-logo {
            width: 55px;
            padding-right: 8px;
        }
        .header-logo img {
            width: 60px;
            height: auto;
        }
        .header-text {
            text-align: center;
            font-size: 10pt;
            padding-right: 65px;
        }
        .header-text .instansi {
            font-size: 11pt;
            font-weight: bold;
        }
        .header-text .kanwil {
            font-size: 10pt;
            font-weight: bold;
        }

        /* === TITLE === */
        .title {
            text-align: center;
            margin: 8px 0 4px 0;
        }
        .title h2 {
            font-size: 10pt;
            margin: 0;
            font-weight: bold;
        }
        .title p {
            font-size: 9pt;
            font-weight: bold;
            margin: 2px 0 0 0;
        }

        /* === INFO PEGAWAI === */
        .intro-text {
            margin: 8px 0 3px 0;
            font-size: 9pt;
        }
        .info-table {
            width: 100%;
            font-size: 9pt;
            margin-bottom: 6px;
        }
        .info-table td {
            padding: 0.5px 0;
            vertical-align: top;
        }
        .info-label {
            width: 120px;
        }
        .info-colon {
            width: 8px;
            text-align: center;
        }

        /* === CONTENT TABLE (PENGHASILAN & POTONGAN) === */
        .content-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 9pt;
            margin-bottom: 3px;
        }
        .content-table td {
            padding: 1px 3px;
            vertical-align: top;
        }
        .content-table .section-title {
            font-weight: bold;
            padding-top: 3px;
        }
        .content-table .sub-item {
            padding-left: 20px;
        }
        .content-table .sub-item-dash {
            padding-left: 30px;
        }
        .money {
            text-align: right;
            white-space: nowrap;
        }
        .money-total {
            text-align: right;
            font-weight: bold;
            white-space: nowrap;
        }
        .border-top-single { border-top: 1px solid #000; }
        .border-top-double { border-top: 3px double #000; }
        .bold { font-weight: bold; }
        .plus-sign { text-align: right; padding-right: 2px; }

        /* === TERBILANG === */
        .terbilang {
            font-size: 9pt;
            font-style: italic;
            font-weight: bold;
            margin: 5px 0;
        }

        /* === TANDA TANGAN === */
        .signature-table {
            width: 100%;
            margin-top: 10px;
            font-size: 9pt;
        }
        .signature-table td {
            vertical-align: top;
            padding: 1px 0;
        }
        .signature-left {
            width: 50%;
            text-align: center;
        }
        .signature-right {
            width: 50%;
            text-align: center;
        }
        .signature-name {
            font-weight: bold;
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <div class="page-border">

    {{-- ========== HEADER ========== --}}
    <table class="header-table" cellpadding="0" cellspacing="0">
        <tr>
            <td class="header-logo">
                <img src="{{ public_path('img/logo_kemenkum.png') }}" alt="Logo">
            </td>
            <td class="header-text">
                <div class="instansi">KEMENTERIAN HUKUM REPUBLIK INDONESIA</div>
                <div class="kanwil">KANTOR WILAYAH BALI</div>
                <div>Jalan Raya Puputan Niti Mandala Renon Denpasar</div>
                <div>Telp (0361) 228718</div>
            </td>
        </tr>
    </table>

    {{-- ========== TITLE ========== --}}
    <div class="title">
        <h2>SURAT KETERANGAN PENGHASILAN</h2>
        <p>Bulan : {{ $namaBulan }} {{ $salary->year }}</p>
    </div>

    {{-- ========== INTRO ========== --}}
    <div class="intro-text">
        Yang bertanda tangan dibawah ini, Kepala Kantor Wilayah Kementerian Hukum dan HAM Bali<br>
        menerangkan bahwa pemegang surat ini :
    </div>

    {{-- ========== INFO PEGAWAI ========== --}}
    <table class="info-table" cellpadding="0" cellspacing="0">
        <tr>
            <td class="info-label">Nama</td>
            <td class="info-colon">:</td>
            <td>{{ $salary->user->name }}</td>
        </tr>
        <tr>
            <td class="info-label">NIP</td>
            <td class="info-colon">:</td>
            <td>{{ $salary->user->nip }}</td>
        </tr>
        <tr>
            <td class="info-label">Pangkat/Golongan</td>
            <td class="info-colon">:</td>
            <td>{{ $salary->user->pangkat_golongan ?? '-' }}</td>
        </tr>
        <tr>
            <td class="info-label">Jabatan / Grade</td>
            <td class="info-colon">:</td>
            <td>{{ $salary->user->jabatan ?? '-' }}</td>
        </tr>
    </table>

    {{-- ========== I. PENGHASILAN ========== --}}
    <table class="content-table" cellpadding="0" cellspacing="0">
        {{-- Section Title --}}
        <tr>
            <td class="section-title" colspan="2">I. &nbsp;Penghasilan</td>
            <td></td>
            <td></td>
        </tr>

        {{-- Gaji Induk Sub-header --}}
        <tr>
            <td class="sub-item" colspan="2"><strong>Gaji Induk {{ $namaBulan }} {{ $salary->year }} :</strong></td>
            <td></td>
            <td></td>
        </tr>

        @php
            $gajiIndukItems = [
                'Gaji Pokok', 'Tunjangan Keluarga', 'Tunjangan Jabatan',
                'Pembulatan', 'Tunjangan Pajak', 'Tunjangan Beras'
            ];
        @endphp

        @foreach($gajiIndukItems as $item)
        <tr>
            <td class="sub-item-dash" style="width:55%;">- {{ $item }}</td>
            <td style="width:2%; text-align:center;">:</td>
            <td class="money" style="width:18%;">{{ number_format($salary->income_details[$item] ?? 0, 0, ',', ',') }}</td>
            <td style="width:25%;"></td>
        </tr>
        @endforeach

        {{-- Tunjangan Kinerja Bersih --}}
        <tr>
            <td class="sub-item">Tunjangan Kinerja Bersih {{ $bulanSebelumnya }} @if($salary->user->grade)(Grade {{ $salary->user->grade }})@endif</td>
            <td style="text-align:center;">:</td>
            <td class="money">{{ number_format($salary->income_details['Tunjangan Kinerja'] ?? 0, 0, ',', ',') }}</td>
            <td></td>
        </tr>

        {{-- Uang Makan --}}
        <tr>
            <td class="sub-item">Uang Makan {{ $bulanSebelumnya }}</td>
            <td style="text-align:center;">:</td>
            <td class="money">{{ number_format($salary->income_details['Uang Makan'] ?? 0, 0, ',', ',') }}</td>
            <td class="plus-sign">+</td>
        </tr>

        {{-- Jumlah Penghasilan --}}
        <tr>
            <td class="sub-item bold">Jumlah Penghasilan</td>
            <td style="text-align:center;">:</td>
            <td></td>
            <td class="money-total border-top-single">{{ number_format($salary->total_income, 0, ',', ',') }}</td>
        </tr>

        {{-- ========== II. POTONGAN ========== --}}
        <tr><td colspan="4" style="height: 3px;"></td></tr>
        <tr>
            <td class="section-title" colspan="2">II. Potongan-potongan</td>
            <td></td>
            <td></td>
        </tr>

        @php
            $potongans = [
                'Iuran Wajib Pegawai', 'BPJS', 'Pajak Penghasilan', 'Sewa Rumah Dinas',
                'Angsuran BPD', 'Iuran Tabungan Korpri', 'Iuran Korpri',
                'Seksi Usaha Dharma Wanita', 'Arisan Dharma Wanita', 'Arisan Pengayoman',
                'Simpan Pinjam', 'Iuran Hindu', 'Dana Sosial Budaya', 'Simpatik'
            ];
        @endphp

        @foreach($potongans as $item)
        <tr>
            <td class="sub-item">{{ $item }}</td>
            <td style="text-align:center;">:</td>
            <td class="money">
                @php $val = $salary->deduction_details[$item] ?? 0; @endphp
                @if($val > 0)
                    {{ number_format($val, 0, ',', ',') }}
                @else
                    -
                @endif
            </td>
            <td></td>
        </tr>
        @endforeach

        {{-- Sumbangan DW (item terakhir dengan tanda +) --}}
        <tr>
            <td class="sub-item">Sumbangan DW</td>
            <td style="text-align:center;">:</td>
            <td class="money" style="border-bottom: 1px solid #000;">
                @php $sumbDw = $salary->deduction_details['Sumbangan DW'] ?? 0; @endphp
                @if($sumbDw > 0)
                    {{ number_format($sumbDw, 0, ',', ',') }}
                @endif
            </td>
            <td class="plus-sign">+</td>
        </tr>

        {{-- Jumlah Potongan --}}
        <tr>
            <td class="sub-item bold">Jumlah Potongan</td>
            <td style="text-align:center;">:</td>
            <td></td>
            <td class="money-total border-top-single">{{ number_format($salary->total_deduction, 0, ',', ',') }} &nbsp; -</td>
        </tr>

        {{-- Jumlah Penghasilan Bersih --}}
        <tr>
            <td class="sub-item bold">Jumlah Penghasilan Bersih</td>
            <td style="text-align:center;">:</td>
            <td></td>
            <td class="money-total border-top-double" style="text-decoration: underline;">{{ number_format($salary->take_home_pay, 0, ',', ',') }}</td>
        </tr>
    </table>

    {{-- ========== TERBILANG ========== --}}
    <div class="terbilang">
        ({{ $terbilang }})
    </div>

    {{-- ========== TANDA TANGAN (2 KOLOM) ========== --}}
    <table class="signature-table" cellpadding="0" cellspacing="0">
        {{-- Baris 1: Judul --}}
        <tr>
            <td class="signature-left">
                An. Kepala Kantor Wilayah<br>
                Kementerian Hukum dan HAM Bali<br>
                {{ $kabagUmum['jabatan'] ?? 'Kepala Bagian Umum' }}
            </td>
            <td class="signature-right">
                Denpasar, {{ $tanggalCetak }}<br>
                {{ $bendahara['jabatan'] ?? 'Bend. Gaji/PPABP' }}
            </td>
        </tr>

        {{-- Baris 2: Spasi untuk tanda tangan --}}
        <tr>
            <td style="height: 50px;"></td>
            <td></td>
        </tr>

        {{-- Baris 3: Nama & NIP --}}
        <tr>
            <td class="signature-left">
                <span class="signature-name">{{ strtoupper($kabagUmum['nama'] ?? '-') }}</span><br>
                NIP {{ $kabagUmum['nip'] ?? '-' }}
            </td>
            <td class="signature-right">
                <span class="signature-name">{{ strtoupper($bendahara['nama'] ?? '-') }}</span><br>
                NIP {{ $bendahara['nip'] ?? '-' }}
            </td>
        </tr>
    </table>

    </div> {{-- end page-border --}}

</body>
</html>