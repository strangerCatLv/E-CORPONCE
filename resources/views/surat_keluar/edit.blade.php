@extends('layouts.app')

@section('style')
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.css" rel="stylesheet">
@endsection

@section('breadcumb')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-cMasukan justify-content-between">
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
<div class="row mt-4">
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header text-cMasukan bg-gray1" style="border-radius:10px 10px 0px 0px;">
                <h3 class="card-title text-white">{{ $page_title }}</h3>
            </div>

            <form action="{{ route('update-surat-keluar',$surat_keluar->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @include('components.form-message')

                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group mb-3">
                                        <label for="name">Tanggal Surat</label>
                                        <input type="date" class="form-control @error('tgl_surat') is-invalid @enderror" id="tgl_surat" name="tgl_surat" value="{{ old('tgl_surat') ?? $surat_keluar->tgl_surat }}"  placeholder="Masukan Tanggal Surat" required>
                
                                        @error('tgl_surat')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group mb-3">
                                        <label for="name">Jenis Surat</label>
                                        <select name="jenis" class="form-control @error('tgl_surat') is-invalid @enderror"  required>
                                            <option value="TTE">TTE</option>
                                            <option value="Asli">Asli</option>
                                        </select>
                
                                        @error('jenis')
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
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group mb-3">
                                                <label for="name">NO AWAL</label>
                                                <input type="text" class="form-control @error('no_awal') is-invalid @enderror" id="no_awal" name="no_awal" value="{{ old('no_awal') ?? $surat_keluar->no_awal }}"  placeholder="Masukan No Awal" required>
                        
                                                @error('no_awal')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group mb-3">
                                                <label for="name">NO URUT SEMENTARA</label>
                                                <input type="text" class="form-control @error('no_urut_sementara') is-invalid @enderror" id="no_urut_sementara" name="no_urut_sementara" value="{{ old('no_urut_sementara') ?? $surat_keluar->no_urut_sementara }}"  placeholder="Masukan No Urut Sementara" required>
                        
                                                @error('no_urut_sementara')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group mb-3">
                                        <label for="name">NO SURAT</label>
                                        <input type="text" class="form-control @error('no_surat') is-invalid @enderror" id="no_surat" name="no_surat" value="{{ old('no_surat') ?? $surat_keluar->no_surat }}"  placeholder="Masukan No Surat"  required>
                
                                        @error('no_surat')
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
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group mb-3">
                                                <label for="name">LAMPIRAN</label>
                                                <input type="text" class="form-control @error('lampiran') is-invalid @enderror" id="lampiran" name="lampiran" value="{{ old('lampiran') ?? $surat_keluar->lampiran }}"  placeholder="Masukan Lampiran"   required>
                        
                                                @error('lampiran')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group mb-3">
                                                <label for="name">SIFAT</label>
                                                <input type="text" class="form-control @error('sifat') is-invalid @enderror" id="sifat" name="sifat" value="{{ old('sifat') ?? $surat_keluar->sifat }}"  placeholder="Masukan Sifat"   required>
                        
                                                @error('sifat')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group mb-3">
                                        <label for="name">PERIHAL/JUDUL SURAT</label>
                                        <input type="text" class="form-control @error('judul') is-invalid @enderror" id="judul" name="judul" value="{{ old('judul') ?? $surat_keluar->judul }}"  placeholder="Masukan Perihal/Judul Surat" required>
                
                                        @error('judul')
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
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group mb-3">
                                        <label for="name">KEPADA</label>
                                        <input type="text" class="form-control @error('kepada') is-invalid @enderror" id="kepada" name="kepada" value="{{ old('kepada') ?? $surat_keluar->kepada }}"  placeholder="Kepala 1; Kepala 2; Kepala 3" required>
                                        <small style="color: red">*Pisahkan dengan titik koma (;) jika penerima lebih dari satu</small>
                                        @error('kepada')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group mb-3">
                                        <label for="name">TEMBUSAN</label>
                                        <input type="text" class="form-control @error('tembusan') is-invalid @enderror" id="tembusan" name="tembusan" value="{{ old('tembusan') ?? $surat_keluar->tembusan }}"  placeholder="Tembusan 1; Tembusan 2; Tembusan3" required>
                                        <small style="color: red">*Pisahkan dengan titik koma (;) jika penerima lebih dari satu</small>
                
                                        @error('tembusan')
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
                        <div class="form-group mb-3">
                            <label for="name">Isi Surat</label>
                            <textarea class="form-control" id="editor" name="editor" ></textarea>
                            @error('kepada')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                 
                </div>
                <!-- /.card-body -->

                <div class="card-footer bg-gray1" style="border-radius:0px 0px 10px 10px;">
                    <button type="submit" class="btn btn-success btn-footer">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="https://cdn.ckeditor.com/ckeditor5/37.0.1/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .then(editor => {
            // Set the value of the CKEditor
            editor.setData('<?php echo $surat_keluar->isi_surat  ?>');
        })
        .catch(error => {
            console.error(error);
        });
    </script>
@endsection