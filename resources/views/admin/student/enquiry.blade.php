@extends('layouts.app')


@section('page-style')
    <link rel="stylesheet" href="{{ url('assets/admin/vendor/datatables/media/css/dataTables.bootstrap4.min.css')}}" />
    <link href="{{ url('assets/admin/vendor/selectize/dist/css/selectize.default.css')}}" rel="stylesheet">
    <link href="{{ url('assets/admin/vendor/summernote/dist/summernote-bs4.css')}}"  rel="stylesheet">
@endsection


@section('content')
    <div class="card">
        <div class="card-body">

            <div class="table-overflow">
                 <table class="table">
         <thead class="thead-light">
            <tr>
               <th scope="col">Sr. NO</th>
               <th scope="col">Name</th>
               <th scope="col">Email</th>
               <th scope="col">Contact No.</th>
               <th scope="col">2023 Marks</th>
               <th scope="col">Message</th>
               <th scope="col">Date</th>
               <th scope="col">Action</th>
            </tr>
         </thead>
         <tbody>
            @php
            $sr = 1;
            @endphp
            @foreach($data as $list)
            <tr>
               <?php
               $message = preg_replace('/\[url=(.*?)\](.*?)\[\/url\]/i', '$2', $list->message);

            // Remove special characters
            $message = preg_replace('/[^A-Za-z0-9\s]/', '', $message);

            // Remove HTML tags
            $message = strip_tags($message);
               ?>
               <th scope="row">{{$sr++}}</th>
               <td>{{$list->name}}</td>
               <td>{{$list->email}}</td>
               <td>{{$list->mobile}}</td>
               <td>{{$list->admission_city}}</td>
               <td>{!! Str::limit($message, 40) !!}</td>
               <td>{{ date('d/m/Y', strtotime($list->created_at)) }}</td>
               <td>
                  <a href="javascript:void();" onclick="delete_item(`{{route('admin.student.delete-enquireys', ['id'=>$list->id])}}`)"><button type="submit"
                     class="btn btn-danger">Delete</button></a>
               </td>
            </tr>
            @endforeach
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
                ajax: "{{ route('admin.student.list-student') }}",
                columns: [
                     { data: 'id' },
                     { data: 'name' },
                     { data: 'mobile' },
                     { data: 'father_name' },
                     { data: 'action' },
                ]
            });
        });
    </script>
@endsection
