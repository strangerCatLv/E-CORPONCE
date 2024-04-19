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

            <form action="{{ route('store-surat-keluar') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @include('components.form-message')

                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group mb-3">
                                        <label for="name">TANGGAL SURAT</label>
                                        <input type="date" class="form-control @error('tgl_surat') is-invalid @enderror" id="tgl_surat" name="tgl_surat" value="{{ old('tgl_surat') }}"  placeholder="Masukan Tanggal Surat" required>
                
                                        @error('tgl_surat')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group mb-3">
                                        <label for="name">JENIS SURAT</label>
                                        <select name="jenis" class="form-control @error('tgl_surat') is-invalid @enderror"  required>
                                            <option disabled selected> <strong>--Pilih Jenis SUrat--</strong></option>
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
                                <input type="hidden" class="form-control @error('no_urut_sementara') is-invalid @enderror" id="no_urut_sementara" name="no_urut_sementara" value="1"  placeholder="Masukan No Urut Sementara">
                                <input type="hidden" class="form-control @error('no_awal') is-invalid @enderror" id="no_awal" name="no_awal" value="1"  placeholder="Masukan No Awal">
    {{-- 
                                    <div class="col-sm-6 d-none">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group mb-3">
                                                    <label for="name">NO AWAL</label>
                                                    <input type="text" class="form-control @error('no_awal') is-invalid @enderror" id="no_awal" name="no_awal" value="{{ old('no_awal') }}"  placeholder="Masukan No Awal" required>
                            
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
                                                    <input type="text" class="form-control @error('no_urut_sementara') is-invalid @enderror" id="no_urut_sementara" name="no_urut_sementara" value="{{ old('no_urut_sementara') }}"  placeholder="Masukan No Urut Sementara" required>
                            
                                                    @error('no_urut_sementara')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div> --}}
                                <div class="col-sm-6">
                                    <div class="form-group mb-3">
                                        <label for="name">NO. SURAT KELUAR</label>
                                        <input type="text" class="form-control @error('no_surat') is-invalid @enderror" id="no_surat" name="no_surat" value="{{ old('no_surat') }}"  placeholder="Masukan No Surat"  required>
                
                                        @error('no_surat')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group mb-3">
                                        <label for="name">TUJUAN</label>
                                        <input type="text" class="form-control @error('untuk') is-invalid @enderror" id="untuk" name="untuk" value="{{ old('untuk') }}"  placeholder="Masukan Tujuan Surat"  required>
                
                                        @error('untuk')
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
                                                <input type="text" class="form-control @error('lampiran') is-invalid @enderror" id="lampiran" name="lampiran" value="{{ old('lampiran') }}"  placeholder="Masukan Lampiran"   required>
                                                <small class="text-danger">*Ex : 1 lampiran, 2 lampiran, Dst.</small>
                                                @error('lampiran')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        {{-- <div class="col-sm-6">
                                            <div class="form-group mb-3">
                                                <label for="name">SIFAT</label>
                                                <input type="text" class="form-control @error('sifat') is-invalid @enderror" id="sifat" name="sifat" value="{{ old('sifat') }}"  placeholder="Masukan Sifat"   required>
                        
                                                @error('sifat')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div> --}}
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group mb-3">
                                        <label for="name">PERIHAL/JUDUL SURAT</label>
                                        <small class="text-danger">*SURAT PERINTAH, SURAT TUGAS dsb..</small>
                                        <input type="text" class="form-control @error('judul') is-invalid @enderror" id="judul" name="judul" value="{{ old('judul') }}"  placeholder="Masukan Perihal/Judul Surat" required>
                
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
                                {{-- <div class="col-sm-6">
                                    <div class="form-group mb-3">
                                        <label for="name">KEPADA</label>
                                        <input type="text" class="form-control @error('kepada') is-invalid @enderror" id="kepada" name="kepada" value="{{ old('kepada') }}"  placeholder="Kepala 1; Kepala 2; Kepala 3" required>
                                        <small style="color: red">*Pisahkan dengan titik koma (;) jika penerima lebih dari satu</small>
                                        @error('kepada')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div> --}}
                                {{-- <div class="col-sm-6">
                                    <div class="form-group mb-3">
                                        <label for="name">TEMBUSAN</label>
                                        <input type="text" class="form-control @error('tembusan') is-invalid @enderror" id="tembusan" name="tembusan" value="{{ old('tembusan') }}"  placeholder="Tembusan 1; Tembusan 2; Tembusan3" required>
                                        <small style="color: red">*Pisahkan dengan titik koma (;) jika penerima lebih dari satu</small>
                
                                        @error('tembusan')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group mb-3">
                                <label for="name">HARI</label>
                                <select name="hari" class="form-control" id="">
                                    <option disabled selected> <strong>--Pilih Hari--</strong></option>
                                    <option value="Senin">Senin</option>
                                    <option value="Selasa">Selasa</option>
                                    <option value="Rabu">Rabu</option>
                                    <option value="Kamis">Kamis</option>
                                    <option value="Jumat">Jumat</option>
                                    <option value="Sabtu">Sabtu</option>
                                    <option value="Minggu">Minggu</option>
                                </select>
        
                                @error('sifat')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-3">
                                <label for="name">TANGGAL PELAKSANAAN</label>
                                <input type="date" class="form-control @error('tanggal') is-invalid @enderror" id="tanggal" name="tanggal" value="{{ old('tanggal') }}"  required>
        
                                @error('tanggal')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-3">
                                <label for="name">WAKTU</label>
                                <small class="text-danger">* 10.00 WIB s.d Selesai, dsb..</small>
                                <input type="text" class="form-control @error('waktu') is-invalid @enderror" id="waktu" name="waktu" value="{{ old('waktu') }}"  required>
        
                                @error('waktu')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-3">
                                <label for="name">TEMPAT</label>
                                <input type="text" class="form-control @error('tempat') is-invalid @enderror" id="tempat" name="tempat" value="{{ old('tempat') }}"  required>
        
                                @error('tempat')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-3">
                                <label for="name">ALAMAT</label>
                                <input type="text" class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" value="{{ old('alamat') }}"  required>
        
                                @error('alamat')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-3">
                                <label for="name">CATATAN</label>
                                <input type="text" class="form-control @error('catatan') is-invalid @enderror" id="catatan" name="catatan" value="{{ old('catatan') }}"  required>
        
                                @error('catatan')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="name">PENUTUP</label>
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
    // ClassicEditor
    //     .create( document.querySelector( '#editor' ) )
    //     .catch( error => {
    //         console.error( error );
    //     } );
    ClassicEditor
    .create(document.querySelector('#editor'), {
        fontFamily: {
            options: [
                'Times New Roman, Times, serif',
                'Arial, Helvetica, sans-serif',
                'Courier New, Courier, monospace',
                'Georgia, serif',
                'Lucida Sans Unicode, Lucida Grande, sans-serif',
                'Tahoma, Geneva, sans-serif',
                'Trebuchet MS, Helvetica, sans-serif',
                'Verdana, Geneva, sans-serif'
            ],
            supportAllValues: true
        }
    })
    .catch(error => {
        console.error(error);
    });


</script>
@endsection