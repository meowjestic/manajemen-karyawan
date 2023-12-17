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
                <form action="{{ route('user.update', $data->uuid) }}" class="col" method="POST"
                    enctype="multipart/form-data">
                    @method('PUT')
                @else
                    <form action="{{ route('user.store') }}" class="col" method="POST" enctype="multipart/form-data">
            @endif

            @csrf
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" aria-describedby="username" name="username"
                    placeholder="Masukkan Username" required
                    value="{{ !empty($data) ? old('username', $data->username) : old('username') }}">


            </div>
            
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" aria-describedby="password" name="password"
                    placeholder="Masukkan password" {{empty($data) ? 'required': ''}}>
            </div>
            <div class="form-group ">
                <label class="control-label requiredField" for="karyawan">Berikan akun kepada karyawan</label>
                <select class="select form-control" id="karyawan" name="karyawan">
                    @foreach ($employee as $e)
                        <option value="{{ $e->uuid }}" @if(!empty($data)){{$e->user_id == $data->id ? 'selected': ''}}@endif>{{ $e->nama_lengkap }}</option>
                    @endforeach
                </select>
            </div>


            <div class="d-flex justify-content-end">
                <button class="btn btn-primary mt-3 px-4" name="submit" type="submit">
                    Submit
                </button>
            </div>


            </form>
        </div>
    </div>
@endsection
