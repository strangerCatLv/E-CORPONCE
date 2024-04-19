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
.select2-dropdown{
    z-index: 999999!important;
}
</style>
{{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/css/select2.min.css" rel="stylesheet" /> --}}
<link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
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
    .form-container { margin-top: 50px; min-height: 350px;}
    .bs-callout { padding: 10px 20px; margin: 20px 0; border: 1px solid #c6eaf5; border-left-width: 5px; border-radius: 3px; background: #ddf6fd; color: #1b809e;}
    .bs-callout-info { border-left-color: #1b809e;}
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
              <!-- Button trigger modal -->
            @if(auth()->user()->can('surat-masuk-action-create'))
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                <i class="fa fa-plus"></i> 
                  TAMBAH SURAT MASUK
            </button>
            @endif
            
            <!-- Modal -->
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">DATA SURAT MASUK</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('surat-masuk-store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                    <div class="modal-body">
                    <span>
                        <strong>INFORMASI UMUM</strong>
                    </span> <br>
                    <span>
                        Lengkapi Informasi pada surat masuk
                    </span>
                    <hr>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group mb-3">
                                <label for="name">NO. SURAT</label>
                                <input type="text" class="form-control @error('no_surat') is-invalid @enderror" id="no_surat" name="no_surat" value="{{ old('no_surat') }}"  placeholder="Masukan NO. Surat" required>
        
                                @error('no_surat')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                                <div class="form-group mb-3">
                                    <label for="name">INSTANSI PENGIRIM</label>
                                    <input type="text" class="form-control @error('instansi_pengirim') is-invalid @enderror" id="instansi_pengirim" name="instansi_pengirim" value="{{ old('instansi_pengirim') }}"  placeholder="Masukan INSTANSI PENGIRIM" required>
            
                                    @error('instansi_pengirim')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group mb-3">
                                        <label for="name">TANGGAL SURAT</label>
                                        <input type="date" class="form-control @error('tgl_surat') is-invalid @enderror" id="tgl_surat" name="tgl_surat" value="{{ old('tgl_surat') }}"  placeholder="Masukan TGL. SURAT" required>
                
                                        @error('tgl_surat')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group mb-3">
                                        <label for="name">TANGGAL DITERIMA</label>
                                        <input type="date" class="form-control @error('diterima_tgl') is-invalid @enderror" id="diterima_tgl" name="diterima_tgl" value="{{ old('diterima_tgl') }}"  placeholder="Masukan DITERIMA TGL" required>
                
                                        @error('diterima_tgl')
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
                                        <label for="name">NO. AGENDA</label>
                                        <input type="text" class="form-control @error('no_agenda') is-invalid @enderror" id="no_agenda" name="no_agenda" value="{{ old('no_agenda') }}"  placeholder="Masukan NO. AGENDA" required>
                
                                        @error('no_agenda')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group mb-3">
                                        <label for="name">KLASIFIKASI</label>
                                        <input type="text" class="form-control @error('klasifikasi') is-invalid @enderror" id="klasifikasi" name="klasifikasi" value="{{ old('klasifikasi') }}"  placeholder="Masukan KLASIFIKASI" required>
                
                                        @error('klasifikasi')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                           
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group mb-3">
                                <label for="name">PERIHAL SURAT</label>
                                <input type="text" class="form-control @error('perihal') is-invalid @enderror" id="perihal" name="perihal" value="{{ old('perihal') }}"  placeholder="Masukan PERIHAL SURAT" required>
        
                                @error('perihal')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <span>
                        <strong>INFORMASI TAMBAHAN</strong>
                    </span> <br>
                    <span>
                        Silahkan lengkapi jumlah lampiran, status, dan sifat tindakan surat!
                    </span>
                    <hr>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group mb-3">
                                <label for="name">LAMPIRAN</label>
                                <input type="text" class="form-control @error('lampiran') is-invalid @enderror" id="lampiran" name="lampiran" value="{{ old('lampiran') }}"  required>
                                @php
                                    $loop = range(0,2);
                                @endphp
                                <small class="text-danger">*Ex :
                                    @foreach ($loop as $item)
                                        {{ $item }} lampiran ,
                                    @endforeach Dst.
                                </small>
        
                                @error('lampiran')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group mb-3">
                                <label for="name">STATUS</label>
                                <select class="form-control" name="status" required>
                                    <option disabled selected> <strong>--STATUS--</strong></option>
                                    <option value="Asli">Asli</option>
                                    <option value="Tembusan">Tembusan</option>
                                </select>
        
        
                                @error('status')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group mb-3">
                                <label for="name">SIFAT</label>
                                <select class="form-control" name="sifat" required>
                                    <option disabled selected> <strong>--Pilih Sifat Berkas--</strong></option>
                                    <option value="Rahasia">Rahasia</option>
                                    <option value="Sangat Penting">Sangat Penting</option>
                                    <option value="Mendesak">Mendesak</option>
                                    <option value="Penting">Penting</option>
                                    <option value="Segera">Segera</option> 
                                    <option value="Biasa">Biasa</option>   
                                </select>
        
        
                                @error('status')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <span>
                        <strong>UNGGAH FILE SURAT</strong>
                    </span> <br>
                    <span>
                        Silahkan unggah file surat dalam satu file!
                    </span>
                    <hr>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group mb-3">
                                <label for="name">UPLOAD FILE</label>
                                <input type="file" class="form-control @error('file') is-invalid @enderror" id="file" name="file" value="{{ old('file') }}"  required>
                                <small style="color: red"><strong>* Semua type file diizinkan!</strong></small>
                                @error('file')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                </form>
                </div>
                </div>
            </div>

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
            <table id="data-table" class="table table-hover table-bordered dt-responsive">
              <thead>
                <tr>
                  <th style="text-align: center; vertical-align: middle;">No.</th>
                  <th style="text-align: center; vertical-align: middle;">No. Surat</th>
                  <th style="text-align: center; vertical-align: middle;">Tanggal Diterima</th>
                  <th style="text-align: center; vertical-align: middle;">Disposisi Jabatan</th>
                  <th style="text-align: center; vertical-align: middle;">Assign Tugas</th>
                  <th style="text-align: center; vertical-align: middle;">Instansi</th>
                  <th style="text-align: center; vertical-align: middle;">Perihal</th>
                  <th style="text-align: center; vertical-align: middle;">Status</th>
                    @if(auth()->user()->can('surat-masuk-action-detail'))
                    <th style="text-align: center; vertical-align: middle;">Aksi</th>
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

                        <td>{{ $item->instansi_pengirim }}</td>
                        <td>{{ $item->perihal }}</td>
                        <td >
                            @if ($item->status_surat == 1)
                                @if ($item->catatan_penolakan != null)
                                    <span class="badge bg-danger text-light">Ditolak</span> <br>
    
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#penolakan{{ $item->id }}">
                                        Lihat Catatan
                                    </button>
                                    
                                    <!-- Modal -->
                                    <div class="modal fade" id="penolakan{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Catatan</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                             {{ $item->catatan_penolakan }}
                                            </div>
                                            <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                @else
                                    <span class="badge bg-warning text-light">Menunggu</span>
                                @endif
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
                    @if(auth()->user()->can('surat-masuk-action-detail'))
                        <td>
                            <div class="btn-group">
    
                                
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop{{ $item->id }}" style="margin-right:5px">
                                    <i class="fas fa-eye"></i>
                                </button>

                                <a href="{{ route('delete-surat-masuk',$item->id) }}" class="btn btn-danger" >
                                    <i class="fas fa-trash"></i>
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
                                                                    <strong>NOMOR SURAT ({{$item->no_surat}})</strong>  
                                                                </td>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
    
                                                            <tr>
                                                                <td>
                                                                    No. Agenda 
                                                                </td>
                                                                <td>
                                                                    {{$item->no_agenda}}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    Status Berkas
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
                                                                        @if ($item->catatan_penolakan != null)
                                                                            <span class="badge bg-danger text-light">Ditolak</span>
                                                                        @else
                                                                            <span class="badge bg-primary text-light">Diajukan</span>
                                                                        @endif
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
                                                                        {{-- <a href="{{ asset('documents/document-surat/'.$item->file) }}" target="_blank" class="btn btn-primary">  <i class="fas fa-eye"></i> Priview</a> --}}
                                                                        <a href="{{ asset('documents/document-surat/'.$item->file) }}" download class="btn btn-primary">  <i class="fas fa-cloud-download-alt"></i> Download</a>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            @if ($item->status_surat != 1)
                                                                <tr>
                                                                    <td>Tanggal Pengajuan</td>
                                                                    <td>
                                                                        {{ \Carbon\Carbon::parse($item->tgl_ajuan)->translatedFormat('d F Y') }}
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Catatan TU Umum</td>
                                                                    <td>
                                                                        {{ $item->catatan }} 
                                                                    </td>
                                                                </tr>
                                                            @endif
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
    
                                            @if ($item->status_surat == 4 || $item->status_surat == 5)
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <table class="table table-striped table-hover"border="1">
                                                        <thead style="background-color:orange">
                                                            <tr>
                                                                <td colspan="2">
                                                                    Petunjuk Kepala Sekolah
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
                                                                    {{-- <span class="badge bg-success text-light">{{ $item->disposisi_jabatan ?? '-' }}</span> --}}
                                                                </td>
                                                            </tr>
                                                            @if ($item->status_surat == 3 && $item->catatan_penolakan != null)
                                                            <tr>
                                                                <td>Catatan Penolakan</td>
                                                                <td>{{ $item->catatan_penolakan ?? '-' }}</td>
                                                            </tr>
                                                            @endif
                                                           
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
                                                                    {{-- {{ $item->intruksi }} --}}
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
                                            @endif
    
                                           
                                        {{-- @if(auth()->user()->can('surat-masuk-action-verifikasi') || auth()->user()->can('surat-masuk-action')) --}}
    
                                            @if ($item->status_surat == 1)
                                            <form action="{{ route('update-surat-masuk',$item->id) }}" method="post">
                                            @elseif ($item->status_surat == 3)
                                                <form action="{{ route('verifikasi-surat-masuk',$item->id) }}" method="post">
                                            @elseif ($item->status_surat == 4)
                                                <form action="{{ route('disposisi-surat-masuk',$item->id) }}" method="post">
                                            @endif
                                                @csrf
                                                @if (auth()->user()->can('surat-masuk-action-pengajuan'))
                                                    @if ($item->status_surat == 1)
                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <div class="form-group mb-3">
                                                                    <label for="name">TINDAKAN SELANJUTNYA</label>
                                                                    <select class="form-control" name="tindakan" id="tindakan" required>
                                                                        <option disabled selected> <strong>--Pilih Tindakan--</strong></option>
                                                                        <option value="Ajukan">Ajukan ke Kepala Sekolah</option>
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
                                                                    <input type="date" class="form-control @error('tgl_ajuan') is-invalid @enderror" id="tgl_ajuan" name="tgl_ajuan" value="{{ old('tgl_ajuan') }}"  placeholder="Masukan TGL. SURAT" required>
                                            
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
                                                @endif
    
                                                @if ($item->status_surat == 3)
                                                @if (auth()->user()->can('surat-masuk-action-verifikasi'))
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="form-group mb-3">
                                                                <label for="name">TINDAKAN SELANJUTNYA</label>
                                                                <select class="form-control" name="tindakan" id="tindakan" required>
                                                                    <option disabled selected> <strong>--Pilih Tindakan--</strong></option>
                                                                    <option value="Ditolak">Ditolak</option>
                                                                    <option value="Disposisi">Verifikasi</option>
                                                                </select>
                                        
                                        
                                                                @error('tindakan')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                                @endif
    
                                                <div class="disposisi" style="display: none;">
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
                                                                @php
                                                                    $jabatan_list = [
                                                                        "Ketua Tim Penjamin Mutu Pendidikan Sekolah (TPMPS)",
                                                                        "Wakasek Bidang Akademik",
                                                                        "Wakasek Bidang Kesiswaan",
                                                                        "Wakasek Bidang Sarana Prasarana",
                                                                        "Wakasek Bidang Hub. DU/DI",
                                                                        "Bidang Kurikulum",
                                                                        "Bursa Kerja Khusus (BKK)",
                                                                        "Bidang PKL/Magang",
                                                                        "Staf Bidang Tertentu",
                                                                        "Koordinator Bidang Tertentu",
                                                                        "Kepala Kompetensi Keahlian",
                                                                        "Bidang Kesiswaan",
                                                                        "Bidang Sarana Prasarana",
                                                                        "Arsiparis Ahli Muda",
                                                                        "Pengadministrasi Kepegawaian",
                                                                        "Pengadministrasi Keuangan",
                                                                        "Pengadministrasi Kesiswaan",
                                                                        "Pengadministrasi Kurikulum",
                                                                        "Pengadministrasi Hub. DU/Di",
                                                                        "Pengadministrasi Persuratan",
                                                                        "Pengadministrasi Perpustakaan",
                                                                        "Pengelola Data/Operator DAPODIK",
                                                                        "Sarana Prasarana",
                                                                        "Pengelola UKS dan Resepsionis",
                                                                        "Pustakawan",
                                                                        "Teknisi/Toolman",
                                                                        "Satuan Pengaman",
                                                                        "Petugas Logistik",
                                                                        "Driver"
                                                                    ];
                                                                @endphp
                                                                <label for="name"> <strong style="color: red"> Disposisi Jabatan </strong> </label>
                                                                <select class="form-control " name="disposisi_jabatan" id="disposisi_jabatan" required>
                                                                    <option disabled selected> <strong>--Pilih Disposisi Jabatan--</strong></option>
                                                                    @foreach ($jabatan_list as $jbt)
                                                                        <option value="{{$jbt}}">{{$jbt}}</option>
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
                                                                <input type="text" class="form-control @error('catatan_tindak_lanjut') is-invalid @enderror" id="catatan_tindak_lanjut" name="catatan_tindak_lanjut" value="{{ old('catatan_tindak_lanjut') }}"  placeholder="Masukan Catatan Tindak Lanjut" >
                                        
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
                                                                <input type="text" class="form-control @error('tindakan_segera') is-invalid @enderror" id="tindakan_segera" name="tindakan_segera" value="{{ old('tindakan_segera') }}"  placeholder="Masukan Tindakan Segera/Kilat" >
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
                                                                <input type="text" class="form-control @error('tindakan_biasa') is-invalid @enderror" id="tindakan_biasa" name="tindakan_biasa" value="{{ old('tindakan_biasa') }}"  placeholder="Masukan Tindakan Biasa" >
                                                                @error('tindakan_biasa')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
    
                                             
                                                   
                                                    @endif
                                                </div>
    
                                               
                                                <div class="pesan" style="display: none;">
                                                    <div class="row">
                                                        <div class="form-group mb-3">
                                                            <label for="name"> <strong style="color: red"> Catatan </strong> </label>
                                                            <textarea name="catatan_penolakan" id="" cols="30" rows="10" class="form-control"></textarea>
                                                           
                                    
                                                            @error('catatan_penolakan')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                        
                                                @if ($item->status_surat == 4)
                                                    @if (auth()->user()->can('surat-masuk-action-disposisi'))
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
                                                                    {{-- <div class="form-group">
                                                                        <button type="button" id="addEmail" class="btn btn-primary" style="float: right">Add</button> 
                                                                        <button type="button" id="removeEmail" class="btn btn-warning" style="float: right">Remove last</button>
                                                                    </div>
                                                                     --}}
                                                                    <div class="form-group">
                                                                        <label for="exampleInputEmail1"><strong>Pegawai</strong></label>
                                                                        <select class="form-control mb-1 select2" name="id_pegawai_disposisi[]" id="id_pegawai_disposisi" multiple required>
                                                                            <option disabled> <strong>--Pilih Disposisi Pegawai--</strong></option>
                                                                            @foreach ($pegawai as $users)
                                                                                <option value="{{ $users->id }}" {{ (old('id_pegawai_disposisi') == $users->id) ? 'selected' : '' }}>{{ $users->name }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <div id="more-email"></div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <div class="form-group mb-3 select2-purple">
    
                                                                    <label for="name"> <strong>Kepala Konsentrasi Keahlian</strong></label><br>
                                                                    <select class="mb-1 select2" name="kepala_konsentrasi_keahlian[]" id="kepala_konsentrasi_keahlian" data-placeholder="Pilih Kepala Konsentrasi Keahlian" multiple data-dropdown-css-class="select2-purple" style="width: 100%;">
                                                                        <option value=""> <strong>--Pilih Kepala Konsentrasi Keahlian--</strong></option>
                                                                        <option value="TKP"> <strong>TKP</strong></option>
                                                                        <option value="DPIB"> <strong>DPIB</strong></option>
                                                                        <option value="TP"> <strong>TP</strong></option>
                                                                        <option value="TKR"> <strong>TKR</strong></option>
                                                                        <option value="TFLM"> <strong>TFLM</strong></option>
                                                                        <option value="TOI"> <strong>TOI</strong></option>
                                                                        <option value="RPL"> <strong>RPL</strong></option>
                                                                        <option value="SIJA"> <strong>SIJA</strong></option>
                                                                        <option value="TKJ"> <strong>TKJ</strong></option>
                                                                        <option value="DKV"> <strong>DKV</strong></option>
                                                                    </select>
                                                                    @error('tgl_disposisi')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                    
                                                                </div>
                                                        
                                                            </div>
                                                            <div class="col-sm-6" id="tgl_ajuan" >
                                                                    <div class="form-group">
                                                                        <label for=""><strong>Intruksi</strong></label>
                                                                        <select class="form-control mb-1 intruksi select2" multiple name="intruksi[]" id="intruksi" required onchange="showInput()">
                                                                            <option disabled> <strong>--Pilih Intruksi--</strong></option>
                                                                            <option value="Wakili/hadiri laporkan hasilnya">Wakili/hadiri laporkan hasilnya</option>
                                                                            <option value="Baca, pahami, berikan saran">Baca, pahami, berikan saran</option>
                                                                            <option value="Koordinasikan dengan tim">Koordinasikan dengan tim</option>
                                                                            <option value="Tindaklanjuti/fasilitasi/penuhi sesuai ketentuan">Tindaklanjuti/fasilitasi/penuhi sesuai ketentuan</option>
                                                                            <option value="Untuk dijawab secara tertulis">Untuk dijawab secara tertulis</option>
                                                                            <option value="Buatkan konsep ijin/rekomendasi">Buatkan konsep ijin/rekomendasi</option>
                                                                            <option value="Catat dan arsipkan">Catat dan arsipkan</option>
                                                                            <option value="Jadikan pedoman">Jadikan pedoman</option>
                                                                            <option value="Siapkan pointer/Sambutan/Bahan">Siapkan pointer/Sambutan/Bahan</option>
                                                                            <option value="Other">Lainnya</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group d-none otherInput" id="">
                                                                        <label for="other">Masukkan instruksi lainnya:</label>
                                                                        <input type="text" class="form-control"  name="other_instruksi">
                                                                    </div>
                                                            </div>
                                                            <div class="col-sm-12" >
                                                                @php
                                                                    $jabatan_list = [
                                                                        "Ketua Tim Penjamin Mutu Pendidikan Sekolah (TPMPS)",
                                                                        "Wakasek Bidang Akademik",
                                                                        "Wakasek Bidang Kesiswaan",
                                                                        "Wakasek Bidang Sarana Prasarana",
                                                                        "Wakasek Bidang Hub. DU/DI",
                                                                        "Bidang Kurikulum",
                                                                        "Bursa Kerja Khusus (BKK)",
                                                                        "Bidang PKL/Magang",
                                                                        "Staf Bidang Tertentu",
                                                                        "Koordinator Bidang Tertentu",
                                                                        "Kepala Kompetensi Keahlian",
                                                                        "Bidang Kesiswaan",
                                                                        "Bidang Sarana Prasarana",
                                                                        "Arsiparis Ahli Muda",
                                                                        "Pengadministrasi Kepegawaian",
                                                                        "Pengadministrasi Keuangan",
                                                                        "Pengadministrasi Kesiswaan",
                                                                        "Pengadministrasi Kurikulum",
                                                                        "Pengadministrasi Hub. DU/Di",
                                                                        "Pengadministrasi Persuratan",
                                                                        "Pengadministrasi Perpustakaan",
                                                                        "Pengelola Data/Operator DAPODIK",
                                                                        "Sarana Prasarana",
                                                                        "Pengelola UKS dan Resepsionis",
                                                                        "Pustakawan",
                                                                        "Teknisi/Toolman",
                                                                        "Satuan Pengaman",
                                                                        "Petugas Logistik",
                                                                        "Driver"
                                                                    ];
                                                                @endphp
                                                                <label for="name"> <strong style="color: red"> Jabatan </strong> </label>
                                                                <select class="select2 " multiple name="jabatan[]" id="jabatan">
                                                                    <option disabled> <strong>--Pilih Jabatan--</strong></option>
                                                                    @foreach ($jabatan_list as $jbt)
                                                                        <option value="{{$jbt}}">{{$jbt}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <div class="form-group mb-3">
                                                                    <label for="name"> <strong> Catatan </strong> </label>
                                                                    <input type="text" class="form-control @error('catatan_disposisi') is-invalid @enderror" id="catatan_disposisi" name="catatan_disposisi" value="{{ old('catatan_disposisi') }}"  placeholder="Masukan Catatan Disposisi">
                                                                    @error('catatan_disposisi')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                        
                                                            </div>
                                                        </div>
                                                    @endif
                                                
                                                @endif
                                            {{-- @endif --}}
                                      
                                        </div>
                                        <div class="modal-footer">
                                            @if ($item->status_surat == 1 )
                                                @if(auth()->user()->can('surat-masuk-action-pengajuan'))
                                                    <button type="submit" class="btn btn-primary">Ajukan</button>
                                                @endif
                                            @elseif($item->status_surat == 3)
                                                @if(auth()->user()->can('surat-masuk-action-verifikasi'))
                                                    <button type="submit" class="btn btn-primary">Verifikasi</button>
                                                @endif
                                            
                                            @elseif($item->status_surat == 4)
                                                @if(auth()->user()->can('surat-masuk-action-disposisi'))
                                                    <button type="submit" class="btn btn-primary">Disposisi</button>
                                                @endif
                                            @endif
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
{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>

<script>
    function showInput() {
        var selectBox = $('.intruksi').val();
        console.log(selectBox);
        if (selectBox === "Other") {
            $('.otherInput').removeClass("d-none");
        } else {
            $('.otherInput').addClass("d-none");
        }
    }
    $(function () {
        bsCustomFileInput.init();
        //Initialize Select2 Elements
        $('.select2').select2();

       
    })

    $(document).ready(function() {
        $('#data-table').DataTable({});

        // Sembunyikan kolom catatan saat halaman pertama kali dimuat
        $("#catatanDiv").hide();
        $("#tgl_ajuan").hide();

        $("#tindakan").change(function() {
            if ($(this).val() === "Koreksi Kembali") {
                $("#catatanDiv").show();
                $("#tgl_ajuan").hide();
            } else {
                $("#tgl_ajuan").show();
                $("#catatanDiv").hide();
            }
        });
    });

    $(document).ready(function() {  
        $("#addEmail").on("click", function() {  
            $("#more-email").append('<div class="form-group"><label for="exampleInputEmail1">Alternate email address</label><select class="form-control mb-1" name="id_pegawai_disposisi[]" id="id_pegawai_disposisi" required><option disabled selected> <strong>--Pilih Disposisi Pegawai--</strong></option>@foreach ($pegawai as $user)<option value="{{ $user->id }}">{{ $user->name }}</option>@endforeach</select></div>');  
        });  
        $("#removeEmail").on("click", function() {  
            $("#more-email").children().last().remove();  
        });  
    });  

    document.getElementById("tindakan").addEventListener("change", function () {
        var selectedValue = this.value;
        var disposisiDiv = document.querySelector(".disposisi");
        var pesanDiv = document.querySelector(".pesan");

        if (selectedValue === "Disposisi") {
            disposisiDiv.style.display = "block";
            pesanDiv.style.display = "none";
        } else if (selectedValue === "Ditolak") {
            disposisiDiv.style.display = "none";
            pesanDiv.style.display = "block";
        } else {
            disposisiDiv.style.display = "none";
            pesanDiv.style.display = "none";
        }
    });
</script>
@endsection