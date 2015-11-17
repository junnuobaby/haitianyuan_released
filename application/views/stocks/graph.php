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
                    title: {
                        text: '资产分布情况'
                    },
                    tooltip : {
                        trigger: 'item',
                        formatter: "{a} <br/>{b} : {c} ({d}%)"
                    },
                    legend: {
                        data:component
                    },
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

                // 为echarts对象加载数据
                myChart.setOption(option);
            });
    }
    //绘制柱状图
    function draw_bar(component, value){
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
                'echarts/chart/bar', // 加载柱状图
            ],
            function (ec) {
                // 基于准备好的dom，初始化echarts图表
                var myChart = ec.init(document.getElementById('bar_canvas'), 'macarons');
                var placeHoledStyle = {
                    normal:{
                        barBorderColor:'rgba(0,0,0,0)',
                        color:'rgba(0,0,0,0)'
                    },
                    emphasis:{
                        barBorderColor:'rgba(0,0,0,0)',
                        color:'rgba(0,0,0,0)'
                    }
                };
                var dataStyle = {
                    normal: {
                        label : {
                            show: true,
                            position: 'insideLeft',
                            formatter: '{c}%'
                        }
                    }
                };
                option = {
                    title: {
                        text: '多维条形图',
                        subtext: 'From ExcelHome',
                        sublink: 'http://e.weibo.com/1341556070/AiEscco0H'
                    },
                    tooltip : {
                        trigger: 'axis',
                        axisPointer : {            // 坐标轴指示器，坐标轴触发有效
                            type : 'shadow'        // 默认为直线，可选为：'line' | 'shadow'
                        },
                        formatter : '{b}<br/>{a0}:{c0}%<br/>{a2}:{c2}%<br/>{a4}:{c4}%<br/>{a6}:{c6}%'
                    },
                    legend: {
                        y: 55,
                        itemGap : document.getElementById('main').offsetWidth / 8,
                        data:['GML', 'PYP','WTC', 'ZTW']
                    },
//                    toolbox: {
//                        show : true,
//                        feature : {
//                            mark : {show: true},
//                            dataView : {show: true, readOnly: false},
//                            restore : {show: true},
//                            saveAsImage : {show: true}
//                        }
//                    },
                    grid: {
                        y: 80,
                        y2: 30
                    },
                    xAxis : [
                        {
                            type : 'value',
                            position: 'top',
                            splitLine: {show: false},
                            axisLabel: {show: false}
                        }
                    ],
                    yAxis : [
                        {
                            type : 'category',
                            splitLine: {show: false},
                            data : ['重庆', '天津', '上海', '北京']
                        }
                    ],
                    series : [
                        {
                            name:'GML',
                            type:'bar',
                            stack: '总量',
                            itemStyle : dataStyle,
                            data:[38, 50, 33, 72]
                        },
                        {
                            name:'GML',
                            type:'bar',
                            stack: '总量',
                            itemStyle: placeHoledStyle,
                            data:[62, 50, 67, 28]
                        },
                        {
                            name:'PYP',
                            type:'bar',
                            stack: '总量',
                            itemStyle : dataStyle,
                            data:[61, 41, 42, 30]
                        },
                        {
                            name:'PYP',
                            type:'bar',
                            stack: '总量',
                            itemStyle: placeHoledStyle,
                            data:[39, 59, 58, 70]
                        },
                        {
                            name:'WTC',
                            type:'bar',
                            stack: '总量',
                            itemStyle : dataStyle,
                            data:[37, 35, 44, 60]
                        },
                        {
                            name:'WTC',
                            type:'bar',
                            stack: '总量',
                            itemStyle: placeHoledStyle,
                            data:[63, 65, 56, 40]
                        },
                        {
                            name:'ZTW',
                            type:'bar',
                            stack: '总量',
                            itemStyle : dataStyle,
                            data:[71, 50, 31, 39]
                        },
                        {
                            name:'ZTW',
                            type:'bar',
                            stack: '总量',
                            itemStyle: placeHoledStyle,
                            data:[29, 50, 69, 61]
                        }
                    ]
                };
                // 为echarts对象加载数据
                myChart.setOption(option);
            });
    }
</script>

