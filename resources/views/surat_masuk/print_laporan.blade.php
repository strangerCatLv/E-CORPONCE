

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Laporan Surat Masuk</title>
    <style>
       
        @page { 
          size: auto;  
          margin: 0mm;
          margin-bottom: 2cm; 
          margin-right: 2cm;
          font-family: 'Times New Roman';
        }

        body{
          padding: 65px
        }

        @page:first {
        margin-top: 0;
        }

        @page {
            margin-top: 2cm;
        }

        .huruf {
          border: 1px solid black ;
          vertical-align: middle; 
          text-align:center; 
          font-size:12px;
        }

        .isi {
          border: 1px solid black; 
          font-size:12px;
        }

        .kop{
          font-size: 13px; 
        }
    </style>
  </head>
  <body onload="window.print()">
    <table>
        <tr>
            <td style="width: 100px">
                <center>
                    <img src="{{ asset('img/kop_surat/'.$kop->logo ) }}" alt="" style="width: 100px">
                </center>
            </td>
            
            <td  style="padding-left: 20px;">
                <center>
                    <b >
                        {{ $kop->nama_sekolah }}
                    </b><br>
                    <h4 class="kop">{{ $kop->alamat }}
                    - telp. {{ $kop->telp }} Fax. +622518665558<br>
                    e_mail: <a href="mailto:{{$kop->email}}" style="color: #006eff;font-size: 11px;">{{$kop->email}}</a> website: <a href="{{$kop->website}}" style="color: #006eff;font-size: 11px;">{{$kop->website}}</a><br>
                    CIBINONG-16913</h4>
                </center>
            </td>
        </tr>
    </table>
  <hr style="margin-top: 0px">
  <table  style="border: 1px solid black" id="tabel-data" style="width: 100%" class="table table-hover table-bordered dt-responsive">
    <thead>
      <tr>
        <th  class="huruf">No.</th>
        <th  class="huruf">No. Surat</th>
        <th  class="huruf">Tanggal Surat</th>
        <th  class="huruf">Tanggal Diterima</th>
        {{-- <th  class="huruf">Disposisi Jabatan</th>
        <th  class="huruf">Assign Tugas</th> --}}
        <th  class="huruf">Instansi</th>
        <th  class="huruf">Perihal</th>
        <th  class="huruf">Status Surat</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($surat_masuk as $item)
          <tr>
              <td  style="text-align: center;border: 1px solid black;  font-size:12px;">{{ $loop->iteration }}</td>
              <td  class="isi">{{ $item->no_surat }}</td>
              <td  class="isi"> {{ \Carbon\Carbon::parse($item->tgl_surat)->translatedFormat('d F Y') }}</td>
              <td  class="isi"> {{ \Carbon\Carbon::parse($item->diterima_tgl)->translatedFormat('d F Y') }}</td>
              {{-- <td  class="isi">
                @php
                    $arrayDisposisiJabatan2 = explode(',', trim($item->disposisi_jabatan, '[]'));
                @endphp

                @foreach ($arrayDisposisiJabatan2 as $dj)
                    @php
                    $jabatan = str_replace(['\\', '"'], '', trim($dj)) ?? '-';
                    @endphp

                    @if (count($arrayDisposisiJabatan2) > 1)
                        <ul>
                            <li>
                                {{ $jabatan }}
                            </li>
                        </ul>
                    @else
                        {{ $jabatan }}
                    @endif
                @endforeach
              </td> --}}
              {{-- <td>
                @php
                    $pegawaiDisposisi = \App\Models\DisposisiPegawai::where('id_surat',$item->id)->get(); 
                @endphp
                @foreach ($pegawaiDisposisi as $pd)
                    @if (count($pegawaiDisposisi) > 1)
                        <ul>
                            <li>
                                @php
                                    $pegawaiNama = \App\Models\User::where('id',$pd->id_pegawai)->first(); 
                                @endphp

                                {{ $pegawaiNama->name ?? '-' }}
                            </li>
                        </ul>
                    @else
                        {{ $pegawaiNama->name ?? '-' }}
                    @endif

                @endforeach
            </td> --}}
              <td  class="isi">{{ $item->instansi_pengirim }}</td>
              <td  class="isi">{{ $item->perihal }}</td>
              <td  class="isi">
                  @if ($item->status_surat == 1)
                  <span class="text-dark">Menunggu</span>
                  @elseif($item->status_surat == 2)
                  <span class="text-dark">Koreksi Kembali</span>
                  @elseif($item->status_surat == 3)
                  <span class="text-dark">Diajukan</span>
                  @elseif($item->status_surat == 4)
                  <span class="text-dark">Diverifikasi</span>
                  @elseif($item->status_surat == 5)
                  <span class="text-dark">Terdisposisi</span>
                  @endif
              </td>
          </tr>
      @endforeach
    </tbody>
  </table>
       

    </table>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</html>