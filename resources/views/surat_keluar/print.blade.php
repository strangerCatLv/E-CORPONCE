

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>{{ $surat_keluar->no_awal.$surat_keluar->no_surat }}</title>
    <style>
        table td{
            border:none !important;
        }
        body{
            padding: 60px;
        }
        @page { size: auto;  margin: 0mm; }
        .table>:not(caption)>*>*{
            padding:0px!Important
        }
        .content p{
            margin-bottom: 3px;
        }
        *{
            font-size: 13px;
            font-family: 'Times New Roman';
        }
    </style>
  </head>
  <body onload="window.print()">
  {{-- <body onload=""> --}}
    <table border="0">
        <tr>
            <td style="width: 100px">
                <center>
                    <img src="{{ asset('img/kop_surat/'.$kop->logo ) }}" alt="" style="width: 100px">
                </center>
            </td>
            <td  style="padding-left: 50px;">
                <center>
                    <h4 style="font-size:18px; margin-bottom: 0px;">
                        PEMERINTAH DAERAH PROVINSI JAWA BARAT <br>
                        DINAS PENDIDIKAN
                    </h4>
                    <b style="font-size:16px">CABANG DINAS PENDIDIKAN WILAYAH I</b><br>
                    <b style="font-size:18px">
                        {{ $kop->nama_sekolah }}
                    </b><br>
                    <span style="font-size: 12px; ">{{ $kop->alamat }}</span>
                    <span style="font-size: 12px; "> - telp. {{ $kop->telp }} Fax. +622518665558</span><br>
                    <span style="font-size: 12px; ">e_mail: <a href="mailto:{{$kop->email}}" style="color: #006eff;font-size: 11px;">{{$kop->email}}</a> website: <a href="{{$kop->website}}" style="color: #006eff;font-size: 11px;">{{$kop->website}}</a></span><br>
                    <span style="font-size: 12px; ">CIBINONG-16913</span>
                </center>
            </td>
        </tr>
    </table>
    <div style="border:2px solid black;"></div>
  <center>
    <h4 style="margin-top: 8px; margin-bottom: 0;"><b><u style="font-size: 18px; margin-bottom: 0px;">{{ $surat_keluar->judul }}</u></b></h4>
    <span style="margin-top: 0; display: block; margin-bottom: 10px;">Nomor: {{ $surat_keluar->no_surat }}</span>
    </center>
    <span >Kepala Sekolah Menengah Kejuruan (SMK) Negeri 1 Cibinong Kabupaten Bogor dengan ini:</span>
    <br>   
    <center>
        <b style="margin-top: 10px;font-size:18px;  display: block; margin-bottom: 10px;">MEMERINTAHKAN</b>
    </center>
    <table class="table" border="0">
        @php
            $getUser = Request::get('user');
            $user = \App\Models\User::where('id',$getUser)->first() ?? '';
        @endphp
        
        <tr>
            <td style="width: 66px">Kepada :</td>
            <td style="width:85px">Nama</td>
            <td style="width: 10px">:</td>
            <td>{{ $user->name ?? '-' }}</td>
        </tr>
        <tr>
            <td style="width: 10px"></td>
            <td style="width:85px">Jabatan</td>
            <td style="width: 10px">:</td>
            <td>{{ $user->jabatan ?? '-' }}</td>
        </tr>
        <tr>
            <td style="width: 10px;padding-bottom:42px!important"></td>
            <td style="width:85px">Unit Kerja</td>
            <td style="width: 10px">:</td>
            <td>SMK Negeri 1 Cibinong</td>
        </tr>
        <tr>
            <td colspan="4" style="padding-bottom: 5px!important;">
                <span style="margin-top:0px; ">
                    Untuk : {{ $surat_keluar->untuk }}
                </span>
            </td>
        </tr>
    </table>
    <table style="margin-left:45px" >
        <tr >
            <td style="width:100px">Hari</td>
            <td style="width:10px">:</td>
            <td>{{ $surat_keluar->hari }}</td>
        </tr>
        <tr>
            <td>Tanggal</td>
            <td>:</td>
            <td>
                {{ \Carbon\Carbon::parse($surat_keluar->tanggal)->translatedFormat('d F Y') }}
            </td>
        </tr>
        <tr>
            <td>Waktu</td>
            <td>:</td>
            <td>{{ $surat_keluar->waktu }}</td>
        </tr>
        <tr>
            <td>Tempat</td>
            <td>:</td>
            <td> <b>{{ $surat_keluar->tempat }}</b>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>:</td>
            <td> {{ $surat_keluar->alamat }}</td> 
        </tr>
        <tr>
            <td> <b>Catatan</b> </td>
            <td>:</td>
            <td> <b>{{ $surat_keluar->catatan }}</b> </td>
        </tr>
    </table>
    <table style="margin-top: 10px">
        <tr>
            <td colspan="4">
                <?php echo $surat_keluar->isi_surat  ?>
            </td>
        </tr>
        
    </table>
    <table>
        <tbody>
            <tr>
                <td style="width:300px"></td>
                <td>
                    <div style="padding:10px;border-radius:10px">
                        @php
                            setlocale(LC_TIME, 'id');
                            $date = date('Y-m-d');
                            $bulan = strtoupper(strftime('%B', strtotime($date)));
                            $formatted_date = strftime('%d', strtotime($date)) . ' ' . $bulan . ' ' . strftime('%Y', strtotime($date));
                        @endphp
                        CIBINONG, {{ $formatted_date }}, <br>
                        KEPALA {{$kop->nama_sekolah}},
                        <br>
                        <br>
                        <br>
                        <br>
                        <b>
                            {{ $kop->kepala_sekolah }}
                        </b>  <br>
                        Pembina Tk.I <br>
                        NIP. 196604192000031002
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
    <br>
    <span>Telah tiba dan melaksanakan tugas:</span>
    <table>
        <tr>
            <td style="width: 280px">Pada Hari/Tanggal</td>
            <td style="width: 10px">:</td>
            <td>................................................................</td>
        </tr>
        <tr>
            <td style="width: 280px">Tanda Tangan dan Stempel penerima</td>
            <td style="width: 10px">:</td>
            <td>................................................................</td>
        </tr>
    </table>

    
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</html>