@extends('layouts.app')

@section('style')

@endsection

@section('breadcumb')
  <div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">{{ ($breadcumb ?? '') }}</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item">home</li>
                    <li class="breadcrumb-item">/</li>
                    <li class="breadcrumb-item"><a href="{{ route('master-data.index') }}">Master Data</a></li>
                    <li class="breadcrumb-item">/</li>
                    <li class="breadcrumb-item active"><a href="{{ route('users.index') }}">{{ ($breadcumb ?? '') }}</a></li>
                </ol>
            </div>

        </div>
    </div>
  </div>
@endsection

@section('content')
<style>
    span{
        color: black;
    }
    label{
        color: rgb(0, 145, 255)
    }
    table{
        border: 1px;
    }
    </style>
<div class="row mt-4">
  <div class="col-12">
    <div class="card">
      <div class="card-header bg-gray1" style="border-radius:10px 10px 0px 0px;">
        <div class="row">
          <div class="col-6 mt-1">
            <span class="tx-bold text-lg text-white" style="font-size:1.2rem;">
              {{-- <i class="far fa-user text-lg"></i>  --}}
              {{ $page_title }}
            </span>
          </div>

          <div class="col-6 d-flex justify-content-end">
        </div>
        </div>

        <div class="row">
          <div class="col-6">
            @include('sweetalert::alert')
          </div>
        </div>
      </div>

      <div class="card-body">
        <div class="table-responsive">
            <table id="suratTable" class="table table-hover table-bordered dt-responsive">
              <thead>
                <tr>
                  <th style="vertical-align: middle; text-align:center;">No.</th>
                  <th style="vertical-align: middle; text-align:center;">No. Surat</th>
                  <th style="vertical-align: middle; text-align:center;">Tanggal Diterima</th>
                  <th style="vertical-align: middle; text-align:center;">Disposisi Jabatan</th>
                  <th style="vertical-align: middle; text-align:center;">Instansi</th>
                  <th style="vertical-align: middle; text-align:center;">Perihal</th>
                  <th style="vertical-align: middle; text-align:center;">Penerima Tugas</th>
                  @if(auth()->user()->can('surat-disposisi-action'))
                  <th style="vertical-align: middle; text-align:center;">Aksi</th>
                  @endif
    
                </tr>
              </thead>
              <tbody>
                @foreach ($surat_masuk as $item)
                    <tr>
                        <td style="text-align: center">{{ $loop->iteration }}</td>
                        <td>{{ $item->no_surat }}</td>
                        <td> {{ \Carbon\Carbon::parse($item->diterima_tgl)->translatedFormat('d F Y') }}</td>
                        <td>
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
                                            <span class="badge bg-success text-light">{{ $jabatan }}</span>
                                        </li>
                                    </ul>
                                @else
                                    <span class="badge bg-success text-light">{{ $jabatan }}</span>
                                @endif
                            @endforeach
                        </td>
                        <td>{{ $item->instansi_pengirim }}</td>
                        <td>{{ $item->perihal }}</td>
                        <td>
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
                        </td>
                        @if(auth()->user()->can('surat-disposisi-action'))
                        <td>
                            <div class="btn-group">
                                    <button type="button" class="btn btn-primary jarak-button" data-bs-toggle="modal" data-bs-target="#staticBackdrop{{ $item->id }}">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    {{-- <a href="{{ url('print-disposisi',$item->id) }}" target="_blank" class="btn btn-success" >
                                        <i class="fas fa-print"></i>
                                    </a> --}}
                                    <a href="{{ url('print-disposisi-v2',$item->id) }}" target="_blank" class="btn btn-success" >
                                        <i class="fas fa-print"></i>
                                    </a>
                                
                                <!-- Modal -->
                                <div class="modal fade" id="staticBackdrop{{ $item->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h5 class="modal-title" id="staticBackdropLabel">Detail Surat Masuk</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                       
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <table class="table table-striped table-hover" border="1">
                                                        <thead style="background-color: #da241b;color:white">
                                                            <tr>
                                                                <td colspan="2">
                                                                    <strong>NOMOR AGENDA ({{$item->no_surat}})</strong>  
                                                                </td>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
    
                                                            <tr>
                                                                <td>
                                                                    Kode 
                                                                </td>
                                                                <td>
                                                                    {{$item->no_agenda}}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    Berkas
                                                                </td>
                                                                <td>
                                                                    {{ $item->status }}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    Sifat
                                                                </td>
                                                                <td>
                                                                    {{ $item->sifat }}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    Diterima
                                                                </td>
                                                                <td>
                                                                    {{ \Carbon\Carbon::parse($item->diterima_tgl)->translatedFormat('d F Y') }}
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="col-sm-6">
                                                    <table class="table table-striped table-hover"border="1">
                                                        <thead style="background-color: #da241b;color:white">
                                                            <tr style="background: #da241b">
                                                                <td colspan="2"> <strong>STATUS SURAT</strong> </td>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>
                                                                    Status
                                                                </td>
                                                                <td>
                                                                    @if ($item->status_surat == 1)
                                                                    <span class="badge bg-warning text-light">Menunggu</span>
                                                                    @elseif($item->status_surat == 2)
                                                                    <span class="badge bg-danger text-light">Koreksi Kembali</span>
                                                                    @elseif($item->status_surat == 3)
                                                                    <span class="badge bg-primary text-light">Diajukan</span>
                                                                    @elseif($item->status_surat == 4)
                                                                    <span class="badge bg-primary text-light">Diverifikasi</span>
                                                                    @elseif($item->status_surat == 5)
                                                                    <span class="badge bg-success text-light">Terdisposisi</span>
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Tanggal</td>
                                                                <td>
                                                                    {{ \Carbon\Carbon::parse($item->tgl_surat)->translatedFormat('d F Y') }}
                                                                </td>
                                                            </tr>
                                                            @if ($item->status_surat != 1)
                                                            <tr>
                                                                <td>Tanggal Diajukan</td>
                                                                <td>
                                                                    {{ \Carbon\Carbon::parse($item->tgl_ajuan)->translatedFormat('d F Y') }}
                                                                </td>
                                                            </tr>
                                                            @endif
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
    
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <table class="table table-striped table-hover"border="1">
                                                        <thead style="background-color: #da241b;color:white">
                                                            <tr>
                                                                <th colspan="2">Informasi Detail Surat</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td><strong>No. Surat</strong></td>
                                                                <td>
                                                                    {{ $item->no_surat }} 
                                                                </td>
                                                            </tr>
                                                        <tbody>
                                                            <tr>
                                                                <td>Instansi</td>
                                                                <td>
                                                                    {{ $item->instansi_pengirim }} 
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Perihal</td>
                                                                <td>
                                                                    {{ $item->perihal }} 
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Tanggal Surat</td>
                                                                <td>
                                                                    {{ \Carbon\Carbon::parse($item->tgl_surat)->translatedFormat('d F Y') }}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Lampiran</td>
                                                                <td>
                                                                    {{ $item->lampiran }} 
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>File</td>
                                                                <td>
                                                                    <div class="button-group">
                                                                        {{-- <a href="{{ asset('documents/document-surat/'.$item->file) }}" target="_blank" class="btn btn-primary jarak-button">  <i class="fas fa-eye"></i> Priview</a> --}}
                                                                        <a href="{{ asset('documents/document-surat/'.$item->file) }}" download class="btn btn-primary">  <i class="fas fa-cloud-download-alt"></i> Download</a>
                                                                    </div> 
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
    
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <table class="table table-striped table-hover"border="1">
                                                        <thead style="background-color:orange">
                                                            <tr>
                                                                <td colspan="2">
                                                                    Petunjuk Kepala
                                                                </td>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>Disposisi Jabatan</td>
                                                                <td>
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
                                                                                    <span class="badge bg-success text-light">{{ $jabatan }}</span>
                                                                                </li>
                                                                            </ul>
                                                                        @else
                                                                            <span class="badge bg-success text-light">{{ $jabatan }}</span>
                                                                        @endif
                                                                    @endforeach
                                                                </td>

                                                            </tr>
                                                            @if ($item->status_surat == 5)
                                                            <tr>
                                                                <td>Penerima</td>
                                                                <td>
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
                                                                </td>
                                                             
                                                            </tr>
                                                            <tr>
                                                                <td>Tanggal Disposisi</td>
                                                                <td>
                                                                    {{ \Carbon\Carbon::parse($item->tgl_disposisi)->translatedFormat('d F Y') }}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Kepala Konsentrasi Keahlian</td>
                                                                <td>
                                                                    @php
                                                                        $arrayKPK = explode(',', trim($item->kepala_konsentrasi_keahlian, '[]'));
                                                                    @endphp
                                                                    @foreach ($arrayKPK as $kpk)
                                                                        @if (count($arrayKPK) > 1)
                                                                            <ul>
                                                                                <li>
                                                                                    {{ trim($kpk, '""') ?? '-' }}
                                                                                </li>
                                                                            </ul>
                                                                        @else
                                                                            {{ trim($kpk, '""') ?? '-' }}
                                                                        @endif
                                                                    @endforeach
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Intruksi</td>
                                                                <td>
                                                                    @php
                                                                        $arrayin = explode(',', trim($item->intruksi, '[]'));
                                                                    @endphp
                                                                    @foreach ($arrayin as $in)

                                                                        @php
                                                                            $intruksiAr = str_replace(['\\', '"'], '', trim($in)) ?? '-';
                                                                        @endphp
                                                                        @if (count($arrayin) > 1)
                                                                        <ul>
                                                                            <li>
                                                                                <span class="badge bg-success text-light">{{ trim($intruksiAr, '""') ?? '-' }}</span>
                                                                                
                                                                            </li>
                                                                        </ul>
                                                                        @else
                                                                            <span class="badge bg-success text-light">{{ trim($intruksiAr, '""') ?? '-' }}</span>
                                                                        @endif
                                                                    @endforeach
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Catatan Disposisi</td>
                                                                <td>{{ $item->catatan_disposisi }}</td>
                                                            </tr>
                                                            @endif
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            @if ($item->status_surat == 1)
                                            <form action="{{ route('update-surat-masuk',$item->id) }}" method="post">
                                            @elseif ($item->status_surat == 3)
                                                <form action="{{ route('verifikasi-surat-masuk',$item->id) }}" method="post">
                                            @elseif ($item->status_surat == 4)
                                                <form action="{{ route('disposisi-surat-masuk',$item->id) }}" method="post">
                                            @endif
                                                @csrf
                                                @if ($item->status_surat == 1)
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="form-group mb-3">
                                                            <label for="name">TINDAKAN SELANJUTNYA</label>
                                                            <select class="form-control" name="tindakan" id="tindakan" required>
                                                                <option disabled selected> <strong>--Pilih Tindakan--</strong></option>
                                                                <option value="Ajukan">Ajukan</option>
                                                            </select>
                                    
                                    
                                                            @error('tindakan')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                   
                                                    </div>
                                                    <div class="col-sm-6" id="tgl_ajuan" >
                                                        <div class="form-group mb-3">
                                                            <label for="name">TANGGAL AJUAN</label>
                                                            <input type="date" class="form-control @error('tgl_ajuan') is-invalid @enderror" id="tgl_ajuan" name="tgl_ajuan" value="{{ old('tgl_ajuan') }}"  placeholder="Masukan TGL. SURAT">
                                    
                                                            @error('tgl_ajuan')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row" id="catatanDiv">
                                                    <div class="col-lg-12">
                                                        <label for="name">CATATAN</label>
                                                        <input type="text" class="form-control @error('catatan') is-invalid @enderror" id="catatan" name="catatan" value="{{ old('catatan') }}"  placeholder="Masukan Catatan">
                                
                                                        @error('catatan')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                @endif
    
    
                                                @if ($item->status_surat == 3)
                                                <span>
                                                    <strong>ISIAN DAN CATATAN</strong>
                                                </span> <br>
                                                <span>
                                                    Lakukan disposisi jabatan untuk diteruskan ke pegawai. Berikan catatan tindakan untuk informasi tambahan!
                                                </span>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="form-group mb-3">
                                                            <label for="name"> <strong style="color: red"> Disposisi Jabatan </strong> </label>
                                                            <select class="form-control select2" name="disposisi_jabatan" id="disposisi_jabatan" required>
                                                                <option disabled selected> <strong>--Pilih Disposisi Jabatan--</strong></option>
                                                                @foreach ($roles as $role)
                                                                    <option value="{{ $role }}" {{ (old('role') == $role) ? 'selected' : '' }}>{{ $role }}</option>
                                                                @endforeach
                                                            </select>
                                    
                                    
                                                            @error('disposisi_jabatan')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                   
                                                    </div>
                                                    <div class="col-sm-6" id="tgl_ajuan" >
                                                        <div class="form-group mb-3">
                                                            <label for="name"> <strong>CATATAN</strong></label>
                                                            <input type="text" class="form-control @error('catatan_tindak_lanjut') is-invalid @enderror" id="catatan_tindak_lanjut" name="catatan_tindak_lanjut" value="{{ old('catatan_tindak_lanjut') }}"  placeholder="Masukan Catatan Tindak Lanjut" required>
                                    
                                                            @error('catatan_tindak_lanjut')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="form-group mb-3">
                                                            <label for="name"> <strong> Tindakan Segera/Kilat </strong> </label>
                                                            <input type="text" class="form-control @error('tindakan_segera') is-invalid @enderror" id="tindakan_segera" name="tindakan_segera" value="{{ old('tindakan_segera') }}"  placeholder="Masukan Tindakan Segera/Kilat" required>
                                                            @error('tindakan_segera')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                   
                                                    </div>
                                                    <div class="col-sm-6" id="tgl_ajuan" >
                                                        <div class="form-group mb-3">
                                                            <label for="name"> <strong> Tindakan Biasa</strong> </label>
                                                            <input type="text" class="form-control @error('tindakan_biasa') is-invalid @enderror" id="tindakan_biasa" name="tindakan_biasa" value="{{ old('tindakan_biasa') }}"  placeholder="Masukan Tindakan Biasa" required>
                                                            @error('tindakan_biasa')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                               
                                                @endif
                                      
                                                @if ($item->status_surat == 4)
                                                <span>
                                                    <strong>ISIAN DAN CATATAN</strong>
                                                </span> <br>
                                                <span>
                                                    Lakukan disposisi jabatan untuk diteruskan ke pegawai. Berikan catatan dan pilih pegawai disposisi!
                                                </span>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="form-group mb-3">
    
                                                            <label for="name"> <strong>TANGGAL DISPOSISI</strong></label>
                                                            <input type="date" class="form-control @error('tgl_disposisi') is-invalid @enderror" id="tgl_disposisi" name="tgl_disposisi" value="{{ old('tgl_disposisi') }}"  placeholder="Masukan Catatan Tindak Lanjut" required>
                                    
                                                            @error('tgl_disposisi')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                            
                                                        </div>
                                                   
                                                    </div>
                                                    <div class="col-sm-6" id="tgl_ajuan" >
                                                        <label for="name"> <strong style="color: red"> Disposisi Pegawai </strong> </label>
                                                            <select class="form-control select2" name="id_pegawai_disposisi" id="id_pegawai_disposisi" required>
                                                                <option disabled selected> <strong>--Pilih Disposisi Pegawai--</strong></option>
                                                                @foreach ($pegawai as $users)
                                                                    <option value="{{ $users->id }}" {{ (old('id_pegawai_disposisi') == $users->id) ? 'selected' : '' }}>{{ $users->name }}</option>
                                                                @endforeach
                                                            </select>
                                    
                                    
                                                            @error('id_pegawai_disposisi')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="form-group mb-3">
                                                            <label for="name"> <strong> Catatan </strong> </label>
                                                            <input type="text" class="form-control @error('catatan_disposisi') is-invalid @enderror" id="catatan_disposisi" name="catatan_disposisi" value="{{ old('catatan_disposisi') }}"  placeholder="Masukan Catatan Disposisi" required>
                                                            @error('catatan_disposisi')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                   
                                                    </div>
                                                </div>
                                               
                                                @endif
                                      
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
                                        </div>
                                    </form>
                                    </div>
                                    </div>
                                </div>
    
                            </div>
                        </td>
                        @endif
    
                    </tr>
                @endforeach
              </tbody>
            </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('script')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('#suratTable').DataTable({
            "paging":   true,
            "ordering": true,
            "info":     true
        });
$('.select2').select2();

    // Sembunyikan kolom catatan saat halaman pertama kali dimuat
    $("#catatanDiv").hide();
    $("#tgl_ajuan").hide();

    // Event handler ketika nilai dropdown berubah
    $("#tindakan").change(function() {
        // Periksa apakah nilai dropdown adalah "Koreksi Kembali"
        if ($(this).val() === "Koreksi Kembali") {
            // Jika "Koreksi Kembali" dipilih, tampilkan kolom catatan
            $("#catatanDiv").show();
            $("#tgl_ajuan").hide();
        } else {
            $("#tgl_ajuan").show();

            // Jika yang lain dipilih, sembunyikan kolom catatan
            $("#catatanDiv").hide();
        }
    });
});
</script>

@endsection