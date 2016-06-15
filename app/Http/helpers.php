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
