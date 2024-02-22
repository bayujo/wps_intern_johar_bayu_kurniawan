<div class="table-responsive mb-0 p-3" data-pattern="priority-columns">
    <table id="datatable-buttons" class="table table-editable table-edits">
        <thead>
            <tr>
                <th>No.</th>
                <th style="display: none">ID</th>
                <th>Date</th>
                <th>Employee</th>
                <th>Log Text</th>
                <th>Log File</th>
                <th>Status</th>
                <th>Edit</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $dailyLog)
                <tr data-id="{{ $dailyLog->id }}">
                    <td>{{ $loop->iteration }}</td>
                    <td style="display: none" data-field="id">{{ $dailyLog->id }}</td>
                    <td>
                        @if($dailyLog->created_at->isToday())
                            <strong>{{ $dailyLog->created_at->format('Y-m-d') }}</strong>
                        @else
                            {{ $dailyLog->created_at->format('Y-m-d') }}
                        @endif
                    </td>
                    <td>{{ $dailyLog->employee->name }}</td>
                    <td>{{ $dailyLog->log_text }}</td>
                    <td >
                        @if (@$dailyLog->log_file)
                        <a href="{{ asset(@$dailyLog->log_file) }}" class="btn btn-secondary"
                            target=”_blank”>{{ basename(@$dailyLog->log_file) }}</a>
                        @else
                            N/A
                        @endif
                    </td>
                    <td data-field="status">{{ $dailyLog->statuses->name }}</td>
                    <td style="width: 100px">
                        <a class="btn btn-outline-secondary btn-sm edit" title="Edit">
                            <i class="fas fa-pencil-alt"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>


<!-- Responsive Table js -->
<script src="assets/libs/admin-resources/rwd-table/rwd-table.min.js"></script>

<!-- Init js -->
<script src="assets/js/pages/table-responsive.init.js"></script>
<script src="assets/libs/table-edits/build/table-edits.min.js"></script>
<script src="assets/js/pages/table-editable.int.js"></script>
<!-- App js -->
<!-- Required datatable js -->
<script src="assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<!-- Buttons examples -->
<script src="assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
<script src="assets/libs/jszip/jszip.min.js"></script>
<script src="assets/libs/pdfmake/build/pdfmake.min.js"></script>
<script src="assets/libs/pdfmake/build/vfs_fonts.js"></script>
<script src="assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="assets/libs/datatables.net-buttons/js/buttons.colVis.min.js"></script>

<!-- Responsive examples -->
<script src="assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>

<!-- Datatable init js -->
<script src="assets/js/pages/datatables.init.js"></script>

<style>
    #datatable-buttons_filter label {
        display: inline-block;
    }

    #datatable-buttons_filter input[type="search"] {
        display: inline-block;
        width: auto;
        margin-left: 5px;
    }
</style>
