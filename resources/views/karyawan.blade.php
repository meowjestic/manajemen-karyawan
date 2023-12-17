@extends('components.main.index')
@section('header')
    <meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection
@section('title-content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Karyawan</h1>
    </div>
@endsection

@section('content')
    <div class="card-body bg-white">
        <div class="row no-gutters align-items-center">
            <div class="col d-flex justify-content-end">
                <a href="{{ url()->current() }}/export_excell" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm mx-2"><i
                        class="fas fa-download fa-sm text-white-50"></i> Unduh data karyawan (excell)</a>
                <a href="{{ url()->current() }}/create" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                        class="fas fa-plus fa-sm text-white-50"></i> Tambah data karyawan</a>
            </div>
        </div>
        <div class="row">
            <div class="col my-4 mx-4">
                <table class="table table-bordered" id="karyawan-table">
                    <thead>
                        <tr>
                            <th>Nama Lengkap</th>
                            <th>Pekerjaan</th>
                            <th>Jabatan</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
    <script src="https://cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
    <script>
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $(function() {
            $('#karyawan-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('getAllKaryawan') }}',
                columns: [{
                    data: 'nama_lengkap',
                    name: 'nama_lengkap'
                }, {
                    data: 'pekerjaan',
                    name: 'pekerjaan',
                }, {
                    data: 'jabatan',
                    name: 'jabatan',
                }, {
                    data: 'action',
                    name: 'action'
                }, ]
            });
        });
        
        $('#karyawan-table').on('click', '#delete-karyawan', function() {
            var id = $(this).data('id');

            var deleteConfirm = confirm("Are you sure?");
            if (deleteConfirm == true) {
                // AJAX request
                $.ajax({
                    type: 'DELETE',
                    data: {
                        _token: CSRF_TOKEN, 
                    },
                    url: "/karyawan/" + id,
                    success: function(response) {
                        if (response.success == 1) {
                            alert("Record deleted.");

                            // Reload DataTable
                            $("#karyawan-table").DataTable().ajax.reload();
                        } else {
                            alert("Error is occured, please try again");
                        }
                    }
                });
            }
        })
    </script>
@endsection
