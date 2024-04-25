@extends('layouts.app')

@section('style')
<style>
.profile-user{
    width: 200px;
    height: 200px;
}
.card{
  border-radius:20px; 
}
.card-img:hover {
    transform: scale(1.07) !important;
    transition: 0.5s;
    box-shadow: 0 10px 20px rgba(0, 0, 0, .12), 0 5px 8px rgba(0, 0, 0, .06);
}
.role{
  display:none;
}
.judul{
  font-size: 25px;
}
.label{
  font-size: 15px;
}
.card-img{
  border-top:5px solid #da241b;
}

.card-profile{
  border-top: 5px solid #da241b;
}

/* Bordered Tabs */
.nav-tabs-bordered {
  border-bottom: 2px solid #ebeef4;
}
.nav-tabs-bordered .nav-link {
  margin-bottom: -2px;
  border: none;
  color: #2c384e;
}
.nav-tabs-bordered .nav-link:hover, .nav-tabs-bordered .nav-link:focus {
  color: #da241b;
}
.nav-tabs-bordered .nav-link.active {
  background-color: #fff;
  color: #da241b;
  border-bottom: 2px solid #da241b;
}


/* lighbox image */
#myImg {
  border-radius: 5px;
  cursor: pointer;
  transition: 0.3s;
}

#myImg:hover {opacity: 0.7;}

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
}

/* Modal Content (image) */
.modal-content {
  margin: auto;
  display: block;
  width: 80%;
  max-width: 700px;
}

/* Caption of Modal Image */
#caption {
  margin: auto;
  display: block;
  width: 80%;
  max-width: 700px;
  text-align: center;
  color: #ccc;
  padding: 10px 0;
  height: 150px;
}

/* Add Animation */
.modal-content, #caption {  
  -webkit-animation-name: zoom;
  -webkit-animation-duration: 0.6s;
  animation-name: zoom;
  animation-duration: 0.6s;
}

@-webkit-keyframes zoom {
  from {-webkit-transform:scale(0)} 
  to {-webkit-transform:scale(1)}
}

@keyframes zoom {
  from {transform:scale(0)} 
  to {transform:scale(1)}
}

/* The Close Button */
.close {
  position: absolute;
  top: 70px;
  right: 35px;
  color: #f1f1f1;
  font-size: 40px;
  font-weight: bold;
  transition: 0.3s;
}

.close:hover,
.close:focus {
  color: #bbb;
  text-decoration: none;
  cursor: pointer;
}

/* 100% Image Width on Smaller Screens */
@media only screen and (max-width: 700px){
  .modal-content {
    width: 100%;
  }
}
/* end lightbox image */
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
                    <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
                    <li class="breadcrumb-item">/</li>
                    <li class="breadcrumb-item active"><a href="{{ route('users.index') }}">{{ ($breadcumb ?? '') }}</a></li>
                </ol>
            </div>

        </div>
    </div>
</div>
@endsection

@section('content')

    <div class="row">
      <div class="col-xl-4">
        <div class="card card-img">
          <div class="card-bod profile-card d-flex flex-column align-items-center">
            <img class="rounded-circle profile-user mt-3" alt="{{ $kop->nama_sekolah ?? '' }}" id="myImg" src="{{ asset('img/kop_surat/'.($kop->logo ?? 'logo smk.png')) }}">
            <h5 class="mt-3">{{ $kop->nama_sekolah ?? '' }}</h5>
            
          </div>
        </div>
      </div>

      <div id="myModal" class="modal">
        <span class="close">&times;</span>
        <img class="modal-content" id="img01">
        <div id="caption"></div>
      </div>

      <div class="col-xl-8">
        @include('sweetalert::alert')

        <div class="card card-profile">
          <div class="card-body pt-3">
            <!-- Bordered Tabs -->
            <ul class="nav nav-tabs nav-tabs-bordered">
              <li class="nav-item flex-fill" role="presentation">
                <button class="nav-link w-100 active" id="contact-tab" data-bs-toggle="tab" data-bs-target="#qr" type="button" role="tab" aria-controls="contact" aria-selected="false">Setting</button>
              </li>
            </ul>

            <div class="tab-content pt-2">
              <div class="tab-pane fade pt-3 show active profile-overview" id="qr">
                <div class="card-body">
                  <div class="row text-center">
                    <form action="{{ route('kop-surat-update') }}" method="post" enctype="multipart/form-data">
                      @csrf
                        <div class="form-group mb-3">
                            <label for="avatar" style="float: left">Logo</label>
                            <div class="input-group">
                                <input type="file" class="form-control" id="logo_sekolah" value="{{ $kop->logo_sekolah }}" name="logo_sekolah" >
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="avatar" style="float: left">Nama Sekolah</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="nama_sekolah" value="{{ $kop->nama_sekolah }}" name="nama_sekolah" required>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="avatar" style="float: left">Website</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="website" value="{{ $kop->website }}" name="website" required>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="avatar" style="float: left">Email</label>
                            <div class="input-group">
                                <input type="email" class="form-control" id="email" value="{{ $kop->email }}" name="email" required>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="avatar" style="float: left">Telp.</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="telp" value="{{ $kop->telp }}" name="telp" required>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="avatar" style="float: left">Kepala Sekolah</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="kepala_sekolah" value="{{ $kop->kepala_sekolah }}" name="kepala_sekolah" required>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="avatar" style="float: left">NIP Kepala Sekolah</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="nip_kepala_sekolah" value="{{ $kop->nip_kepala_sekolah }}" name="nip_kepala_sekolah" required>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="avatar" style="float: left">Alamat Sekolah</label>
                            <div class="input-group">
                              <textarea name="alamat" class="form-control" id="" cols="30" rows="10" required>{{ $kop->alamat }}</textarea>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary" style="float: right">Simpan</button>
                    </form>
                  </div>
                </div>
              </div>
          </div>
      </div>
    </div>

    
  </div>
 



@endsection

@section('script')
<script>
  // Get the modal
  var modal = document.getElementById("myModal");
  
  // Get the image and insert it inside the modal - use its "alt" text as a caption
  var img = document.getElementById("myImg");
  var modalImg = document.getElementById("img01");
  var captionText = document.getElementById("caption");
  img.onclick = function(){
    modal.style.display = "block";
    modalImg.src = this.src;
    captionText.innerHTML = this.alt;
  }
  
  // Get the <span> element that closes the modal
  var span = document.getElementsByClassName("close")[0];
  
  // When the user clicks on <span> (x), close the modal
  span.onclick = function() { 
    modal.style.display = "none";
  }

  </script>
  
@endsection