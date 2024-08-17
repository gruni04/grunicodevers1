<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $sub_title.'-'.config('app.name', 'Webarctech') }}</title>

    <!-- Favicon -->
    <link rel="apple-touch-icon" href="{{ url('assets/admin/images/logo/apple-touch-icon.png')}}">
    <link rel="shortcut icon" href="{{ url('assets/admin/images/logo/favicon.png')}}">

    <!-- core dependcies css -->
    <link rel="stylesheet" href="{{ url('assets/admin/vendor/bootstrap/dist/css/bootstrap.css')}}" />
    <link rel="stylesheet" href="{{ url('assets/admin/vendor/PACE/themes/blue/pace-theme-minimal.css')}}" />
    <link rel="stylesheet" href="{{ url('assets/admin/vendor/perfect-scrollbar/css/perfect-scrollbar.min.css')}}" />

    <!-- page css -->

    <!-- core css -->
    <link href="{{ url('assets/admin/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{ url('assets/admin/css/themify-icons.css')}}" rel="stylesheet">
    <link href="{{ url('assets/admin/css/materialdesignicons.min.css')}}" rel="stylesheet">
    <link href="{{ url('assets/admin/css/animate.min.css')}}" rel="stylesheet">
    <link href="{{ url('assets/admin/css/app.css')}}" rel="stylesheet">
    <style>
        .list-media .info {
            padding-left: 5px;
        }
        .sticky-icon {
            background-color: rgb(29 223 196);
            color: #ffffff;
            font-size: 12px;
            display: none;
            line-height: 35px;
            text-align: center;
            -webkit-border-radius: 6px;
            -moz-border-radius: 6px;
            -ms-border-radius: 6px;
            border-radius: 6px;
            width: 35px;
            height: 35px;
            position: fixed;
            right: 15px;
            bottom: 15px;
            z-index: 99;
            -webkit-transition: background-color 0.3s, color 0.3s;
            -moz-transition: background-color 0.3s, color 0.3s;
            -ms-transition: background-color 0.3s, color 0.3s;
            -o-transition: background-color 0.3s, color 0.3s;
            transition: background-color 0.3s, color 0.3s;
        }
    </style>
    @include('layouts.comman-scripts')
    @yield('page-style')

</head>

