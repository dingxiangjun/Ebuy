$.get('/admin/xApi/sales_area').done(function (data) {

    var myChart = echarts.init(document.getElementById('sales_area'), 'macarons');

    // console.log(data.orders);
    // var sales_count = [];      //成交订单数
    var sum_num = [];      //成交金额

    $.each(data.orders, function (k, v) {
        // sales_count.push({name: v.address.province, value: v.sales_count}),
        sum_num.push({name: v.address.province, value: v.sum_num})
    })

    // console.log(sales_count);

    myChart.setOption({

        title: {
            text: '本月各地区成交额',
            subtext: data.month_start + ' ~ ' + data.month_end,
            left: 'center'
        },
        tooltip: {
            trigger: 'item',
        },
        legend: {
            orient: 'vertical',
            left: 'left',
            data: ['成交金额']
        },
        visualMap: {
            min: 0,
            max: 2500,
            left: 'left',
            top: 'bottom',
            text: ['高', '低'],           // 文本，默认为数值文本
            calculable: true
        },
        toolbox: {
            show: true,
            orient: 'vertical',
            left: 'right',
            top: 'center',
            feature: {
                dataView: {readOnly: false},
                restore: {},
                saveAsImage: {}
            }
        },
        series: [
            {
                name: '成交金额',
                type: 'map',
                mapType: 'china',
                label: {
                    normal: {
                        show: true
                    },
                    emphasis: {
                        show: true
                    }
                },
                data: sum_num
            }
        ]
    });
});