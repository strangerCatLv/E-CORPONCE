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
    .select2-dropdown{
        z-index: 999999!important;
    }
    </style>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />

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
            @if(auth()->user()->can('surat-keluar-action'))
                <a href="{{ route('tambah-surat-keluar') }}" class="btn btn-primary" style="margin-right: 10px">
                    <i class="fa fa-plus"></i> 
                    TAMBAH SURAT KELUAR
                </a>
            @endif

            @if(auth()->user()->can('assign-tugas-action'))

            <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-md btn-info">
                <i class="fa fa-plus"></i> 
                ASSIGN TUGAS
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
                                    @foreach ($surat_keluar as $item2)
                                        <option value="{{ $item2->id }}">{{ $item2->no_surat.' | '.$item2->judul }}</option>
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
          <table id="tabel-data" style="width: 100%" class="table table-hover table-bordered dt-responsive">
            <thead>
              <tr>
                <th style="text-align: center">No.</th>
                <th style="text-align: center">Tanggal Surat</th>
                <th style="text-align: center">No. Surat</th>
                <th style="text-align: center">Perihal</th>
                <th style="text-align: center">Assign Tugas</th>
                <th style="text-align: center">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($surat_keluar as $item)
                  <tr>
                      <td style="text-align: center">{{ $loop->iteration }}</td>
                      <td> {{ \Carbon\Carbon::parse($item->tgl_surat)->translatedFormat('d F Y') }}</td>
                      <td>{{ $item->no_surat }}</td>
                      <td>{{ $item->judul }}</td>
                      {{-- <td>{{ $item->kepada }}</td> --}}
                      <td>
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
                     
                      <td>
                          <div class="btn-group">
                          @if(auth()->user()->can('surat-masuk-action'))
                              <a href="{{ route('edit-surat-keluar',$item->id) }}" class="btn btn-success f-12" >
                                  <i class="far fa-edit"></i>
                              </a>
                              <a href="{{ url('hapus-surat-keluar',$item->id) }}" class="btn btn-danger f-12">
                                  <i class="far fa-trash-alt"></i>
                              </a>
                              @if ($item->status_surat == 1)
                              <a href="{{ url('terbit-surat-keluar',$item->id) }}" class="btn btn-primary f-12">
                                  <i class="fas fa-check"></i>
                              </a>
                              @elseif($item->status_surat == 2)
                              <a href="{{ url('print-surat-keluar',$item->id) }}" target="_blank" class="btn btn-primary f-12">
                                  <i class="fas fa-print"></i>
                              </a>
                              @endif
                          @endif

                          <a href="#" data-bs-toggle="modal" data-bs-target="#assignTugas{{ $item->id }}" class="btn btn-success f-12" style="margin-left: 5px;">
                            Pegawai <i class="fas fa-print" ></i>
                        </a>                 
                            @if(auth()->user()->can('surat-keluar-action'))
                                <a href="{{ route('delete-surat-keluar',$item->id) }}" class="btn btn-danger" style="margin-left: 5px;" >
                                    <i class="fas fa-trash"></i>
                                </a>
                            @endif
    
                             
                          </div>
                      </td>
                  </tr>
              @endforeach
            </tbody>
          </table>

          @foreach ($surat_keluar as $item2)
          <div class="modal fade" id="assignTugas{{ $item2->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">List Pegawai</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <div class="table-responsive">
                    <table class="table table-hover table-bordered dt-responsive" id="userTable2">
                        <thead>
                            <tr>
                                <th >No</th>
                                <th width='40%'>Nama Pegawai</th>
                                <th width='40%'>Document Tugas</th>
                                @if(auth()->user()->can('assign-tugas-action'))
                                <th>Action</th>
                                @endif
                            </tr>
                        </thead>

                        <tbody>
                          @php
                               if (Auth::user()->tipe == 'Pegawai') {
                                    $assign_tugas = App\Models\AssignTugas::where('id_surat_keluar',$item2->id)->where('id_pegawai',Auth::user()->id)->orderBy('created_at','desc')->get();
                                } else {
                                    $assign_tugas = App\Models\AssignTugas::where('id_surat_keluar',$item2->id)->orderBy('created_at','desc')->get();
                                }
                          @endphp 
                            @foreach ($assign_tugas as $itemassign)
                                <tr>
                                    <td style="text-align: center">{{ $loop->iteration }}</td>
                                    <td>
                                        @php
                                            $user = \App\Models\User::where('id',$itemassign->id_pegawai)->first();
                                        @endphp
                                        {{ $user->name }}
                                    </td>
                                    <td>
                                      
                                        <a href="{{ url('print-surat-keluar',$item2->id) }}?user={{$user->id}}" target="_blank" class="btn btn-primary f-12">
                                            Document <i class="fas fa-print"></i>
                                        </a>
                                    </td>
                                    @if(auth()->user()->can('assign-tugas-action'))
                                    <td>
                                        <div class="btn-group">
                                        {{-- <a href="#" data-bs-toggle="modal" data-bs-target="#modal_edit{{ $itemassign->id }}" class="btn jarak-button btn-warning f-12" >
                                            <i class="far fa-edit"></i>
                                        </a> --}}
                                        <a href="{{ url('assign-tugas-destroy',$itemassign->id) }}" class="btn btn-danger f-12">
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
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
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
          @endforeach



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