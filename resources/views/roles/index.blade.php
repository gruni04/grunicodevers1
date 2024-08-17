@extends('layouts.app')


@section('page-style')
    <link rel="stylesheet" href="{{ url('assets/admin/vendor/datatables/media/css/dataTables.bootstrap4.min.css')}}" />
@endsection


@section('content')
    <div class="card">
        <div class="card-body">
            @can('role-create')
            <div class="text-right">
                <a href="{{ route('roles.create') }}" class="btn btn-gradient-success">Create New Role</a>
            </div>
            @endcan
            <div class="table-overflow">
                <table id="dt-opt" class="table table-hover table-xl datatable">
                    <thead>
                        <tr>
                            <th>Sr. No.</th>
                            <th>Name</th>
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

    <script type="text/javascript">
        function delete_item(url) {
            if(confirm("Are You Sure want to delete Role?")){
                window.location = url;
            } 
        }
        $(document).ready(function() {
            // DataTable
            datatable();
        });
        $(document).on("change", '.filter', function() {
            $('.datatable').DataTable().destroy();
            datatable();
        });
        function datatable(){
            
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
                ajax: {
                    url:"{{ route('roles.datatables') }}",
                    data:{},
                    
                },
                columns: [
                     { data: 'id' },
                     { data: 'name' },
                     { data: 'action' },
                ]
            });
        }
    </script>
@endsection