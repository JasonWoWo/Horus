@extends('layout.base')
@section('body')
<body class="login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="{{URL::to('auth/login')}}"><b>Horus</b>LTE</a>
        </div>
        <div class="login-box-body">
            <p class="login-box-msg">Sign in to start your session</p>
            <form action="{{ URL::to('auth/postLogin') }}" method="POST">
                <div class="form-group has-feedback">
                    <input type="text" name="phone" placeholder="Phone" class="form-control" />
                    <span class="fa fa-mobile-phone form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" name="password" placeholder="Please check your password" class="form-control" />
                    <span class="fa fa-lock form-control-feedback"></span>
                </div>
                <div class="row">
                    <div class="col-xs-8">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" />Remember me
                            </label>
                        </div>
                    </div>
                    <div class="col-xs-4">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                    </div>
                </div>
            </form>
            <a href="#">I forgot my password</a><br>
            <a href="{{ URL::to('auth/register') }}" class="text-center">Register a new membership</a>
        </div>
    </div>
</body>
@endsection