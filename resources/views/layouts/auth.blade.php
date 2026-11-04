<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title') | {{ $setting->brand_title ?? config('app.name') }}</title>

        <link rel="icon" href="{{ !empty($setting->favicon_icon) ? asset('assets/uploads/logo/'.$setting->favicon_icon) : asset('assets/images/favicon.ico') }}" type="image/x-icon" />
        <link href="{{ asset('assets/vendors/bootstrap/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet">
        @include('auth.partials.login-css')
    </head>
    <body class="login">
        <div class="login_wrapper">
            @if (!empty($setting->brand_logo))
                <section>
                    <center><img src="{{ asset('assets/uploads/logo/'.$setting->brand_logo) }}" class="login-logo" alt=""></center>
                </section>
            @endif
            <div class="form login_form">
                <section><h1 class="text-center">@yield('title')</h1></section>
                <section class="login_content">
                    <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                        @if (session('error'))
                            <p class="red" style="color: #fff;">{{ session('error') }}</p>
                        @endif
                        @if (session('success'))
                            <p class="green" style="color: #fff;">{{ session('success') }}</p>
                        @endif
                        @foreach ($errors->all() as $message)
                            <p class="red" style="color: #fff;">{{ $message }}</p>
                        @endforeach
                    </div>
                    @yield('form')
                </section>
            </div>
        </div>
    </body>
</html>