<body>
    <div class="app side-nav-dark header-success-gradient">
        <div class="layout">
            <!-- Header START -->
            <div class="header navbar">
                <div class="header-container">
                    <div class="nav-logo">
                        <a href="{{ route('home') }}">
                            <div class="logo logo-dark" style="background-image: url('{{ url('assets/admin/images/logo/logo.png')}}')"></div>
                            <div class="logo logo-white" style="background-image: url('{{ url('assets/admin/images/logo/logo.png')}}')"></div>
                        </a>
                    </div>
                    <ul class="nav-left">
                        <li>
                            <a class="sidenav-fold-toggler" href="javascript:void(0);">
                                <i class="mdi mdi-menu"></i>
                            </a>
                            <a class="sidenav-expand-toggler" href="javascript:void(0);">
                                <i class="mdi mdi-menu"></i>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav-right">
                        
                        @php
                            $notification_data = DB::table('tbl_notification')->where('user_id', Auth::user()->id)->orderBy("id", "DESC")->get();
                            $unnotification_data = DB::table('tbl_notification')->where('status', '2')->where('user_id', Auth::user()->id)->orderBy("id", "DESC")->get();
                            
                        @endphp
                        <li class="notifications dropdown dropdown-animated scale-left">
                            <span class="counter">{{ count($unnotification_data) }}</span>
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="mdi mdi-bell-ring-outline"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-lg p-v-0">
                                <li class="p-v-15 p-h-20 border bottom text-dark">
                                    <h5 class="m-b-0">
                                        <i class="mdi mdi-bell-ring-outline p-r-10"></i>
                                        <span>Notifications</span>
                                    </h5>
                                </li>
                                <li>
                                    <ul class="list-media overflow-y-auto relative scrollable" style="max-height: 300px">
                                         @if($notification_data && count($notification_data)>0)
                                            @foreach($notification_data as $k=>$v)
                                            @php
                                                $bgstyle = "background-color: white;";
                                                if($v->status==2){
                                                $bgstyle = "background-color: bisque;";
                                                }
                                            @endphp
                                        <li class="list-item border bottom read-noti" style="{{ $bgstyle }}" data-id="{{ $v->id }}" >
                                            <a href="{{ url('admin/student/save-student/'.$v->student_id) }}?tab={{ $v->tab_name }}" class="media-hover p-15">
                                                {{-- <div class="media-img">
                                                    <div class="icon-avatar bg-primary">
                                                        <i class="ti-settings"></i>
                                                    </div>
                                                </div> --}}
                                                <div class="info">
                                                    <span class="title">
                                                        {{ $v->message }}
                                                    </span>
                                                    <span class="sub-title">{{ $v->created_at }}</span>
                                                </div>
                                            </a>
                                        </li>
                                            @endforeach
                                        @endif
                                        {{-- <li class="list-item border bottom">
                                            <a href="javascript:void(0);" class="media-hover p-15">
                                                <div class="media-img">
                                                    <div class="icon-avatar bg-success">
                                                        <i class="ti-user"></i>
                                                    </div>
                                                </div>
                                                <div class="info">
                                                    <span class="title">
                                                        New User Registered
                                                    </span>
                                                    <span class="sub-title">12 min ago</span>
                                                </div>
                                            </a>
                                        </li>
                                        <li class="list-item border bottom">
                                            <a href="javascript:void(0);" class="media-hover p-15">
                                                <div class="media-img">
                                                    <div class="icon-avatar bg-warning">
                                                        <i class="ti-file"></i>
                                                    </div>
                                                </div>
                                                <div class="info">
                                                    <span class="title">
                                                        New Attacthemnet
                                                    </span>
                                                    <span class="sub-title">12 min ago</span>
                                                </div>
                                            </a>
                                        </li>
                                        <li class="list-item border bottom">
                                            <a href="javascript:void(0);" class="media-hover p-15">
                                                <div class="media-img">
                                                    <div class="icon-avatar bg-info">
                                                        <i class="ti-shopping-cart"></i>
                                                    </div>
                                                </div>
                                                <div class="info">
                                                    <span class="title">
                                                        New Order Received
                                                    </span>
                                                    <span class="sub-title">12 min ago</span>
                                                </div>
                                            </a>
                                        </li> --}}
                                    </ul>
                                </li>
                                <li class="p-v-15 p-h-20 text-center">
                                    <span>
                                        <a href="#" class="text-gray">Check all notifications <i class="ei-right-chevron p-l-5 font-size-10"></i></a>
                                    </span>
                                </li>
                            </ul>
                        </li>
                        <li class="user-profile dropdown dropdown-animated scale-left">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img class="profile-img img-fluid" src="{{ url('assets/admin/images/dummy-profile.jpg')}}" alt="">
                            </a>
                            <ul class="dropdown-menu dropdown-md p-v-0">
                                <li>
                                    <ul class="list-media">
                                        <li class="list-item p-15">
                                            <div class="media-img">
                                                <img src="{{ url('assets/admin/images/dummy-profile.jpg')}}" alt="">
                                            </div>
                                            <div class="info">
                                                <span class="title text-semibold">{{ Auth::user()->name }}</span>
                                                <span class="sub-title">{{ Auth::user()->email }}</span>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                                <li role="separator" class="divider"></li>
                                <li>
                                    <a href="{{ route('admin.student.profile_list') }}">
                                        <i class="ti-user p-r-10"></i>
                                        <span>Profile</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('user.edit-user-password') }}">
                                        <i class="ti-key p-r-10"></i>
                                        <span>Change Password</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="ti-power-off p-r-10"></i>
                                        <span>Logout</span>
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </li>
                        <!--<li class="m-r-10">
                            <a class="quick-view-toggler" href="javascript:void(0);">
                                <i class="mdi mdi-format-indent-decrease"></i>
                            </a>
                        </li>-->
                        <a class="quick-view-toggler d-none" href="javascript:void(0);"></a>
                    </ul>
                </div>
            </div>
            <!-- Header END -->

            <!-- Side Nav START -->
            <div class="side-nav expand-lg">
                <div class="side-nav-inner">
                    <ul class="side-nav-menu scrollable">
                        <li class="side-nav-header">
                            <span>Navigation</span>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="" href="{{ route('home') }}">
                                <span class="icon-holder">
                                    <i class="mdi mdi-gauge"></i>
                                </span>
                                <span class="title">Dashboard</span>
                            </a>
                        </li>
                        @php
                            $_auth = Auth::user();
                        @endphp
                        
                        
                        @if($_auth->hasAnyPermission(['user-list', 'user-create', 'user-edit', 'user-delete', 'partner-agent-list', 'partner-agent-create', 'partner-agent-edit', 'partner-agent-delete']))
                        <li class="nav-item dropdown {{ ( Route::is('users.list.index') || Route::is('partner-user.list.index') ) ? 'open' : ''}}">
                            <a class="dropdown-toggle" href="javascript:void(0);">
                                <span class="icon-holder">
                                    <i class="mdi mdi-tune-vertical"></i>
                                </span>
                                <span class="title">Admin Users</span>
                                <span class="arrow">
                                    <i class="mdi mdi-chevron-right"></i>
                                </span>
                            </a>
                            <ul class="dropdown-menu">
                                @if($_auth->hasAnyPermission(['user-list', 'user-create', 'user-edit', 'user-delete']))
                                <li class="{{ ( Route::is('users.list.index')) ? 'active' : ''}}">
                                    <a href="{{ route('users.list.index') }}">Admin User</a>
                                </li>
                                @endif
                                
                                @if($_auth->hasAnyPermission(['partner-agent-list', 'partner-agent-create', 'partner-agent-edit', 'partner-agent-delete']))
                                <li class="{{ ( Route::is('partner-user.list.index')) ? 'active' : ''}}">
                                    <a href="{{ route('partner-user.list.index') }}">Partner/Agent</a>
                                </li>
                                @endif
                            </ul>
                        </li>
                        @endif

                        @if(Auth::user()->hasAnyRole(['Admin', 'Manager']))
                        @if($_auth->hasAnyPermission(['role-list', 'role-create', 'role-edit', 'role-delete']))
                        <li class="nav-item dropdown {{ ( Route::is('roles.index') ) ? 'open' : ''}}">
                            <a class="dropdown-toggle" href="javascript:void(0);">
                                <span class="icon-holder">
                                    <i class="mdi mdi-tune-vertical"></i>
                                </span>
                                <span class="title">Setting</span>
                                <span class="arrow">
                                    <i class="mdi mdi-chevron-right"></i>
                                </span>
                            </a>
                            <ul class="dropdown-menu">
                                @if($_auth->hasAnyPermission(['role-list', 'role-create', 'role-edit', 'role-delete']))
                                <li class="{{ ( Route::is('roles.index')) ? 'active' : ''}}">
                                    <a href="{{ route('roles.index') }}">Roles</a>
                                </li>
                                @endif
                                
                                @if(Auth::user()->hasAnyRole(['Admin']))
                                <li class="{{ ( Route::is('setting.fee')) ? 'active' : ''}}">
                                    <a href="{{ route('setting.fee') }}">Fee</a>
                                </li>
                                @endif
                            </ul>
                        </li>
                        @endif
                        

                        <li class="nav-item dropdown {{ ( Route::is('web-setting.banner') || Route::is('web-setting.announcement') || Route::is('web-setting.latest-news') || Route::is('web-setting.our-podcast') || Route::is('web-setting.success-story') || Route::is('web-setting.discover-gruni') || Route::is('web-setting.school-and-program') || Route::is('web-setting.testimonial')  || Route::is('web-setting.university-cateogry')  || Route::is('web-setting.university')  || Route::is('web-setting.school-of-medicine-course') || Route::is('web-setting.school-of-medicine') || Route::is('web-setting.gruni-information') || Route::is('web-setting.teaching-category') || Route::is('web-setting.teaching') || Route::is('web-setting.admission-category') || Route::is('web-setting.admission') ) ? 'open' : ''}}">
                            <a class="dropdown-toggle" href="javascript:void(0);">
                                <span class="icon-holder">
                                    <i class="mdi mdi-tune-vertical"></i>
                                </span>
                                <span class="title">Web Setting</span>
                                <span class="arrow">
                                    <i class="mdi mdi-chevron-right"></i>
                                </span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="{{ ( Route::is('web-setting.banner')) ? 'active' : ''}}">
                                    <a href="{{ route('web-setting.banner') }}">Home Banner</a>
                                </li>
                                <li class="{{ ( Route::is('web-setting.announcement')) ? 'active' : ''}}">
                                    <a href="{{ route('web-setting.announcement') }}">Announcement</a>
                                </li>
                                <li class="{{ ( Route::is('web-setting.latest-news')) ? 'active' : ''}}">
                                    <a href="{{ route('web-setting.latest-news') }}">Latest News</a>
                                </li>
                                <li class="{{ ( Route::is('web-setting.our-podcast')) ? 'active' : ''}}">
                                    <a href="{{ route('web-setting.our-podcast') }}">Our Podcast</a>
                                </li>
                                <li class="{{ ( Route::is('web-setting.success-story')) ? 'active' : ''}}">
                                    <a href="{{ route('web-setting.success-story') }}">Success Story</a>
                                </li>
                                <li class="{{ ( Route::is('web-setting.discover-gruni')) ? 'active' : ''}}">
                                    <a href="{{ route('web-setting.discover-gruni') }}">Discover Gruni</a>
                                </li>
                                <li class="{{ ( Route::is('web-setting.school-and-program')) ? 'active' : ''}}">
                                    <a href="{{ route('web-setting.school-and-program') }}">School and Program</a>
                                </li>
                                <li class="{{ ( Route::is('web-setting.testimonial')) ? 'active' : ''}}">
                                    <a href="{{ route('web-setting.testimonial') }}">Testimonial</a>
                                </li>
                                <li class="{{ ( Route::is('web-setting.university-cateogry')) ? 'active' : ''}}">
                                    <a href="{{ route('web-setting.university-cateogry') }}">University Cateogry</a>
                                </li>
                                <li class="{{ ( Route::is('web-setting.university')) ? 'active' : ''}}">
                                    <a href="{{ route('web-setting.university') }}">University</a>
                                </li>
                                <li class="{{ ( Route::is('web-setting.school-of-medicine-course')) ? 'active' : ''}}">
                                    <a href="{{ route('web-setting.school-of-medicine-course') }}">School of Medicine Course</a>
                                </li>
                                <li class="{{ ( Route::is('web-setting.school-of-medicine')) ? 'active' : ''}}">
                                    <a href="{{ route('web-setting.school-of-medicine') }}">School of Medicine</a>
                                </li>
                                <li class="{{ ( Route::is('web-setting.gruni-information')) ? 'active' : ''}}">
                                    <a href="{{ route('web-setting.gruni-information') }}">Gruni Information</a>
                                </li>
                                <li class="{{ ( Route::is('web-setting.teaching-category')) ? 'active' : ''}}">
                                    <a href="{{ route('web-setting.teaching-category') }}">Learning-Teaching Category</a>
                                </li>
                                <li class="{{ ( Route::is('web-setting.teaching')) ? 'active' : ''}}">
                                    <a href="{{ route('web-setting.teaching') }}">Learning-Teaching</a>
                                </li>
                                <li class="{{ ( Route::is('web-setting.admission-category')) ? 'active' : ''}}">
                                    <a href="{{ route('web-setting.admission-category') }}">Admission Category</a>
                                </li>
                                <li class="{{ ( Route::is('web-setting.admission')) ? 'active' : ''}}">
                                    <a href="{{ route('web-setting.admission') }}">Admission</a>
                                </li>
                            </ul>
                        </li>
                        @endif
                        <li class="nav-item dropdown {{ ( Route::is('admin.student.index')  ) ? 'open' : ''}}">
                            <a class="dropdown-toggle" href="javascript:void(0);">
                                <span class="icon-holder">
                                    <i class="mdi mdi-tune-vertical"></i>
                                </span>
                                <span class="title">Student</span>
                                <span class="arrow">
                                    <i class="mdi mdi-chevron-right"></i>
                                </span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="{{ ( Route::is('admin.student.index')) ? 'active' : ''}}">
                                    <a href="{{ route('admin.student.index') }}">Student List</a>
                                </li>
                            </ul>
                        </li>
                         <li class="nav-item dropdown">
                            <a class="" href="{{ url('admin/student/get_enquiry') }}">
                                <span class="icon-holder">
                                    <i class="mdi mdi-gauge"></i>
                                </span>
                                <span class="title">Enquiry</span>
                            </a>
                        </li>
                       
                                                 
                    </ul>
                </div>
            </div>
            <!-- Side Nav END -->

            <!-- Page Container START -->
            <div class="page-container">
                

                <!-- Content Wrapper START -->
                <div class="main-content">
                    <div class="container-fluid">
                        <div class="page-header">
                            <h2 class="header-title">{{ $sub_title }}</h2>
                            <div class="header-sub-title">
                                <nav class="breadcrumb breadcrumb-dash">
                                    <a href="{{ route('home') }}" class="breadcrumb-item"><i class="ti-home p-r-5"></i>Dashboard</a>
                                    @if($title)<a class="breadcrumb-item" href="{{ $title_url ? $title_url : 'javascript:void(0)' }}">{{ $title }}</a>@endif
                                    @if($sub_title && $sub_title!="Dashboard")<span class="breadcrumb-item active">{{ $sub_title }}</span>@endif
                                </nav>
                            </div>
                        </div>
                        @if( Session()->has('success') || Session()->has('error')  )
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card-body">
                                    @if(Session()->has('success'))
                                    <div class="alert alert-success alert-dismissible fade show">
                                        <strong>{{session('success')}}</strong>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    @endif
                                    @if(Session()->has('error'))
                                    <div class="alert alert-danger alert-dismissible fade show">
                                        <strong>{{session('error')}}</strong> 
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endif

                        @yield('content')

                    </div>
                </div>
                <!-- Content Wrapper END -->

                <!-- Footer START -->
                <footer class="content-footer">
                    <div class="footer">
                        <div class="copyright">
                            <span>Copyright © {{ date("Y") }} <b class="text-dark">GRUNI University</b>. All rights reserved.</span>
                            <span class="go-right">
                                {{-- <a href="#" class="text-gray m-r-15">Term &amp; Conditions</a>
                                <a href="#" class="text-gray">Privacy &amp; Policy</a> --}}
                            </span>
                        </div>
                    </div>
                </footer>
                <!-- Footer END -->
            </div>
            <!-- Page Container END -->
        </div>
    </div>
    <!--chat start-->
    {{-- <a id="backTotop" href="javascript:void(0)" class="sticky-icon" style="display: inline;">
        <i class="fa fa-send-o"></i>
    </a> --}}
    <!--chat end-->
    <script src="{{ url('assets/admin/js/vendor.js')}}"></script>

    <script src="{{ url('assets/admin/js/app.min.js')}}"></script>

    <!-- page js -->
    <script src="{{ url('assets/admin/vendor/moment/min/moment.min.js')}}"></script>
    <script src="{{ url('assets/admin/vendor/selectize/dist/js/standalone/selectize.min.js')}}"></script>
    <script src="{{ url('assets/admin/vendor/summernote/dist/summernote-bs4.min.js')}}"></script>

    <script src="{{ url('assets/admin/js/forms/form-elements.js')}}"></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>

    <!--<script src="{{ url('assets/admin/vendor/sweetalert/lib/sweet-alert.js')}}"></script>-->
    <script src="{{ url('assets/admin/vendor/noty/js/noty/packaged/jquery.noty.packaged.min.js')}}"></script>
    <script src="{{ url('assets/admin/js/components/notifications.js')}}"></script>
    <script>
        $('.read-noti').click(function(){
            var id = $(this).attr('data-id');
            $.ajax({
                    url: '/read-notification/'+id,
                    method: 'get',
                }).then(function (result) {
                    console.log('done');
                });
        })
    </script>
    <script type="text/javascript">
        function notify_message(msg, type){
            noty({
                 theme: 'app-noty',
                 text: msg,
                 type: type,
                 timeout: 3000,
                 layout: 'topRight',
                 closeWith: ['button', 'click'],
                 animation: {
                    open: 'noty-animation fadeIn',
                    close: 'noty-animation fadeOut'
                 }
            });
        }
        function _success(msg){
            notify_message(msg, "success");
        }
        function _error(msg){
            notify_message(msg, "error");
        }
        
        @if(Session::has('error'))
            _error('{{ Session::get("error") }}');
        @endif
        
        @if(Session::has('success'))
            _success('{{ Session::get("success") }}');
        @endif

        $(document).ready(function () {

            setInterval(keepTokenAlive, 1000 * 60 * 15); // every 15 mins

            function keepTokenAlive() {
                $.ajax({
                    url: '/keep-token-alive',
                    method: 'post',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                }).then(function (response) {
                    console.log(new Date() + ' ' + result + ' ' + $('meta[name="csrf-token"]').attr('content'));
                });
            }
        });
    </script>
    @include('layouts.date-scripts')
    @yield('page-script')

</body>

</html>