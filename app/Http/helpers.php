<?php

//是否...
function is_something($attr, $module)
{
    return $module->$attr ? '<span class="am-icon-check is_something" data-attr="' . $attr . '">
    </span>' : '<span class="am-icon-close is_something" data-attr="' . $attr . '"></span>';
};

/**
 * 栏目名前面加上缩进
 * @param $count
 * @return string
 */
function indent_category($count)
{
    $str = '';
    for ($i = 1; $i < $count; $i++) {
        $str .= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
    }
    return $str;
}

//显示分类对应商品
function show_category_products($category)
{
    if (!$category->products->isEmpty()) {
        return '<a class="am-badge am-badge-secondary" href="' . route('admin.xEbuy.product.index', ['category_id' => $category->id]) . '">查看商品</a>';
    }
}

function show_brand_products($brand)
{
    if (!$brand->products->isEmpty()) {
        return '<a class="am-badge am-badge-secondary" href="' . route('admin.xEbuy.product.index', ['brand_id' => $brand->id]) . '">查看商品</a>';
    }
}

//显示库存
function show_stock($stock)
{
    return $stock == '-1' ? '无限' : $stock;
}


function buildSelect($tableName, $selectName, $valueFieldName, $textFieldName, $selectedValue = '')
{
    $select = "<select data-am-selected='{btnSize: sm, maxHeight: 360, searchBox: 1}' name=$selectName><option value='-1'>所有品牌</option>";
    foreach ($tableName as $k => $v) {
        $value = $v[$valueFieldName];
        $text = $v[$textFieldName];
        if ($selectedValue && $selectedValue == $value) {
            $selected = 'selected="selected"';
        } else {
            $selected = '';
        }
        $select .= "<option $selected value='$value'>$text</option>";
    }

    $select .= "</select>";
    echo $select;

}
/**
 * 订单状态
 * @param $status
 * @return mixed
 */
function order_status($status)
{
    $info = config('xSystem.order_status');
    return $info["$status"];
}

/**
 * 1=> '下单',       //待支付
 * 2=> '付款',       //待发货
 * 3=> '配货',
 * 4=> '出库',       //待收货
 * 5=> '交易成功',    //已完成
 */
function order_color($status)
{
    switch ($status) {
        case '1':
            return 'uc-order-item-pay';         //橙
            break;
        case '2':
            return 'uc-order-item-shipping';    //红
            break;
        case '3':
            return 'uc-order-item-shipping';    //红
            break;
        case '4':
            return 'uc-order-item-receiving';   //绿
            break;
        case '5':
            return 'uc-order-item-finish';      //灰
            break;
        default:
            return 'uc-order-item-finish';
    }
}

function time_format($attr, $datetime)
{
    if ($datetime == "") {
        return "";
    }
    return date($attr, strtotime($datetime));
}




/**
 * 微信菜单, 删除空数组
 * @param $buttons
 */
function wechat_menus($request_buttons)
{
    $buttons = [];

    foreach ($request_buttons as $key => $value) {
        if ($value['name'] == "") {
            continue;
        }

        $buttons["$key"] = wechat_key_url($value);

        foreach ($value["sub_button"] as $k => $v) {
            if ($v['name'] == "") {
                continue;
            }
            $buttons["$key"]["sub_button"][] = wechat_key_url($v);
        }
    }
    return $buttons;
}

/**
 * 根据类型,返回url或者key
 * @param $value
 * @return array
 */
function wechat_key_url($value)
{
    $result = [];

    $result['type'] = $value['type'];
    $result['name'] = $value['name'];
    if ($value['type'] == "click") {
        $result['key'] = $value['value'];
    } else {
        $result['url'] = $value['value'];
    }
    return $result;
}
