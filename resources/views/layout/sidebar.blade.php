{{--{!! Menu::get('menuSetting')->asUl() !!}--}}
{{--{!! $menuSetting->asUl(array('class' => 'sidebar-menu')) !!}--}}


<div class="sidebar">
    <!-- user panel (Optional) -->
    <div class="user-panel">
        <div class="pull-left image">
            {{ Html::image('/image/default.jpg', 'User Image', array('class' => "img-circle")) }}
        </div>
        <div class="pull-left info">
            <p>User Name</p>

            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
    </div><!-- /.user-panel -->

    <!-- Search Form (Optional) -->
    <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
            <input type="text" name="q" class="form-control" placeholder="Search...">
        <span class="input-group-btn">
          <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
        </span>
        </div>
    </form><!-- /.sidebar-form -->

    <!-- Sidebar Menu -->
    <ul class="sidebar-menu">
        @include('widget.subMenu', array('items' => $menuSetting->roots()))
    </ul>
    {{--{!! $menuSetting->asUl(array('class' => 'sidebar-menu')) !!}--}}
</div>
