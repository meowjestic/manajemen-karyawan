@extends('components.main.index')
@section('header')
    <meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection
@section('title-content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data User</h1>
    </div>
@endsection

@section('content')
    <div class="card-body bg-white">
        <div class="row no-gutters align-items-center">
            <div class="col d-flex justify-content-end">
                <a href="{{ url()->current() }}/create" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                        class="fas fa-plus fa-sm text-white-50"></i> Tambah data user</a>
            </div>
        </div>
        {{-- datatable --}}

        <div class="row">
            <div class="col my-4 mx-4">
                <table class="table table-bordered" id="user-table">
                    <thead>
                        <tr>
                            <th>Username</th>
                            <th>Pemilik Akun</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
    <script src="https://cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $(function() {
            $('#user-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('getAllUser') }}',
                columns: [{
                    data: 'username',
                    name: 'username'
                },  {
                    data: 'nama_lengkap',
                    name: 'nama_lengkap'
                },
                {
                    data: 'action',
                    name: 'action'
                }, ]
            });
        });
        
        $('#user-table').on('click', '#delete-user', function() {
            var id = $(this).data('id');

            var deleteConfirm = confirm("Are you sure?");
            if (deleteConfirm == true) {
                // AJAX request
                $.ajax({
                    type: 'DELETE',
                    data: {
                        _token: '{{csrf_token()}}', 
                    },
                    url: "/user/" + id,
                    success: function(response) {
                        if (response.success == 1) {
                            alert("Record deleted.");

                            // Reload DataTable
                            $("#user-table").DataTable().ajax.reload();
                        } else {
                            alert("Error is occured, please try again");
                        }
                    }
                });
            }
        })
    </script>
    </div>
@endsection