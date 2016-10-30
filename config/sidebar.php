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
        'title' => '管理者列表',
        'nickName' => 'manager',
        'link' => '/backend/manager',
        'icon' => 'fa fa-link',
    ],
    [
        'title' => '仪表盘',
        'nickName' => 'dashboard',
        'link' => '#',
        'icon' => 'fa fa-dashboard',
        'subItem' => [
            array('title' => '销售量', 'nickName' => 'sale', 'link' => 'backend/managerss', 'icon' => 'fa-square-o'),
            array('title' => '订单列表', 'nickName' => 'count', 'link' => '#', 'icon' => 'fa-star-o'),
            array('title' => '品牌信息列表', 'nickName' => 'managerBrand', 'link' => '#', 'icon' => 'fa-certificate'),
        ],
    ],
    [
        'title' => '账户信息',
        'nickName' => 'account',
        'link' => '#',
        'icon' => 'glyphicon glyphicon-plus',
        'subItem' => [
            array('title' => '用户列表', 'nickName' => 'managerList', 'link' => 'backend/manage'),
            array('title' => '订单信息', 'nickName' => 'order', 'link' => '#'),
            array('title' => '支付信息', 'nickName' => 'payment', 'link' => '#'),
        ],
    ]
);

return [
    'sidebarContent' => [
        'menuContent' => $menuContent,
    ],
];
