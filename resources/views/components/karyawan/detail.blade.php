@extends('components.main.index')

@section('title-content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail {{ $data->nama_lengkap }}</h1>
    </div>
@endsection
@section('content')
    <div class="col-xl-4">
        <!-- Profile picture card-->
        <div class="card mb-4 mb-xl-0">
            <div class="card-header">Foto Profil</div>
            <div class="card-body text-center d-flex justify-content-center">
                <!-- Profile picture image-->
                <div class="" style="width:240px">
                    <img class="img-account-profile rounded-circle mb-2 img-fluid" src="{{url('assets/foto_karyawan/'.$data->url_foto)}}"
                    alt="">
                </div>
                <!-- Profile picture help block-->
            </div>
        </div>
    </div>
    <div class="col-xl-8">
        <!-- Account details card-->
        <div class="card mb-4">
            <div class="card-header">Detail Akun</div>
            <div class="card-body">
                    <!-- Form Group (username)-->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="small mb-1">Nama Lengkap</label>
                            <p>{{$data->nama_lengkap}}</p>
                        </div>
                        <div class="col-md-6">
                            <label class="small mb-1">Divisi</label>
                            <p>{{$data->nama_divisi}}</p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label class="small mb-1">Email</label>
                            <p>{{$data->email}}</p>
                        </div>
                    </div>
                    <hr class="sidebar-divider my-2">
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="small mb-1">Tempat/Tanggal Lahir</label>
                            <p>{{$data->tempat_lahir}},{{date_format(date_create($data->tanggal_lahir), "d/m/Y")}}</p>
                        </div>
                        <div class="col-md-4">
                            <label class="small mb-1">Tempat Tinggal</label>
                            <p>{{$data->tempat_tinggal}}</p>
                        </div>
                        <div class="col-md-4">
                            <label class="small mb-1">Domisili</label>
                            <p>{{$data->domisili}}</p>
                        </div>
                    </div>
                    <hr class="sidebar-divider my-2">
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="small mb-1">Pekerjaan</label>
                            <p>{{$data->pekerjaan}}</p>
                        </div>
                        <div class="col-md-4">
                            <label class="small mb-1">Jabatan</label>
                            <p>{{$data->jabatan}}</p>
                        </div>
                        <div class="col-md-4">
                            <label class="small mb-1">Gaji</label>
                            <p>Rp.{{number_format($data->gaji,2,',','.')}}</p>
                        </div>
                    </div>
                    <hr class="sidebar-divider my-2">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="small mb-1">Tanggal Bergabung</label>
                            <p>{{date_format(date_create($data->tanggal_bergabung), "d/m/Y")}}</p>
                        </div>
                        <div class="col-md-6">
                            <label class="small mb-1">Pendidikan Terakhir</label>
                            <p>{{$data->pendidikan_terakhir}}</p>
                        </div>
                    </div>
                   
            </div>
        </div>
    </div>
@endsection
