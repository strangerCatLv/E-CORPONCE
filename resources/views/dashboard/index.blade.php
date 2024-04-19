@extends('layouts.app')

@section('style')
<link rel="stylesheet" href="{{ asset('plugins/datepicker/bootstrap-datepicker3.min.css') }}">
<style>
@use postcss-color-function;
@use postcss-nested;
@import url('https://fonts.googleapis.com/css?family=Raleway:400,700,900');
<style>
       .master-data {
           cursor: pointer;
       }

       
       .info-box {
            box-shadow: 0 0 1px rgba(0, 0, 0, 0.125), 0 1px 3px rgba(0, 0, 0, 0.2);
            border-radius: 0.50rem;
            background-color: #fff;
            display: -ms-flexbox;
            display: flex;
            margin-bottom: 1rem;
            min-height: 200px;
            position: relative;
            width: 100%;
        }

        .info-box .info-box-icon {
            border-radius: 0.50rem 0 0 0.50rem;
            -ms-flex-align: center;
            align-items: center;
            display: -ms-flexbox;
            display: flex;
            font-size: 1.875rem;
            -ms-flex-pack: center;
            justify-content: center;
            text-align: center;
            width: 70px;
        }

        .info-box .info-box-icon > img {
            max-width: 100%;
        }

        .info-box .info-box-content {
            display: -ms-flexbox;
            display: flex;
            -ms-flex-direction: column;
            flex-direction: column;
            -ms-flex-pack: center;
            justify-content: center;
            line-height: 1.8;
            -ms-flex: 1;
            flex: 1;
            padding: 0 18px;
        }

        .gambar {
            margin-top: 15px;
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
                        <li class="breadcrumb-item active"><a href="{{ route('dashboard.index') }}">{{ ($breadcumb ?? '') }}</a></li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    
@endsection

@section('content')
<div class="row mt-4">
    <div class="col-lg-12 col-md-6">
        <div class="row">
            @if(Auth::user()->getRoleNames()[0] != 'Pegawai')
            <div class="col-md-6 col-sm-6 col-12 p-1">
                <div class="info-box bg-gradient-info">
                    <img src="img/surat-masuk.png" alt="" width="300px" height="180px" class="gambar" >
                    <div class="info-box-content">
                        <span class="info-box-text font-size-18 text-bold" style="color: black">Surat Masuk</span>

                        <span class="" style="color: black; font-size:20px; line-height:normal;">{{ $surat_masuk }} Data</span>
                    </div>
                </div>
            </div>
            @endif

            @if(Auth::user()->getRoleNames()[0] == 'Superadmin' || Auth::user()->getRoleNames()[0] == 'Manajemen' || Auth::user()->getRoleNames()[0] == 'TU Umum' )
            <div class="col-md-6 col-sm-6 col-12 p-1" >
                <div class="info-box bg-gradient-info">
                    <img src="img/surat-keluar.png" alt="" width="300px" height="180px" class="gambar" >
                    <div class="info-box-content">
                        <span class="info-box-text font-size-18 text-bold" style="color: black">Surat Keluar</span>
                        <span class="" style="color: black; font-size:20px; line-height:normal;">{{ $surat_keluar }} Data</span>
                    </div>
                </div>
            </div>
            @endif

            @if(Auth::user()->getRoleNames()[0] == 'Superadmin' || Auth::user()->getRoleNames()[0] == 'Kepala Sekolah')
            <div class="col-md-6 col-sm-6 col-12 p-1" >
                <div class="info-box bg-gradient-info">
                    <img src="img/pegawai.png" alt="" width="300px" height="180px" class="gambar" >

                    <div class="info-box-content">
                        <span class="info-box-text font-size-18 text-bold" style="color: black">Pegawai</span>
                        <span class="" style="color: black; font-size:20px; line-height:normal;">{{ $pegawai }} Data</span>
                    </div>
                </div>
            </div>
            @endif

            @if(Auth::user()->getRoleNames()[0] == 'Superadmin' || Auth::user()->getRoleNames()[0] == 'Pegawai' || Auth::user()->getRoleNames()[0] == 'TU Umum')
            <div class="col-md-6 col-sm-6 col-12 p-1" >
                <div class="info-box bg-gradient-info">
                    <img src="img/assign-surat.png" alt="" width="300px" height="180px" class="gambar" >

                    <div class="info-box-content">
                        <span class="info-box-text font-size-18 text-bold" style="color: black">Assign Tugas</span>
                        <span class="" style="color: black; font-size:20px; line-height:normal;">{{ $assign_tugas }} Data</span>
                    </div>
                </div>
            </div>
            @endif
          
        </div>
    </div>
</div>
@endsection

@section('script')

@endsection