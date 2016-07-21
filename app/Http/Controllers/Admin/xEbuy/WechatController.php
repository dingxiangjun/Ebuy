<?php

namespace App\Http\Controllers\Admin\xEbuy;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\CommonController;

use App\Http\Requests;
use Cache;
use EasyWeChat\Core\Exceptions\HttpException;

use EasyWeChat;

class WechatController extends CommonController
{
    private $menu;

    public function __construct()
    {
        parent::__construct();

        $this->menu = EasyWeChat::menu();

        view()->share([
            '_system' => 'xEbuy',
            '_xEbuy' => 'am-in',
            '_title' => '微信管理-'
        ]);
        Cache::forget('xWechat_config_menus');
    }

    /**
     * 自定义菜单
     */
    function edit()
    {

        try {
            $buttons = Cache::rememberForever('xWechat_config_menus', function () {
                $menus = $this->menu->all();
                return $menus->menu['button'];
            });

        } catch (HttpException $e) {
            $buttons = [];
        }
        //return $buttons;
        Cache::forget('xWechat_config_menus');
        return view('Admin.xEbuy.wechats.edit')
            ->with('buttons', $buttons)
            ->with('_menu', 'am-active');

    }

   /* function update(Request $request)
    {

        $buttons = wechat_menus($request->buttons);

        $this->menu->add($buttons);
        Cache::forget('xWechat_config_menus');
        return back()->with('success', '您已成功设置菜单，请取消关注后，再重新关注~');
    }

    function destroy()
    {
        $this->menu->destroy();
        Cache::forget('xWechat_config_menus');
        return back()->with('success', '您已成功删除菜单，请取消关注后，再重新关注~');
    }*/
}
