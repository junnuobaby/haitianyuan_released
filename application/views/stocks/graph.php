<!--绘制收益率曲线图-->
<script src="<?php echo base_url("assets/js/echarts/echarts.js"); ?>"></script>
<script>
    function draw(user_rate, avg_rate, time_list) {
        //路径配置
        require.config({
            paths: {
                echarts: '<?php echo base_url("assets/js/echarts"); ?>'
            }
        });
        //使用
        require(
            [
                'echarts',
                'echarts/chart/line', // 加载折线图
                'echarts/chart/bar'   // 加载柱状图
            ],
            function (ec) {
                // 基于准备好的dom，初始化echarts图表
                var myChart = ec.init(document.getElementById('perform_canvas'), 'macarons');

                option = {
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
                // 为echarts对象加载数据
                myChart.setOption(option);
            });

    }
    //绘制饼图
    function draw_pie(component, value){
        //路径配置
        require.config({
            paths: {
                echarts: '<?php echo base_url("assets/js/echarts"); ?>'
            }
        });
        //使用
        require(
            [
                'echarts',
                'echarts/chart/pie', // 加载饼状图
            ],
            function (ec) {
                // 基于准备好的dom，初始化echarts图表
                var myChart = ec.init(document.getElementById('pie_canvas'), 'macarons');

                option = {
                    tooltip : {
                        trigger: 'item',
                        formatter: "{a} <br/>{b} : {c} ({d}%)"
                    },
                    legend: {
//                        orient : 'vertical',
//                        x : 'left',
                        data:component
                    },
                    calculable : true,
                    series : [
                        {
                            name:'访问来源',
                            type:'pie',
                            radius : '55%',
                            center: ['50%', '60%'],
                            data:value
                        }
                    ]
                };

                // 为echarts对象加载数据
                myChart.setOption(option);
            });

    }
</script>

