<!--绘制收益率曲线图-->
<script src="<?php echo base_url("assets/js/echarts/echarts.js"); ?>"></script>
<script>
    function draw() {
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
                'echarts/chart/bar'  // 加载柱状图
            ],
            function (ec) {
                // 基于准备好的dom，初始化echarts图表
                var myChart = ec.init(document.getElementById('perform_canvas'));

                option = {
                    title: {
                        text: '收益率变化',
                        subtext: '日收益率'
                    },
                    tooltip: {
                        trigger: 'axis'
                    },
                    legend: {
                        data: ['收益率', '平均收益率']
                    },
                    toolbox: {
                        show: true,
                        feature: {
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
                            data: ['周一', '周二', '周三', '周四', '周五', '周六', '周日']
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
                            name: '收益率',
                            type: 'line',
                            data: [3, 4, 5, 3, 2, 3, 4],
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
                            data: [-1, 0, 1, 0.5, -0.5, 2, 1.5],
                            markPoint: {
                                data: [
                                    {name: '周最低', value: -2, xAxis: 1, yAxis: -1.5}
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
</script>

