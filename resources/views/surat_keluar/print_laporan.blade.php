

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Laporan Surat Keluar</title>
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
        font-size: 12px; 
      }
  </style>
  </head>
  <body onload="window.print()">
    <table>
        <tr>
            <td style="width: 100px">
                <center>
                    <img src="{{ asset('img/kop_surat/'.$kop->logo ) }}" alt="" style="width: 70px">
                </center>
            </td>
            <td  style="padding-left: 50px;">
                <center>
                    <b >
                        {{ $kop->nama_sekolah }}
                    </b><br>
                    <h4 class="kop">{{ $kop->alamat }}<br>
                      telp. {{ $kop->telp }} Fax. +622518665558<br>
                      e_mail: <a href="mailto:{{$kop->email}}" style="color: #006eff;font-size: 11px;">{{$kop->email}}</a> website: <a href="{{$kop->website}}" style="color: #006eff;font-size: 11px;">{{$kop->website}}</a><br>
                      CIBINONG-16913</h4>
                </center>
            </td>
        </tr>
    </table>
  <hr style="margin-top: 0px;">
  <table  style="border: 1px solid black" id="tabel-data" style="width: 100%" class="table table-hover table-bordered dt-responsive">
    <thead>
      <tr>
        <th  class="huruf">No.</th>
        <th  class="huruf">Tanggal Surat</th>
        <th  class="huruf">No. Surat</th>
        <th  class="huruf">Perihal</th>
        <th  class="huruf">Assign Tugas</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($surat_keluar as $item)
          <tr>
              <td style="text-align: center;border: 1px solid black; font-size: 12px">{{ $loop->iteration }}</td>
              <td class="isi"> {{ \Carbon\Carbon::parse($item->tgl_surat)->translatedFormat('d F Y') }}</td>
              <td  class="isi">{{ $item->no_surat }}</td>
              <td class="isi">{{ $item->judul }}</td>
              <td class="isi">
                @php
                      if (Auth::user()->tipe == 'Pegawai') {
                          $assign_tugas = App\Models\AssignTugas::where('id_surat_keluar',$item->id)->where('id_pegawai',Auth::user()->id)->orderBy('created_at','desc')->get()->unique('id_pegawai');
                      }else{
                          $assign_tugas = App\Models\AssignTugas::where('id_surat_keluar',$item->id)->orderBy('created_at','desc')->get()->unique('id_pegawai');
                      }
                @endphp 
                  @foreach ($assign_tugas as $itemassign)
                  @php
                      $user = \App\Models\User::where('id',$itemassign->id_pegawai)->first();
                  @endphp
                    @if (count($assign_tugas) > 1)
                        <ul>
                            <li>
                              {{ $user->name }}
                            </li>
                        </ul>
                    @else
                        {{ $user->name }}
                    @endif
                  @endforeach
              </td>
         
          </tr>
      @endforeach
    </tbody>
  </table>

    </table>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</html>