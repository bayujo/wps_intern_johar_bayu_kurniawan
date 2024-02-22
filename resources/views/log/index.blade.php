@extends('layout')

@section('content')

    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-flex align-items-center justify-content-between">
                            <h4 class="mb-0">Verifikasi Log</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Verifikasi</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">

                                <div class="table-rep-plugin" id="tablecontainer">

                                </div>

                            </div>
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->
            </div> <!-- container-fluid -->
        </div>
        <!-- End Page-content -->
        <div class="modal fade" id="addUserModal" tabindex="-1" role="dialog"
            aria-labelledby="addUserModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h5 class="modal-title" id="addUserModalLabel">Add User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="addUserForm">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label" for="log_text">Log Text</label>
                                <textarea class="form-control" id="log_text" name="log_text" rows="4"></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="log_file">Log File</label>
                                <input type="file" class="form-control" id="log_file" name="log_file">
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light waves-effect"
                            data-bs-dismiss="modal">Close</button>
                        <button id="submitUser" type="button"
                            class="btn btn-primary waves-effect waves-light">Save
                            changes</button>
                    </div>
                </div>
            </div>
        </div>

        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <script>
                            document.write(new Date().getFullYear())
                        </script> © Daily Log.
                    </div>
                    <div class="col-sm-6">
                        <div class="text-sm-end d-none d-sm-block">
                            Crafted with <i class="mdi mdi-heart text-danger"></i> 
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <script>
        var saveUrl = '/logs/update';
        var csrfToken = "{{ csrf_token() }}";
        var optionsData = @json($options);
    </script>
    <script>
        $(document).ready(function() {

            div_tabel('{{ csrf_token() }}', '#tablecontainer', '/logs/table')

            $('#submitUser').on('click', function() {
                $.ajax({
                    url: '/logs/add',
                    type: 'POST',
                    data: $('#addUserForm').serialize(),
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'User added successfully',
                            showConfirmButton: false,
                            timer: 1500
                        });

                        $('#addUserModal').modal('hide');
                        div_tabel('{{ csrf_token() }}', '#tablecontainer', '/logs/table')

                    },
                    error: function(xhr, status, error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Something went wrong!',
                        });
                    }
                });
            });
        });

        function div_tabel(token, target, act) {
            $(target).html("Sedang memuat data");
            $.post(act, {
                    _token: token,
                },
                function(data) {
                    $(target).html(data);
                })
        }

        function delete_data(token, act) {
            Swal.fire({
                title: 'Are you sure?',
                text: 'You won\'t be able to revert this!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.post(act, {
                        _token: token,
                    }, function(data) {
                        Swal.fire({
                            icon: 'success',
                            title: 'User deleted successfully',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        div_tabel('{{ csrf_token() }}', '#tablecontainer', '/users/table');
                    });
                }
            });
        }
    </script>

@endsection