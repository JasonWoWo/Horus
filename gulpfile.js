var elixir = require('laravel-elixir');

require('laravel-elixir-vueify');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

/*
 |--------------------------------------------------------------------------
 | Elixir close Source Maps
 |--------------------------------------------------------------------------
 | 
 | If you do not want source maps generated for your CSS, you may disable them using a simple configuration option:
 */
elixir.config.sourcemaps = false;

elixir(function(mix) {
    mix.browserify('app.js');
    // mix.sass('bootstrap_component.scss');
    // 将特性样式(sass)放入特性的文件夹,作为组建, 供使用者调用

    mix.sass('/auth_sass/login.scss', 'public/css/login/login.css');
    // mix.sass(['app.scss'], 'public/css/app.css');


    // 将特性javascript组建放在特性的文件夹,供使用者调用
    // mix.scripts('node_modules/bootstrap-sass/assets/javascripts/bootstrap.min.js', 'public/js/bootstrap.min.js', './');
    // mix.scripts('resources/bower_components/jquery/dist/jquery.min.js', 'public/js/jquery.min.js', './');
    // 将javascript脚本合并输出
    // mix.scriptsIn('./node_modules/bootstrap-sass/assets/javascripts');
    // mix.copy('node_modules/bootstrap-sass/assets/fonts/bootstrap', 'public/font/')
    // mix.copy('resources/bower_components/jquery/dist/jquery.min.js', 'public/js/');
    // mix.copy('resources/bower_components/AdminLTE/bootstrap/js/bootstrap.min.js', 'public/js/');


    mix.copy([
        'resources/bower_components/AdminLTE/plugins/jQuery/jquery-2.2.3.min.js',
        'resources/bower_components/AdminLTE/bootstrap/js/bootstrap.min.js',
        'resources/bower_components/AdminLTE/dist/js/app.min.js',
        'resources/bower_components/AdminLTE/plugins/datepicker/bootstrap-datepicker.js'
    ], 'public/js/');
    mix.copy([
        'resources/bower_components/AdminLTE/bootstrap/css/bootstrap.min.css',
        'resources/bower_components/AdminLTE/dist/css/AdminLTE.min.css',
        'resources/bower_components/AdminLTE/dist/css/skins/skin-blue.css',
        'resources/bower_components/font-awesome/css/font-awesome.min.css',
        'resources/bower_components/AdminLTE/plugins/datepicker/datepicker3.css'
    ], 'public/css/');

    // mix.copy([
    //     'resource/bower_components/AdminLTE/bootstrap/fonts/'
    // ], 'public/fonts/');
});
