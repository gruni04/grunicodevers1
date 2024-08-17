@extends('layouts.app')


@section('page-style')
    <link rel="stylesheet" href="{{ url('assets/admin/vendor/datatables/media/css/dataTables.bootstrap4.min.css')}}" />
    <link href="{{ url('assets/admin/vendor/selectize/dist/css/selectize.default.css')}}" rel="stylesheet">
    <link href="{{ url('assets/admin/vendor/summernote/dist/summernote-bs4.css')}}"  rel="stylesheet">
@endsection


@section('content')
    <div class="card">
        <div class="card-body">
            @can('partner-agent-create')
            <div class="text-right">
                <a href="{{ route('admin.partner-user.save') }}" class="btn btn-gradient-success">Add Partner/Agent</a>
            </div>
            @endcan
            <div class="table-overflow">
                <table id="dt-opt" class="table table-hover table-xl datatable">
                    <thead>
                        <tr>
                            <th>Sr. No.</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Contact</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>                        
                    </tbody>
                </table>
            </div> 
        </div>       
    </div> 
    
@endsection


@section('page-script')
    <script src="{{ url('assets/admin/vendor/datatables/media/js/jquery.dataTables.js')}}"></script>
    <script src="{{ url('assets/admin/vendor/datatables/media/js/dataTables.bootstrap4.min.js')}}"></script>
    {{-- <script src="{{ url('assets/admin/js/tables/data-table.js')}}"></script> --}}

    <script type="text/javascript">
        function delete_item(url) {
            if(confirm("Are You Sure want to delete User?")){
                window.location = url;
            } 
        }
        
        $(document).ready(function() {
            // DataTable
            $('.datatable').DataTable({
                processing: true,
                serverSide: true,
                bStateSave: true,
                fnStateSave: function (oSettings, oData) {
                    localStorage.setItem( 'dt', JSON.stringify(oData) );
                },
                fnStateLoad: function (oSettings) {
                    return JSON.parse( localStorage.getItem('dt') );
                },
                order: [[1, 'desc']],
                columnDefs: [
                  { "orderable": false, "targets": [4, 5] },
                ],
                ajax: "{{ route('admin.partner-user.datatables') }}",
                columns: [
                     { data: 'id' },
                     { data: 'name' },
                     { data: 'email' },
                     { data: 'contact' },
                     { data: 'role' },
                     { data: 'action' },
                ]
             });
        });
    </script>
@endsection