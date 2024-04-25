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
<div class="row mt-4">
    <div class="col-md-6">
        <div class="card card-primary">
            <div class="card-header text-center bg-gray1" style="border-radius:10px 10px 0px 0px;">
                <h3 class="card-title text-white">Add User</h3>
            </div>

            <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @include('components.form-message')


                <div class="card-body">
                    <div class="form-group mb-3">
                        <label for="name">NIP</label>
                        <input type="number" class="form-control @error('nip') is-invalid @enderror" id="nip" name="nip" value="{{ old('nip') }}"  placeholder="Enter nip">

                        @error('nip')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="name">Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}"  placeholder="Enter name">

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="username">Username</label>
                        <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" value="{{ old('username') }}"  placeholder="Enter username">
                        @error('username')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="email">Email address</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}"  placeholder="Enter email">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    
                    <div class="form-group mb-3">
                        <label>Role</label>
                        <select class="form-control" name="role">
                            <option disabled selected>Pilih Role</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role }}" {{ (old('role') == $role) ? 'selected' : '' }}>{{ $role }}</option>
                            @endforeach
                        </select>
                        @error('role')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    
                    <div class="form-group mb-3">
                        <label>Jabatan</label>
                        <select class="form-control" name="jabatan">
                            <option disabled selected>Pilih Jabatan</option>
                            <option value="Ketua Tim Penjamin Mutu Pendidikan Sekolah (TPMPS)">Ketua Tim Penjamin Mutu Pendidikan Sekolah (TPMPS)</option>
                            <option value="Wakasek Bidang Akademik">Wakasek Bidang Akademik</option>
                            <option value="Wakasek Bidang Kesiswaan">Wakasek Bidang Kesiswaan</option>
                            <option value="Wakasek Bidang Sarana Prasarana">Wakasek Bidang Sarana Prasarana</option>
                            <option value="Wakasek Bidang Hub. DU/DI">Wakasek Bidang Hub. DU/DI</option>
                            <option value="Bidang Kurikulum">Bidang Kurikulum</option>
                            <option value="Ketua PKG">Ketua PKG</option>
                            <option value="Bursa Kerja Khusus (BKK)">Bursa Kerja Khusus (BKK)</option>
                            <option value="Bidang PKL/Magang">Bidang PKL/Magang</option>
                            <option value="Bidang Kesiswaan">Bidang Kesiswaan</option>
                            <option value="Bidang Mutu">Bidang Mutu</option>
                            <option value="Bidang Persuratan">Bidang Persuratan</option>
                            <option value="Bidang Sarana Prasarana">Bidang Sarana Prasarana</option>
                            <option value="Kepala Kompetensi Keahlian">Kepala Kompetensi Keahlian</option>
                            <option value="Arsiparis Ahli Muda">Arsiparis Ahli Muda</option>
                            <option value="Pengadministrasi Perpustakaan">Pengadministrasi Perpustakaan</option>
                            <option value="Pengelola Data/Operator DAPODIK">Pengelola Data/Operator DAPODIK</option>
                            <option value="Sarana Prasarana">Sarana Prasarana</option>
                            <option value="Pengelola UKS dan Resepsionis">Pengelola UKS dan Resepsionis</option>
                            <option value="Pustakawan">Pustakawan</option>
                            <option value="Teknisi/Toolman">Teknisi/Toolman</option>
                            <option value="Satuan Pengaman">Satuan Pengaman</option>
                            <option value="Petugas Logistik">Petugas Logistik</option>
                            <option value="Driver">Driver</option>
                        </select>
                        @error('jabatan')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    
                    <div class="form-group mb-3">
                        <label for="password">Password</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" value="{{ old('password') }}"  placeholder="Password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <input type="hidden" name="approval" value="Approve">

                    <div class="form-group mb-3">
                        <label for="avatar">Avatar</label>
                        <div class="input-group">
                            <input type="file" class="form-control" id="avatar" name="avatar">
                        </div>
                        <div class="small text-danger">*Kosongkan jika tidak mau diisi</div>
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer bg-gray1" style="border-radius:0px 0px 10px 10px;">
                    <button type="submit" class="btn btn-success btn-footer">Add</button>
                    <a href="{{ route('users.index') }}" class="btn btn-secondary btn-footer">Back</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')

@endsection