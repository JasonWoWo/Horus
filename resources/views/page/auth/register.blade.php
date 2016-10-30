@extends('layout.base')
@section('body')
<body class="register-page">
    <div class="register-box">
        <div class="register-box">
            <div class="register-logo">
                <a href="{{URL::to('auth/login')}}"><b>Horus</b>LTE</a>
            </div>
            <div class="register-box-body">
                <p class="register-box-msg">Register new membership</p>
                <form method="post" action="{{URL::to('auth/register')}}">
                    <div class="form-group has-feedback">
                        <input type="text" class="form-control" placeholder="Please sign new UserName" name="username"/>
                        <span class="fa fa-user form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="text" class="form-control" placeholder="Please register new phone" name="phone"/>
                        <span class="fa fa-mobile-phone form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="email" class="form-control" placeholder="Email" name="email"/>
                        <span class="fa fa-envelope-o form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="password" class="form-control" placeholder="Password" name="password"/>
                        <span class="fa fa-lock form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="password" class="form-control" placeholder="Retype Password" name="doublePassword"/>
                        <span class="fa fa-futbol-o form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="text" class="form-control" placeholder="Ticket" name="ticket"/>
                        <span class="fa fa-ticket form-control-feedback"></span>
                    </div>
                    <div class="form-group">
                        <label class="radio-inline">
                            <input type="radio" name="gender" value="1"/> 男
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="gender" value="0"/> 女
                        </label>
                    </div>
                    <div class="row">
                        <div class="col-xs-8">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" />I agree with terms
                                </label>
                            </div>
                        </div>
                        <div class="col-xs-4">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
@endsection