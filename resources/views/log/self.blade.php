@extends('layout')

@section('content')
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-flex align-items-center justify-content-between">
                            <h4 class="mb-0">Log Hari Ini</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Log</a></li>
                                    <li class="breadcrumb-item active">Pribadi</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <form id="addDailyLogForm" method="POST" @if ($log) action="{{ route('daily_logs.update') }}" @else action="{{ route('daily_logs.add') }}" @endif
                                    enctype="multipart/form-data">
                                    <input style="display: none" type="text" name="id" value="{{ @$log->employee_id }}">
                                    <input style="display: none" type="text" name="log_id" value="{{ @$log->id }}">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="form-label" for="log_text">Log Text</label>
                                        <textarea class="form-control" id="log_text" name="log_text" rows="4"
                                            @if (@$log->status == 2) disabled @endif>{{ @$log->log_text }}</textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="log_file">Log File</label>
                                        @if (@$log->log_file)
                                            <div class="input-group">
                                                <input type="text" class="form-control"
                                                    value="{{ basename(@$log->log_file) }}" readonly>
                                                <a href="{{ asset(@$log->log_file) }}" class="btn btn-secondary"
                                                    target=”_blank”>Open</a>
                                            </div>
                                        @endif

                                        <input type="file" class="form-control" id="log_file" name="log_file"
                                            @if (@$log->status == 2) disabled @endif>
                                    </div>
                                    <button id="submitUser" type="submit" class="btn btn-primary"
                                        @if (@$log->status == 2) disabled @endif>Submit</button>
                                    @if (@$log->status == 1)
                                        <span class="badge bg-warning text-dark float-end mt-2">Pending</span>
                                    @elseif(@$log->status == 2)
                                        <span class="badge bg-success float-end mt-2">Verified</span>
                                    @elseif(@$log->status == 3)
                                        <span class="badge bg-danger float-end mt-2">Declined</span>
                                    @endif
                                </form>

                            </div>
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->
            </div> <!-- container-fluid -->
        </div>
        <!-- End Page-content -->

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
    </script>
    <script>
        $(document).ready(function() {
            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Log updated successfully',
                    showConfirmButton: false,
                    timer: 1500
                });
            @endif
        });
    </script>
@endsection
