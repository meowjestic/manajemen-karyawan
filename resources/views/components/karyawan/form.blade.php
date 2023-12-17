@extends('components.main.index')
@section('title-content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tambah Karyawan</h1>
    </div>
@endsection
@section('content')
    <div class="card-body bg-white">
        @foreach ($errors->all() as $error)
            <p class="alert alert-danger">{{ $error }}</p>
        @endforeach
        <div class="row no-gutters align-items-center w-100">
            @if (!empty($data))
                <form action="{{ route('karyawan.update', $data->uuid) }}" class="col" method="POST" enctype="multipart/form-data">
                    @method('PUT')
            @else
                <form action="{{ route('karyawan.store') }}" class="col" method="POST" enctype="multipart/form-data">
            @endif

            @csrf
            <div class="form-group">
                <label for="nama_lengkap">Nama Lengkap</label>
                <input type="text" class="form-control" id="nama_lengkap" aria-describedby="nama_lengkap"
                    name="nama_lengkap" placeholder="Masukkan nama lengkap" required value="{{!empty($data) ? old('nama_lengkap', $data->nama_lengkap) :  old('nama_lengkap')}}">


            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" aria-describedby="email"
                    name="email" placeholder="Masukkan email" required value="{{!empty($data) ? old('email', $data->email) :  old('email')}}">


            </div>
            <div class="form-group">
                <label for="tempat_lahir">Tempat Lahir</label>
                <input type="text" class="form-control" id="tempat_lahir" aria-describedby="tempat_lahir"
                    name="tempat_lahir" placeholder="Masukkan tempat lahir" required value="{{!empty($data) ? old('tempat_lahir', $data->tempat_lahir) : old('tempat_lahir')}}">


            </div>
            <div class="form-group">
                <label for="tanggal_lahir">Tanggal Lahir</label>
                <input type="date" class="form-control" id="tanggal_lahir" aria-describedby="tanggal_lahir"
                    name="tanggal_lahir" placeholder="Masukkan tanggal lahir" required value="{{!empty($data) ? old('tanggal_lahir', $data->tanggal_lahir) : old('tanggal_lahir')}}">


            </div>

            <div class="form-group">
                <label for="tempat_tinggal">Tempat Tinggal</label>
                <input type="text" class="form-control" id="tempat_tinggal" aria-describedby="tempat_tinggal"
                    name="tempat_tinggal" placeholder="Masukkan tempat tinggal" required value="{{ !empty($data) ? old('tempat_tinggal', $data->tempat_tinggal) : old('tempat_tinggal')}}">


            </div>
            <div class="form-group">
                <label for="domisili">Domisili</label>
                <input type="text" class="form-control" id="domisili" aria-describedby="domisili" name="domisili"
                    placeholder="Masukkan domisili" required value="{{ !empty($data) ? old('domisili', $data->domisili) : old('domisili')}}">


            </div>
            <div class="form-group">
                <label for="pekerjaan">Pekerjaan</label>
                <input type="text" class="form-control" id="pekerjaan" aria-describedby="perkerjaan" name="pekerjaan"
                    placeholder="Masukkan pekerjaan" required value="{{ !empty($data) ? old('pekerjaan', $data->pekerjaan): old('pekerjaan')}}">


            </div>
            <div class="form-group">
                <label for="jabatan">Jabatan</label>
                <input type="text" class="form-control" id="jabatan" aria-describedby="jabatan" name="jabatan"
                    placeholder="Masukkan jabatan" required value="{{ !empty($data) ? old('jabatan', $data->jabatan) : old('jabatan')}}">


            </div>
            <div class="form-group ">
                <label class="control-label requiredField" for="divisi">Divisi</label>
                <select class="select form-control" id="divisi" name="divisi">
                    @foreach ($division as $item)
                        <option value="{{$item->id}}" @if(!empty($data)){{$data->divisi == $item->id ? 'selected':''}}@endif>{{$item->nama_divisi}}</option>
                    @endforeach
                </select>


            </div>
            <div class="form-group">
                <label for="gaji">Gaji</label>
                <input type="number" min="0" class="form-control" id="gaji" aria-describedby="gaji"
                    name="gaji" placeholder="Masukkan gaji" required value="{{ !empty($data) ? old('gaji',$data->gaji) : old('gaji')}}">


            </div>

            <div class="form-group ">
                <label class="control-label requiredField" for="pendidikan_terakhir">Pendidikan Terakhir</label>
                <select class="select form-control" id="pendidikan_terakhir" name="pendidikan_terakhir">
                    <option value="SMA" @if(!empty($data)){{$data->pendidikan_terakhir == 'SMA' ? 'selected':''}}@endif>SMA</option>
                    <option value="D3" @if(!empty($data)){{$data->pendidikan_terakhir == 'D3' ? 'selected':''}}@endif>D3</option>
                    <option value="S1" @if(!empty($data)){{$data->pendidikan_terakhir == 'S1' ? 'selected':''}}@endif>S1</option>
                    <option value="S2" @if(!empty($data)){{$data->pendidikan_terakhir == 'S2' ? 'selected':''}}@endif>S2</option>
                    <option value="S3" @if(!empty($data)){{$data->pendidikan_terakhir == 'S3' ? 'selected':''}}@endif>S3</option>
                </select>


            </div>
            <div class="form-group">
                <label for="tanggal_bergabung">Tanggal Bergabung</label>
                <input type="date" class="form-control" id="tanggal_bergabung" aria-describedby="tanggal_bergabung"
                    name="tanggal_bergabung" placeholder="Masukkan tanggal bergabung" required value="{{!empty($data) ? old('tanggal_bergabung', $data->tanggal_bergabung) : old('tanggal_bergabung')}}">


            </div>

            <div class="form-group">
                <label for="url_foto">Upload Foto</label>
                <input type="file" class="form-control-file" id="url_foto" name="url_foto" >


            </div>

            <div class="d-flex justify-content-end">
                <button class="btn btn-primary mt-3 px-4" name="submit" type="submit">
                    Submit
                </button>
            </div>
            </form>
        </div>
    </div>

    <script type="text/javascript" src="{{ url('js/bootstrap-datepicker.min.js') }}"></script>
    <link rel="stylesheet" href="{{ url('css/bootstrap-datepicker.css') }}" />
    <script>
        $(document).ready(function() {
            var date_input = $('input[name="date"]'); //our date input has the name "date"
            date_input.datepicker({
                format: 'dd/mm/yyyy',
                todayHighlight: true,
                autoclose: true,
            })
        })

        
    </script>
@endsection
