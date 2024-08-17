@extends('layouts.app')


@section('page-style')
    <link href="{{ url('assets/admin/vendor/selectize/dist/css/selectize.default.css')}}" rel="stylesheet">
    <link href="{{ url('assets/admin/vendor/summernote/dist/summernote-bs4.css')}}"  rel="stylesheet">
    <!-- page css -->
    <link href="{{ url('assets/admin/vendor/sweetalert/lib/sweet-alert.css')}}" rel="stylesheet">
@endsection


@section('content')
    
    <div class="card">
        <div class="card-header border bottom">
            <h4 class="card-title">{{ $sub_title }}</h4>
        </div>
        <div class="card-body">
            <div class="row">
                @php
                    //$users =  App\Models\User::count();
                    $total_students = DB::table('tbl_student')->get()->count();
                @endphp
                <div class="col-sm-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="media justify-content-between">
                                <div>
                                    <p class="">Total Student</p>
                                    <h2 class="font-size-28 font-weight-light">{{ $total_students }}</h2>
                                    <span class="text-semibold text-success font-size-15">
                                        <!--<i class="ti-arrow-up font-size-11"></i> 
                                        <span>12%</span>-->
                                    </span>
                                </div>
                                <div class="align-self-end">
                                    <i class="ti-user font-size-70 text-primary opacity-01"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @php
                    $total_partner = DB::table('users')->where('user_type',2)->get()->count();
                @endphp
                <div class="col-sm-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="media justify-content-between">
                                <div>
                                    <p class="">Total Partner</p>
                                    <h2 class="font-size-28 font-weight-light">{{ $total_partner }}</h2>
                                    <span class="text-semibold text-danger font-size-15">
                                        <!--<i class="ti-arrow-down font-size-11"></i> 
                                        <span>7%</span>-->
                                    </span>
                                </div>
                                <div class="align-self-end">
                                    <i class="ti-bar-chart font-size-70 text-danger opacity-01"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @php
                    //$leaves = App\Models\UserLeave::where('status', 1)->count();
                @endphp
                <div class="col-sm-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="media justify-content-between">
                                <div>
                                    <p class="">Application Requests</p>
                                    <h2 class="font-size-28 font-weight-light">--</h2>
                                    <span class=" font-size-13 opacity-04">
                                        
                                    </span>
                                </div>
                                <div class="align-self-end">
                                    <i class="ti-pie-chart font-size-70 text-info opacity-01"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @php
                   //$funds = App\Models\UserFundRquest::where('status', 1)->count();
                @endphp
                <div class="col-sm-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="media justify-content-between">
                                <div>
                                    <p class="">Total Admission</p>
                                    <h2 class="font-size-28 font-weight-light">--</h2>
                                    <span class="text-semibold text-success font-size-15">
                                        <!--<i class="ti-arrow-up font-size-11"></i> 
                                        <span></span>-->
                                    </span>
                                </div>
                                <div class="align-self-end">
                                    <i class="ti-credit-card font-size-70 text-success opacity-01"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('page-script')
    
@endsection
