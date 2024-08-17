
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login - {{ config('app.name', 'Webarctech') }}</title>

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
</head>

<body>
    <div class="app">
        <div class="layout bg-gradient-info">
            <div class="container">
                <div class="row full-height align-items-center">
                    <div class="col-md-7 d-none d-md-block">
                        <img class="img-fluid" src="{{ url('assets/admin/images/logo/logo.png')}}" alt="">
                        <div class="m-t-15 m-l-20">
                            <h1 class="font-weight-light font-size-35 text-white">Exploring The World</h1>
                            <p class="text-white width-70 text-opacity m-t-25 font-size-16">Climb leg rub face on everything give attitude nap all day for under the bed. Chase mice attack feet but rub face on everything hopped up.</p>
                            {{-- <div class="m-t-60">
                                <a href="" class="text-white text-link m-r-15">Term &amp; Conditions</a>
                                <a href="" class="text-white text-link">Privacy &amp; Policy</a>
                            </div> --}}
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="card card-shadow">
                            <div class="card-body">
                                <div class="p-h-15 p-v-40">
                                    <h2>Login</h2>
                                    <p class="m-b-15 font-size-13">Please enter your user name and password to login</p>
                                    <form method="POST" action="{{ route('login') }}">
                                        @csrf
                                        <div class="form-group">
                                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email">

                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">

                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} style="margin-left: 0;">

                                            <label class="form-check-label" for="remember" style="margin-left: 20px;">
                                                {{ __('Remember Me') }}
                                            </label>
                                        </div>
                                        <button type="submit" class="btn btn-block btn-lg btn-gradient-success">
                                            {{ __('Login') }}
                                        </button>

                                        @if (Route::has('password.request'))
                                            {{-- <div class="text-center m-t-30">
                                                <a class="text-gray text-link text-opacity" href="{{ route('password.request') }}">
                                                    {{ __('Forgot Your Password?') }}
                                                </a>
                                            </div> --}}
                                        @endif
                                        
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ url('assets/admin/js/vendor.js')}}"></script>

    <script src="{{ url('assets/admin/js/app.min.js')}}"></script>

    <!-- page js -->
    
</body>

</html>