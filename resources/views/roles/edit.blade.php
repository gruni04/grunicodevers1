@extends('layouts.app')


@section('page-style')
    <link href="{{ url('assets/admin/vendor/selectize/dist/css/selectize.default.css')}}" rel="stylesheet">
    <link href="{{ url('assets/admin/vendor/summernote/dist/summernote-bs4.css')}}"  rel="stylesheet">
@endsection


@section('content')
    
    <div class="card">
        <div class="card-header border bottom">
            <h4 class="card-title">{{ $sub_title }}</h4>
            <a href="{{ route('roles.index') }}" class="btn btn-gradient-success" style="float: right;">Back</a>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12">
                    
                    <form action="{{ route('role.updates') }}" method="POST" class="m-t-15" id="form">
                        <input type="hidden" name="id" value="{{ $role->id }}">
                        <div class="form-row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Role Name</label>
                                    <input type="text" class="form-control" name="name" placeholder="Enter Role Name" required value="{{ $role->name }}">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-12">
                                <div class="row checkbox">
                                    <div class="form-group col-md-12">
                                        <label for="">Permissions</label>
                                    </div>
                                    @foreach($permission as $value)
                                        <div class="form-group col-md-3">
                                            <input id="checkbox{{ $value->id }}" name="permission[]" type="checkbox" value="{{ $value->id }}" class="name" {{ in_array($value->id, $rolePermissions) ? "checked" : '' }}>
                                            <label for="checkbox{{ $value->id }}">{{ $value->name }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="form-row text-right">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="text-sm-right">
                                        <button class="btn btn-default" type="reset">Reset</button>
                                        <button class="btn btn-gradient-success" type="submit">Submit</button>
                                    </div>
                                </div>
                            </div>        
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('page-script')
        
    <script type="text/javascript">
        // Wait for the DOM to be ready
        $("#form").validate({
            submitHandler: function(form){
                $.ajaxSetup({
                    headers: {
                          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                event.preventDefault();
                var form_data = new FormData(document.getElementById("form"));
                $.ajax({
                      type: "POST",
                      url:$("#form").attr('action'),
                      dataType:'json',
                      data: form_data,
                      contentType: false,
                      cache: false,
                      processData:false,
                      beforeSend:function()
                      {},
                      success:function(responce)
                      {
                         if(responce.status==1)
                        {
                            _success(responce.message);
                            window.setTimeout(function() {
                                window.location.href = "{{ route('roles.index') }}";
                            }, 1500);
                        }else{
                           _error(responce.message); 
                        }
                      },
                      error:function()
                      {
                         _error('Something Went Wrong..');
                      },
                      complete:function()
                      {
                      }
                });    
            }
        });
    </script>
@endsection