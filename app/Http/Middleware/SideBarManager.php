<?php
/**
 * Created by PhpStorm.
 * User: wangxionghao
 * Date: 2016/10/30
 * Time: 下午12:01
 */

namespace App\Http\Middleware;

use Closure;
use Lavary\Menu\Item;
class SideBarManager
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $uri = $request->getRequestUri();
        $sidebarContent = config('sidebar.sidebarContent');
        /** \Lavary\Menu\Menu $menu */
        \Menu::make('menuSetting', function (\Lavary\Menu\Builder $menu) use ($sidebarContent, $uri) {
            $uriActive = array('class' => 'active');
            foreach ($sidebarContent['menuContent'] as $menuItems) {
                $title = $menuItems['title'];
                $nickname = $menuItems['nickName'];
                $menu->add($title)->nickname($nickname);
                if ($menuItems['link'] == $uri) {
                    $menu->item($nickname)->attr($uriActive);
                }
                /** @var Item $subMenu */
                $subMenu = $menu->get($nickname);
                if (!empty($menuItems['link'])) {
                    $subMenu->link->href($menuItems['link']);
                }
                $iconHtml = '';
                if (!empty($menuItems['icon'])) {
                    $iconHtml = sprintf('<span class="%s icon-fit"></span>', $menuItems['icon']);
                }
                if (isset($menuItems['subItem'])) {
                    $iconHtml = sprintf('<span class="%s icon-fit"></span><i class="fa fa-angle-left pull-right"></i>', $menuItems['icon']);
                    $subItem = $menuItems['subItem'];
                    foreach ($subItem as $item) {
                        $subMenu->add($item['title'], array('url' => $item['link'], 'nickname' => $item['nickName']));
                        /** @var Item $subMenuItem */
                        $subMenuItem = $menu->item($item['nickName']);
                        $subIconHtml = sprintf('<i class="fa fa-circle-o"></i>');
                        if (isset($item['icon'])) {
                            $subIconHtml = sprintf('<i class="fa %s"></i>', $item['icon']);
                        }
                        $subMenuItem->prepend($subIconHtml);
                    }
                }
                $subMenu->prepend($iconHtml);
            }
        });
        return $next($request);
    }
}