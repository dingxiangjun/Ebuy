<?php
return [
    'page_size' => env('PAGE_SIZE', '12'),

    'order_status' => [
        1 => '待付款',       //下单
        2 => '待发货',       //付款
        3 => '配货中',       //配货
        4 => '待收货',       //出库
        5 => '交易成功',       //交易成功
//        '待退货',
//        '已发送，等到管理员收货',
//        '管理员已收货',
//        '已退款',
//        '已换货'
    ],

    'systems' => [
        'xEbuy' => '长乐小卖部',
        'xAd' => '广告中心',
        'xSystem' => '系统管理',
    ],
];