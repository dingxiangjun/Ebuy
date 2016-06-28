$.get('/admin/xApi/sales_count').done(function (data) {

    // console.log(data);
    var myChart = echarts.init(document.getElementById('sales_count'), 'macarons');
    myChart.setOption({
        title: {
            text: '本周订单数',
            subtext:  data.week_start + ' ~ ' + data.week_end
        },
        tooltip : {
            trigger: 'axis'
        },
        legend: {
            data: ['下单', '付款', '配货', '出库', '交易成功']
        },
        toolbox: {
            show: true,
            feature: {
                dataZoom: {},
                dataView: {readOnly: false},
                magicType: {type: ['line', 'bar']},
                restore: {},
                saveAsImage: {}
            }
        },

        xAxis: {
            type: 'category',
            data: ['周一', '周二', '周三', '周四', '周五', '周六', '周日']
        },
        yAxis: {
            type: 'value',
            axisLabel: {
                formatter: '{value}'
            }
        },
        series: [
            {
                name: '下单',
                type: 'bar',
                data: data.count.create,
            },
            {
                name: '付款',
                type: 'bar',
                data: data.count.pay,
            },
            {
                name: '配货',
                type: 'bar',
                data: data.count.picking,
            },
            {
                name: '出库',
                type: 'bar',
                data: data.count.shipping,
            },
            {
                name: '交易成功',
                type: 'bar',
                data: data.count.finish,
            }
        ]
    });
});
