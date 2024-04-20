

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Surat Disposisi</title>
    <style>
        *{
            font-size: 11px!important
        }
        body{
            padding: 40px!important
        }
        table {
            border-collapse: collapse;
            width: 100%;
        }
        .fa-check:before{
            font-size: 19px;
        }
        @page { size: auto;  margin: 0mm; }

        .text {
            font-size:5px!important;border: 2px solid black;width:20px;height:20px;float:left;margin-right:5px;
        }

        .text2 {
            border: 2px solid black;width:20px;height:20px;float:left;margin-right:5px;
        }
        
    </style>
  </head>
  <body onload="window.print()">
  {{-- <body onload=""> --}}
  
    <table class="table" >
        <tr>
            <td style="width: 10%;background-color:none">
                <center>
                    <img src="{{ asset('img/kop_surat/'.$kop->logo) }}" alt="" style="width: 70px; margin-bottom: 30px;" >
                </center>
            </td>
            <td>
                <center>
                    <span style="font-size: 18px!important">
                        LEMBAR DISPOSISI KEPALA SEKOLAH <br>
                    </span>
                </center>
                <center>
                    <span style="font-size: 20px!important;font-weight:800">
                            {{ $kop->nama_sekolah }}
                        <br>
                    </span>
                    Index..................................... Tgl Penyelesaian..................................... 
                </center>
                <hr>
            </td>
        </tr>
        
        <tr>
            <table>
                <tr>
                    <td style="width: 30%;font-size:15px;">Asal Surat</td>
                    <td>:</td>
                    <td>{{ $surat_masuk->instansi_pengirim }}
                </tr>
                <tr>
                    <td style="width: 30%;font-size:15px">No Surat</td>
                    <td>:</td>
                    <td>{{ $surat_masuk->no_surat }}</td>
                </tr>
                <tr>
                    <td style="width: 30%;font-size:15px">Tgl. Surat</td>
                    <td>:</td>
                    <td>
                        <?php setlocale(LC_TIME, 'ID'); ?>
                        {{ strftime('%e %B %Y', strtotime($surat_masuk->tgl_surat)) }}
                    </td>
                </tr>
                <tr>
                    <td style="width: 30%;font-size:15px">Perihal</td>
                    <td>:</td>
                    <td>{{ $surat_masuk->perihal }}</td>
                </tr>
                <tr>
                    <td style="width: 30%;font-size:15px">Tgl. Diterima</td>
                    <td>:</td>
                    <td>
                        <?php setlocale(LC_TIME, 'ID'); ?>
                        {{ strftime('%e %B %Y', strtotime($surat_masuk->diterima_tgl)) }}
                    </td>
                </tr>
                
                <tr>
                    <td style="width: 30%;font-size:15px">Sifat</td>
                    <td>:</td>
                    <td style="font-size:15px">
                        @if($surat_masuk->sifat == 'Rahasia')
                            <strong>{{ $surat_masuk->sifat }}</strong>/Sangat Penting/Mendesak/Penting/Segera/Biasa *)
                        @elseif($surat_masuk->sifat == 'Sangat Penting')
                            Rahasia/<strong>{{ $surat_masuk->sifat }}</strong>/Mendesak/Penting/Segera/Biasa *)
                        @elseif($surat_masuk->sifat == 'Mendesak')
                            Rahasia/Sangat Penting/<strong>{{ $surat_masuk->sifat }}</strong>/Penting/Segera/Biasa *)
                        @elseif($surat_masuk->sifat == 'Penting')
                            Rahasia/Sangat Penting/Mendesak/<strong>{{ $surat_masuk->sifat }}</strong>/Segera/Biasa *)
                        @elseif($surat_masuk->sifat == 'Segera')
                            Rahasia/Sangat Penting/Mendesak/Penting/<strong>{{ $surat_masuk->sifat }}</strong>/Biasa *)
                        @elseif($surat_masuk->sifat == 'Biasa')
                            Rahasia/Sangat Penting/Mendesak/Penting/Segera/<strong>{{ $surat_masuk->sifat }}</strong> *)
                        @else
                            Rahasia/Sangat Penting/Mendesak/Penting/Segera/Biasa *)
                        @endif
                    </td>
                </tr>
                
                <tr>
                    <td colspan="3"><hr></td> <!-- Menambahkan garis setelah baris terakhir -->
                </tr>
            </table>
        </tr>
        <tr>
            <br>
            <span>
                I. DITERUSKAN KEPADA
            </span>
            <br><br>
            <div class="jarak" style="margin-left:20px">
                <span><b>A. Manajemen Sekolah</b></span>
                <table style="margin-left:10px;margin-top:10px">
                    <tr>
                        @php
                            $arrayDisposisiJabatan2 = explode(',', trim($surat_masuk->disposisi_jabatan, '[]'));

                            $arrayDisJab = [];
                            foreach ($arrayDisposisiJabatan2 as $key => $dj) {
                                $jabatan = str_replace(['\\', '"'], '', trim($dj)) ?? '-';
                                $arrayDisJab[] = $jabatan;

                            }
                        @endphp
                        {{-- @dd($arrayDisJab) --}}

                        <td style="width: 60%">
                            1. Arsiparis Ahli Muda
                            <div class="text"> <i class="fa fa-check" style="display : {{ in_array('Arsiparis Ahli Muda',$arrayDisJab) ? '' : 'none' }}" </div>
                        </td>
                        <td>
                            5. Wakasek Bidang Hub. DU/DI
                            <div class="text"> <i class="fa fa-check" style="display : {{ in_array('Wakasek Bidang Hub. DU/DI',$arrayDisJab) ? '' : 'none' }}" </div>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 60%">
                            2. Ketua Tim Penjamin Mutu Pendidikan Sekolah
                            <div class="text"> <i class="fa fa-check" style="display : {{ in_array('Ketua Tim Penjamin Mutu Pendidikan Sekolah (TPMPS)',$arrayDisJab) ? '' : 'none' }}" </div>
                        </td>
                        <td>
                            6. Wakasek Bidang Sarana Prasarana
                            <div class="text"> <i class="fa fa-check" style="display : {{ in_array('Wakasek Bidang Sarana Prasarana',$arrayDisJab) ? '' : 'none' }}" </div>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 60%">
                            3. Wakasek Bidang Akademik
                            <div class="text"> <i class="fa fa-check" style="display : {{ in_array('Wakasek Bidang Akademik',$arrayDisJab) ? '' : 'none' }}" </div>
                        </td>
                        <td>
                            7. Bendahara............
                            <div class="text"></div>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 60%">
                            4. Wakasek Bidang Kesiswaan
                            <div class="text"> <i class="fa fa-check" style="display : {{ in_array('Wakasek Bidang Kesiswaan',$arrayDisJab) ? '' : 'none' }}" </div>
                        </td>
                        {{-- <td>
                            8. ........................
                            <div class="text">  </div>
                        </td> --}}
                        @php
                            // $arrayDisJab[] = 'tes'; 
                            $jabatan_tidak_ditemukan = false;
                            $jabatanExist = '';
                            // Menentukan jabatan yang tersedia
                            $jabatan_tersedia = [
                                'Arsiparis Ahli Muda',
                                'Ketua Tim Penjamin Mutu Pendidikan Sekolah',
                                'Wakasek Bidang Akademik',
                                'Wakasek Bidang Kesiswaan',
                                'Wakasek Bidang Hub. DU/DI',
                                'Wakasek Bidang Sarana Prasarana',
                                'Bidang Kurikulum',
                            ];

                           foreach ($arrayDisJab as $key => $valjob) {
                                $cek = in_array($valjob,$jabatan_tersedia);
                                if (empty($cek)) {
                                    $jabatan_tidak_ditemukan = true;
                                    $jabatanExist = $valjob;
                                    break;
                                }
                           }
                        @endphp
                    

                        <td style="width: 60%">
                            8. 
                            @if ($jabatan_tidak_ditemukan)
                                {{$jabatanExist}}
                                <div class="text"><i class="fa fa-check"></i></div>
                            @else
                            ........................
                                <div class="text">  </div>
                            @endif
                        </td>
                    </tr>
                </table>
            </div>
            <br>
            <div class="jarak" style="margin-left:20px">
                <span><b>B. Kepala Konsentrasi Keahlian</b></span>
                <table style="margin-left:10px;margin-top:10px">
                    @php
                        $arrayKPK = explode(',', trim($surat_masuk->kepala_konsentrasi_keahlian, '[]'));
                        $arr_kpk = [];
                        foreach ($arrayKPK as $key => $kpk) {
                            $arr_kpk[] = trim($kpk, '""'); 
                        }
                    @endphp
                    
                    <tr>
                        <td style="width: 20%">
                            1. TKP
                            <div class="text2">
                                <i class="fa fa-check" style="display : {{ in_array('TKP',$arr_kpk) ? '' : 'none' }}"></i> 
                            </div>
                        </td>
                        <td>
                            4. TOI
                            <div class="text2">
                                <i class="fa fa-check" style="display : {{ in_array('TOI',$arr_kpk) ? '' : 'none' }}"></i> 
                            </div>
                        </td>
                        <td style="width: 20%">
                            7. DPIB
                            <div class="text2">
                                <i class="fa fa-check" style="display : {{ in_array('DPIB',$arr_kpk) ? '' : 'none' }}"></i> 
                            </div>
                        </td>
                        <td>
                            10. TKJ
                            <div class="text2">
                                <i class="fa fa-check" style="display : {{ in_array('TKJ',$arr_kpk) ? '' : 'none' }}"></i> 
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 20%">
                            2. TP
                            <div class="text2">
                                <i class="fa fa-check" style="display : {{ in_array('TP',$arr_kpk) ? '' : 'none' }}"></i> 
                            </div>
                        </td>
                        <td>
                            5. SIJA
                            <div class="text2">
                                <i class="fa fa-check" style="display : {{ in_array('SIJA',$arr_kpk) ? '' : 'none' }}"></i> 
                            </div>
                        </td>
                        <td style="width: 20%">
                            8. TKR
                            <div class="text2">
                                <i class="fa fa-check" style="display : {{ in_array('TKR',$arr_kpk) ? '' : 'none' }}"></i> 
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 20%">
                            3. TFLM
                            <div class="text2">
                                <i class="fa fa-check" style="display : {{ in_array('TFLM',$arr_kpk) ? '' : 'none' }}"></i> 
                            </div>
                        </td>
                        <td>
                            6. DKV
                            <div class="text2">
                                <i class="fa fa-check" style="display : {{ in_array('DKV',$arr_kpk) ? '' : 'none' }}"></i> 
                            </div>
                        </td>
                        <td>
                            9. RPL
                            <div class="text2">
                                <i class="fa fa-check" style="display : {{ in_array('RPL',$arr_kpk) ? '' : 'none' }}"></i> 
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
            <br>
            <div class="jarak" style="margin-left:20px">
                <span><b>C. GTK</b></span>
                <table width="100%" border="2" style="margin-left: 10px;margin-top:10px">
                    <thead>
                        <tr>
                            <td style="text-align: center;border:2px solid black">NO</td>
                            <td style="text-align: center;border:2px solid black">NAMA</td>
                            <td style="text-align: center;border:2px solid black">JABATAN</td>
                            <td style="text-align: center;border:2px solid black">KETERANGAN</td>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $pegawaiDisposisi = \App\Models\DisposisiPegawai::where('id_surat',$surat_masuk->id)->get(); 
                        @endphp
                        @foreach ($pegawaiDisposisi as $pd)
                          
                                    @php
                                        $pegawaiNama = \App\Models\User::where('id',$pd->id_pegawai)->first(); 
                                    @endphp

                                    {{-- {{ $pegawaiNama->name ?? '-' }} --}}
                               
                            <tr>
                                <td style="text-align: center;height: 30%;border:2px solid black"> {{ $loop->iteration }}</td>
                                <td style="height: 30%;border:2px solid black"> {{ $pegawaiNama->name ?? '-' }}</td>
                                <td style="height: 30%;border:2px solid black"> {{ $pegawaiNama->jabatan }} </td>
                                <td style="height: 30%;border:2px solid black"> </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <br>
            <span>
                II. INTRUKSI
            </span>
            @php
            $intruksi = [
                "Wakili/hadiri laporkan hasilnya",
                "Baca, pahami, berikan saran",
                "Koordinasikan dengan tim",
                "Tindaklanjuti/fasilitasi/penuhi sesuai ketentuan",
                "Untuk dijawab secara tertulis",
                "Buatkan konsep ijin/rekomendasi",
                "Catat dan arsipkan",
                "Jadikan pedoman",
                "Siapkan pointer/Sambutan/Bahan"
            ];
        @endphp
         <div class="jarak" style="margin-left:30px;margin-top:10px">
            
                <table class="instruction-table">
                    @php
                        $arrayin = explode(',', trim($surat_masuk->intruksi, '[]'));
                        $arr_in = [];
                        foreach ($arrayin as $key => $in) {
                            $intruksiAr = str_replace(['\\', '"'], '', trim($in)) ?? '-';
                            $arr_in[] = $intruksiAr;
                        }
                    @endphp
                   
                    <tr>
                        @for ($i = 0; $i < 9; $i += 4)
                            <td class="instruction-column">
                                <div class="text2"> <i class="fa fa-check" style="display : {{ in_array($intruksi[$i],$arr_in) ? '' : 'none' }}"></i> </div>
                                {{ $intruksi[$i] }}
                            </td>
                        @endfor
                    </tr>
                    <tr>
                        @for ($i = 1; $i < 9; $i += 4)
                            <td class="instruction-column">
                                <div class="text2"> <i class="fa fa-check" style="display : {{ in_array($intruksi[$i],$arr_in) ? '' : 'none' }}"></i> </div>
                                {{ $intruksi[$i] }}
                            </td>
                        @endfor
                    </tr>
                    <tr>
                        @for ($i = 2; $i < 9; $i += 4)
                            <td class="instruction-column">
                                <div class="text2"> <i class="fa fa-check" style="display : {{ in_array($intruksi[$i],$arr_in) ? '' : 'none' }}"></i> </div>
                                {{ $intruksi[$i] }}
                            </td>
                        @endfor
                    </tr>
                    <tr>
                        @for ($i = 3; $i < 9; $i += 4)
                            <td class="instruction-column">
                                <div class="text2"> <i class="fa fa-check" style="display : {{ in_array($intruksi[$i],$arr_in) ? '' : 'none' }}"></i> </div>
                                {{ $intruksi[$i] }}
                            </td>
                        @endfor
                    </tr>
                    <tr>
                        @for ($i = 4; $i < 9; $i += 4)
                            <td class="instruction-column">
                                <div class="text2"> <i class="fa fa-check" style="display : {{ in_array($intruksi[$i],$arr_in) ? '' : 'none' }}"></i> </div>
                                {{ $intruksi[$i] }}
                            </td>
                        @endfor
                    </tr>
                </table>
            <br>
        </div>
        <span >
            III. INFORMASI
        </span>
        <div class="jarak" style="margin-left:30px;margin-top:10px">
            <table width="100%" border="2">
                <thead>
                    <tr>
                        <td style="text-align: center">CATATAN</td>
                        <td style="text-align: center">KETERANGAN</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="width: 70%"> <br><br><br> </td>
                        <td style="width: 30%"> 
                            <center>
                                Kepala Sekolah
                            </center>
                            <br>
                            <br>
                            <center>
                                {{ $kop->kepala_sekolah }} <br>
                                NIP. {{$kop->nip_kepala_sekolah}}
                            </center>
                        
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            Lanjutan
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        </tr>
     
    </table>

</html>