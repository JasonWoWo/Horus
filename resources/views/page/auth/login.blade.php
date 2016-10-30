@extends('layout.base')
@section('style')
    {{ Html::style('/css/login/login.css') }}
@endsection
@section('script')
    {{ Html::script('') }}
@endsection
@section('body')
<body>
    <div>
        <div class="login_m base_form">
            <div class="login_logo login">{{Html::image('image/logo.png')}}</div>
            <div class="login_boder login_framer">
                <div class="login_model login_content">
                    <form method="POST" action="{{ URL::to('auth/postLogin') }}">
                        <div class="login_alert"></div>
                        <div class="form-group">
                            <label>USERNAME</label>
                            <input class="common_input input-bottom" placeholder="Phone" name="phone"/>
                        </div>
                        <div class="form-group">
                            <label>PASSWORD</label>
                            <input class="common_input" placeholder="Please check your password" name="password"/>
                        </div>
                        <p class="form-forget"><a id="iforget" href="javascript:void(0);">Forgot your password?</a></p>
                        <div class="login-remember">
                            <div class="login-rember-sub">
                                <input type="checkbox" name="checkbox" id="save-me" />
                                <label for="checkbox">Remember me</label>
                            </div>
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="submit" class="sub-button" name="submit-button" value="SIGN-IN" style="opacity: 0.7;" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

@endsection
