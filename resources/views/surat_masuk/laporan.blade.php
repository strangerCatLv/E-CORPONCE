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
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />

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
<div class="row">
    <div class="card">
        <form action="" method="get">
            @csrf
        <div class="row">
            <div class="col-sm-4" style="padding-top: 10px; padding-bottom:10px">
                 <div class="form-group mb-3">
                    <label for="name">Tanggal Mulai</label>
                    <input type="date" class="form-control @error('start_date') is-invalid @enderror" id="start_date" name="start_date" value="{{ old('start_date') ?? Request::get('start_date') }}"  placeholder="Masukan Tanggal Surat">

                    @error('start_date')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="col-sm-4" style="padding-top: 10px; padding-bottom:10px">
                 <div class="form-group mb-3">
                    <label for="name">Tanggal Selesai</label>
                    <input type="date" class="form-control @error('end_date') is-invalid @enderror" id="end_date" name="end_date" value="{{ old('end_date') ?? Request::get('end_date') }}"  placeholder="Masukan Tanggal Surat">

                    @error('end_date')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            
            <div class="col-sm-4" style="padding-top: 10px; padding-bottom:10px">
                <div class="form-group mb-3">
                    <label for="name"></label> <br>
                    <button class="btn btn-primary" type="submit">Filter</button>
                    <a target="_blank" href="{{ url('print-laporan-surat-masuk?start_date='.Request::get('start_date').'&end_date='.Request::get('end_date')) }}" class="btn btn-success" type="submit">Print</a>
                </div>
            </div>
        </div>
    </form>
    </div>
</div>
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
        </div>

        <div class="row">
          <div class="col-6">
            @include('sweetalert::alert')
          </div>
        </div>
      </div>

      <div class="card-body">
        <div class="table-responsive">
          <table id="tabel-data" style="width: 100%" class="table table-hover table-bordered dt-responsive">
            <thead>
              <tr>
                <th style="vertical-align: middle; text-align:center;">No.</th>
                <th style="vertical-align: middle; text-align:center;">No. SUrat</th>
                <th style="vertical-align: middle; text-align:center;">Tanggal Surat</th>
                <th style="vertical-align: middle; text-align:center;">Tanggal Diterima</th>
                {{-- <th style="vertical-align: middle; text-align:center;">Disposisi Jabatan</th>
                <th style="vertical-align: middle; text-align:center;">Assign Tugas</th> --}}
                <th style="vertical-align: middle; text-align:center;">Instansi</th>
                <th style="vertical-align: middle; text-align:center;">Perihal</th>
                <th style="vertical-align: middle; text-align:center;">Status</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($surat_masuk as $item)
                  <tr>
                      <td style="text-align: center">{{ $loop->iteration }}</td>
                      <td>{{ $item->no_surat }}</td>
                      <td> {{ \Carbon\Carbon::parse($item->tgl_surat)->translatedFormat('d F Y') }}</td>
                      <td> {{ \Carbon\Carbon::parse($item->diterima_tgl)->translatedFormat('d F Y') }}</td>
                      {{-- <td>
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
                                        <span class="">{{ $jabatan }}</span>
                                    </li>
                                </ul>
                            @else
                                <span class="">{{ $jabatan }}</span>
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
                      <td>{{ $item->instansi_pengirim }}</td>
                      <td>{{ $item->perihal }}</td>
                      <td>
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
        </div>
      </div>
    </div>
  </div>
</div>
<script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function(){
    $('#tabel-data').DataTable();
});
</script>
@endsection

@section('script')

@endsection