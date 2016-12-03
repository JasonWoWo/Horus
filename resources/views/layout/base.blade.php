<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
    <meta charset="utf-8"/>
    <title>CMS</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport"/>
    <meta content="" name="description"/>
    <meta content="" name="author"/>
    @include('widget.style')
    @yield('style')
    @include('widget.javascript')
    @yield('script')
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
@yield('body')
<script type="text/javascript" src="https://cdn.bootcss.com/jquery/2.1.4/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.bootcss.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
<script type="text/javascript" src="https://cdn.bootcss.com/moment.js/2.10.6/moment-with-locales.min.js"></script>
<script type="text/javascript" src="https://cdn.bootcss.com/moment-timezone/0.4.0/moment-timezone-with-data.min.js"></script>
<script type="text/javascript" src="https://cdn.bootcss.com/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>
{{Html::script('js/app.js')}}
<!-- END BODY -->
</html>