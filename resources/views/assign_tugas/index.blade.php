@extends('layouts.app')

@section('style')
<style>
    .select2-dropdown{
        z-index: 999999!important;
    }
    .select2-selection__choice{
        color: black;
    }
</style>
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
                    <li class="breadcrumb-item active"><a href="{{ route('departements.index') }}">{{ ($breadcumb ?? '') }}</a></li>
                </ol>
            </div>

        </div>
    </div>
</div>
@endsection

@section('content')
<link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header" style="background-color: #da241b !important; border-radius:10px 10px 0px 0px;">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 mt-1 text-white" style="font-size:1.2rem;">
                            <span class="tx-bold tx-dark text-white text-lg">
                                <i class="far fa-building text-lg"></i>
                                {{ $page_title }}
                            </span>
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-6 d-flex justify-content-end">
                            @if(auth()->user()->can('assign-tugas-action'))

                            <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-md btn-info">
                                <i class="fa fa-plus"></i> 
                                Add New
                            </a>
                            @endif

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('assign-tugas-store') }}" method="post">
                                            @csrf
                                            <div class="form-group">
                                                <label for="">Pegawai</label>
                                                <select name="id_pegawai[]" multiple class="select2" id="" required>
                                                    @foreach ($pegawai as $item)
                                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Surat Tugas (Surat Keluar)</label>
                                                <select name="id_surat_keluar" class="form-control" id="" required>
                                                    @foreach ($surat_keluar as $item)
                                                        <option value="{{ $item->id }}">{{ $item->no_surat.' | '.$item->judul }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                    </div>
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save</button>
                                    </form>
                                    </div>
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
                        <table class="table table-hover table-bordered dt-responsive" id="userTable2">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th width='40%'>Name Pegawai</th>
                                    <th width='40%'>Surat Keluar</th>
                                    <th width='40%'>Document Tugas</th>
                                    @if(auth()->user()->can('assign-tugas-action'))
                                    <th>Action</th>
                                    @endif
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($assign_tugas as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            @php
                                                $user = \App\Models\User::where('id',$item->id_pegawai)->first();
                                            @endphp
                                            {{ $user->name }}
                                        </td>
                                        <td>
                                            @php
                                                $surat_keluar_view = \App\Models\SuratKeluar::where('id',$item->id_surat_keluar)->first();
                                            @endphp
                                            {{  $surat_keluar_view->judul  }}
                                        </td>
                                        <td>
                                          
                                            <a href="{{ url('print-surat-keluar',$surat_keluar_view->id) }}?user={{$user->id}}" target="_blank" class="btn btn-primary f-12">
                                                Document <i class="fas fa-print"></i>
                                            </a>
                                        </td>
                                        @if(auth()->user()->can('assign-tugas-action'))
                                        <td>
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#modal_edit{{ $item->id }}" class="btn jarak-button btn-warning f-12" >
                                                <i class="far fa-edit"></i>
                                            </a>
                                            <a href="{{ url('assign-tugas-destroy',$item->id) }}" class="btn btn-danger f-12">
                                                <i class="far fa-trash-alt"></i>
                                            </a>
                                        </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>


                @foreach ($assign_tugas as $itemEdit)
                    <div class="modal fade" id="modal_edit{{ $itemEdit->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Data</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('assign-tugas-update',$itemEdit->id) }}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label for="">Pegawai</label>
                                        <select name="id_pegawai" class="form-control" id="" required>
                                            @foreach ($pegawai as $p)
                                                <option value="{{ $p->id }}" {{ $itemEdit->id_pegawai == $p->id ? 'selected' : '' }}>{{ $p->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Surat Tugas (Surat Keluar)</label>
                                        <select name="id_surat_keluar" class="form-control" id="" required>
                                            @foreach ($surat_keluar as $surat)
                                                <option value="{{ $surat->id }}" {{ $itemEdit->id_surat_keluar == $surat->id ? 'selected' : '' }}>{{ $surat->no_surat.' | '.$surat->judul }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                            </form>
                            </div>
                        </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    
@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>

<script>
   $(document).ready(function() {
        $('#data-table').DataTable({});
    });
    $(function () {
        bsCustomFileInput.init();
        //Initialize Select2 Elements
        $('.select2').select2();
    })
</script>
@endsection