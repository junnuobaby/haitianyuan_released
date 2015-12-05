<!--绘制收益率曲线图-->
<script src="<?php echo base_url("assets/js/echarts/echarts.js"); ?>"></script>
<script>
    /**
     * user_rate - 用户收益率
     * avg_rate - 平均收益率
     * div_id - 容纳图形的容器Id
     */
    function draw(user_rate, avg_rate, time_list, div_id) {
        require.config({
            paths: {
                echarts: '<?php echo base_url("assets/js/echarts"); ?>'
            }
        });
        require(
            [
                'echarts',
                'echarts/chart/line',
                'echarts/chart/bar'
            ],
            function (ec) {
                var myChart = ec.init(div_id, 'macarons');
                var option = {
                    title: {
                        text: '收益率变化',
                        subtext: '日收益率'
                    },
                    tooltip: {
                        trigger: 'axis'
                    },
                    legend: {
                        data: ['个人收益率', '平均收益率']
                    },
                    toolbox: {
                        show: true,
                        feature: {
                            dataView : {show: true, readOnly: false},
                            magicType: {show: true, type: ['line', 'bar']},
                            restore: {show: true},
                            saveAsImage: {show: true}
                        }
                    },
                    calculable: true,
                    xAxis: [
                        {
                            type: 'category',
                            boundaryGap: false,
                            data: time_list
                        }
                    ],
                    yAxis: [
                        {
                            type: 'value',
                            axisLabel: {
                                formatter: '{value}%'
                            }
                        }
                    ],
                    series: [
                        {
                            name: '个人收益率',
                            type: 'line',
                            data: user_rate,
                            smooth: true,
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
                            name: '平均收益率',
                            type: 'line',
                            data: avg_rate,
                            smooth: true,
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
                        }
                    ]
                };
                myChart.setOption(option);
            });
    }
    /**
     * 绘制饼图
     * component - 图标条目名称
     * value - 条目值
     * div_id - 容器ID
     */
    function draw_pie(component, value, div_id){
        require.config({
            paths: {
                echarts: '<?php echo base_url("assets/js/echarts"); ?>'
            }
        });
        require(
            [
                'echarts',
                'echarts/chart/pie'
            ],
            function (ec) {
                var myChart = ec.init(div_id, 'macarons');
                var option = {
                    title: {
                        text: '资产分布情况',
                        x:'center'
                    },
                    tooltip : {
                        trigger: 'item',
                        formatter: "{a} <br/>{d}%"
                    },
                    legend: {
                        orient : 'vertical',
                        x : 'left',
                        data:component
                    },
                    animation: false,
                    series : [
                        {
                            name:'资产分布',
                            type:'pie',
                            radius : '55%',
                            center: ['50%', '60%'],
                            data:value
                        }
                    ]
                };
                myChart.setOption(option);
            });
    }
</script>

