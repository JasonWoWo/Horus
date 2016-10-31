@extends('layout.base')
{{--@section('style')--}}
    {{--尝试在section中调用yield, 在子模版页面实现sub-page-style样式--}}
{{--@endsection--}}
{{--@section('script')--}}
    {{--尝试在section中调用yield, 在子模版页面实现sub-page-script样式--}}
{{--@endsection--}}
@section('body')
    <body class="skin-blue sidebar-mini">
        <div class="wrapper">
            <header class="main-header">
                @include('layout.header')
            </header>
            <aside class="main-sidebar">
                @include('layout.sidebar')
            </aside>
            <div class="content-wrapper">
                <div class="content-header">
                    {{--<h1>--}}
                        {{--DataDetails--}}
                        {{--<small>Items of all</small>--}}
                    {{--</h1>--}}
                    {{--// 暂时将面包屑干掉--}}
                    {{--<ol class="breadcrumb">--}}
                        {{--<li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>--}}
                        {{--<li class="active">Here</li>--}}
                    {{--</ol>--}}
                </div>
                @yield('content')
            </div>
            <footer class="main-footer"></footer>
            <aside class="control-sidebar control-sidebar-dark"></aside>
        </div>
    </body>
@endsection