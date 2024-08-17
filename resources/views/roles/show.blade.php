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
                    <div class="form-row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Role Name: {{ $role->name }}</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12">
                            <div class="row checkbox">
                                <div class="form-group col-md-12">
                                    <label for="">Permissions</label>
                                </div>
                                @if(!empty($rolePermissions))
                                    @foreach($rolePermissions as $value)
                                        <div class="form-group col-md-3">
                                            <label for="">{{ $value->name }},</label>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
@endsection


@section('page-script')
        
    <script type="text/javascript">
        
    </script>
@endsection