<?php

$menuContent = array(
    // 这只是一个栗子, 后面会编写好配置文档!
//    [
        // 一级li标签的title 必选
//        'title' => 'Account',
        // 一级li标签的跳转链接href, 如果是含有二级子列表默认情况是#, 否则, 自定义跳转地址  必选
//        'link' => '#',
        // 一级li标签的icon, 可参考Bootstrap 和 font-awesome的图标栗子, 请查看文档 可选
//        'icon' => 'glyphicon glyphicon-plus',
        // 是否含有子列表, 子列表主要关系title和link, 其它样式自己扩展  可选
//        'subItem' => [
//            array('title' => 'home', 'link' => '#'),
//            array('title' => 'User', 'link' => '#'),
//            array('title' => 'Password', 'link' => '#'),
//        ],
//    ],

    // 含有导航栏头部标题
//    [
//        'title' => 'Single',
//        'link' => '',
//        'specialOutDoll' => array('class' => 'header'),
//        'icon' => '',
//    ],

    [
        'title' => 'OrderItems',
        'nickName' => 'orderReport',
        'link' => 'backend/order',
        'icon' => 'fa fa-shopping-cart'
    ],
    [
        'title' => 'ReportDashboard',
        'nickName' => 'report',
        'link' => '#',
        'icon' => 'fa fa-dashboard',
        'subItem' => [
            ['title' => 'saleReport', 'nickName' => 'sale', 'link' => 'backend/sale', 'icon' => 'fa fa-bar-chart-o'],
            ['title' => 'stockReport', 'nickName' => 'stock', 'link' => 'backend/stock', 'icon' =>'fa fa-bar-chart-o'],
            ['title' => 'clientSaleReport', 'nickName' => 'clientSale', 'link' => 'backend/clientReport', 'icon' => 'fa fa-bar-chart-o']
        ],
    ],
    [
        'title' => 'BrandDashboard',
        'nickName' => 'brand',
        'link' => '/backend/brandMgr',
        'icon' => 'fa fa-codepen'
    ],
    [
        'title' => 'ProductDashboard',
        'nickName' => 'product',
        'link' => '/backend/productMgr',
        'icon' => 'fa fa-reorder'
    ],
    [
        'title' => 'AdminDashboard',
        'nickName' => 'manager',
        'link' => '/backend/manager',
        'icon' => 'fa fa-user-secret',
    ],
    [
        'title' => 'UserDashboard',
        'nickName' => 'user',
        'link' => '/backend/user',
        'icon' => 'fa fa-user',
    ],
);

return [
    'sidebarContent' => [
        'menuContent' => $menuContent,
    ],
];
