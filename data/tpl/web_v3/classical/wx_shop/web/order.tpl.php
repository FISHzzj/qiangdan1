<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>
<style type="text/css">
    .summary_box .summary{
        display: block;
    }
    .flex.column {
       float: left;
       width: 50%;
       height: 100%;
    }
</style>
<div class="page-header">当前位置：<span class="text-primary">订单概述</span></div>
<div class="page-content">
<div class="row">
    <div class="col-md-6 col-sm-6">
        <div class="summary_box">
            <div class="summary_title">
                <span class="text-default title_inner">今日成交</span>
                <span class="pull-right" style="margin-right: 30px">人均消费 : ¥ <span class="today-avg"></span></span>
            </div>
            <div class="summary flex">
                <div class="flex1 flex column" style="border-right: 1px solid #efefef">
                    成交量
                    <h2 class="today-count">--</h2>
                </div>
                <div class="flex1 flex column">
                    成交额
                    <h2 class="text-danger">¥ <span class="today-price">--</span></h2>
                </div>

            </div>
        </div>
    </div>

    <div class="col-md-6 col-sm-6">
        <div class="summary_box">
            <div class="summary_title">
                <span class="text-default title_inner">昨日成交</span>
                <span class="pull-right" style="margin-right: 30px">人均消费 : ¥ <span class="yesterday-avg">--</span></span>
            </div>
            <div class="summary flex">
                <div class="flex1 flex column" style="border-right: 1px solid #efefef">
                    成交量
                    <h2 class="yesterday-count">--</h2>
                </div>
                <div class="flex1 flex column">
                    成交额
                    <h2 class="text-danger">¥ <span class="yesterday-price">--</span></h2>
                </div>

            </div>
        </div>
    </div>

    <div class="col-md-6 col-sm-6">
        <div class="summary_box">
            <div class="summary_title">
                <span class="text-default title_inner">近7日成交</span>
                <span class="pull-right" style="margin-right: 30px">人均消费 : ¥ <span class="seven-avg">--</span></span>
            </div>
            <div class="summary flex">
                <div class="flex1 flex column" style="border-right: 1px solid #efefef">
                    成交量
                    <h2 class="seven-count">--</h2>
                </div>
                <div class="flex1 flex column">
                    成交额
                    <h2 class="text-danger">¥ <span class="seven-price">--</span></h2>
                </div>

            </div>
        </div>
    </div>

    <div class="col-md-6 col-sm-6">
        <div class="summary_box">
            <div class="summary_title">
                <span class="text-default title_inner">近1个月成交</span>
                <span class="pull-right" style="margin-right: 30px">人均消费 : ¥ <span class="month-avg">--</span></span>
            </div>
            <div class="summary flex">
                <div class="flex1 flex column" style="border-right: 1px solid #efefef">
                    成交量
                    <h2 class="month-count">--</h2>
                </div>
                <div class="flex1 flex column">
                    成交额
                    <h2 class="text-danger">¥ <span class="month-price">--</span></h2>
                </div>

            </div>
        </div>
    </div>

    <div class="col-sm-12">
        <div class="ibox float-e-margins" style="border: 1px solid #e7eaec">
            <div class="ibox-title">
                <h5>交易走势图</h5>
            </div>
            <div class="ibox-content">
                <div class="echarts" id="echarts-line-chart" style="display: none"></div>

                <div class="spiner-example" id="echarts-line-chart-loading">
                    <div class="sk-spinner sk-spinner-wave">
                        <div class="sk-rect1"></div>
                        <div class="sk-rect2"></div>
                        <div class="sk-rect3"></div>
                        <div class="sk-rect4"></div>
                        <div class="sk-rect5"></div>
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>
</div>
<script>
    $(function () {
        $.ajax({
            type: "GET",
            // url: "<?php  echo webUrl('order/ajaxorder')?>",
            url: "<?php  echo webUrl('order/sd_list/newAjaxorder')?>",
            dataType: "json",
            success: function (data) {
                var json = data.result;
                $(".today-count").text(json.order0.count);
                $(".today-price").text(json.order0.price);
                $(".today-avg").text(json.order0.avg);

                $(".yesterday-count").text(json.order1.count);
                $(".yesterday-price").text(json.order1.price);
                $(".yesterday-avg").text(json.order1.avg);

                $(".seven-count").text(json.order7.count);
                $(".seven-price").text(json.order7.price);
                $(".seven-avg").text(json.order7.avg);

                $(".month-count").text(json.order30.count);
                $(".month-price").text(json.order30.price);
                $(".month-avg").text(json.order30.avg);

                $.ajax({
                    type: "GET",
                    async: false,
                    // url: "<?php  echo webUrl('order/ajaxtransaction')?>",
                    url: "<?php  echo webUrl('order/sd_list/newAjaxtransaction')?>",
                    dataType: "json",
                    success: function (json) {
                        myrequire(['echarts'], function () {
                            var lineChart = echarts.init(document.getElementById("echarts-line-chart"));
                            var lineoption = {
                                title: {
                                    text: '最近7日交易走势'
                                },
                                tooltip: {
                                    trigger: 'axis'
                                },
                                legend: {
                                    data: ['成交额', '成交量']
                                },
                                grid: {
                                    x: 50,
                                    x2: 50,
                                    y2: 30
                                },
                                calculable: true,
                                xAxis: [
                                    {
                                        type: 'category',
                                        boundaryGap: false,
                                        data: json.price_key
                                    }
                                ],
                                yAxis: [
                                    {
                                        type: 'value',
                                        axisLabel: {
                                            formatter: '{value}'
                                        }
                                    }
                                ],
                                series: [
                                    {
                                        name: '成交额',
                                        type: 'line',
                                        data: json.price_value,
                                        markPoint: {
                                            data: [
                                                {type: 'max', name: '最大值'},
                                                {type: 'min', name: '最小值'}
                                            ]
                                        },
                                        markLine: {
                                            data: [
                                                {type: 'average', name: '平均值'}
                                            ]
                                        }
                                    },
                                    {
                                        name: '成交量',
                                        type: 'line',
                                        data: json.count_value,
                                        markLine: {
                                            data: [
                                                {type: 'average', name: '平均值'}
                                            ]
                                        }
                                    }
                                ]
                            };
                            lineChart.setOption(lineoption);
                            lineChart.resize();
                        });
                        $("#echarts-line-chart-loading").hide();
                        $("#echarts-line-chart").show();
                    }
                });
            }
        });
    });
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>
