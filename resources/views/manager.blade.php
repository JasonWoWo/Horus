@extends('layout.layout');
@section('content')
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <h1>
                ManagerPageHeader
                <small>Optional description</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
                <li class="active">Here</li>
            </ol>
        </div>
        <div class="content body">
            <div id="vue-content" class="box box-solid box-info"></div>
        </div>
    {{Html::script('js/app.js')}}
@endsection
