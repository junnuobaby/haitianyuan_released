/**
 * Created by Administrator on 2015/11/16.
 */
define(function() {

    var theme = {
        // 榛樿鑹叉澘
        color: [
            '#c12e34','#e6b600','#0098d9','#2b821d',
            '#005eaa','#339ca8','#cda819','#32a487'
        ],

        // 鍥捐〃鏍囬
        title: {
            textStyle: {
                fontWeight: 'normal'
            }
        },

        // 鍊煎煙
        dataRange: {
            itemWidth: 15,             // 鍊煎煙鍥惧舰瀹藉害锛岀嚎鎬ф笎鍙樻按骞冲竷灞€瀹藉害涓鸿鍊� * 10
            color:['#1790cf','#a2d4e6']
        },

        // 宸ュ叿绠�
        toolbox: {
            color : ['#06467c','#00613c','#872d2f','#c47630']
        },

        // 鎻愮ず妗�
        tooltip: {
            backgroundColor: 'rgba(0,0,0,0.6)'
        },

        // 鍖哄煙缂╂斁鎺у埗鍣�
        dataZoom: {
            dataBackgroundColor: '#dedede',            // 鏁版嵁鑳屾櫙棰滆壊
            fillerColor: 'rgba(154,217,247,0.2)',   // 濉厖棰滆壊
            handleColor: '#005eaa'     // 鎵嬫焺棰滆壊
        },

        // 缃戞牸
        grid: {
            borderWidth: 0
        },

        // 绫荤洰杞�
        categoryAxis: {
            axisLine: {            // 鍧愭爣杞寸嚎
                show: false
            },
            axisTick: {            // 鍧愭爣杞村皬鏍囪
                show: false
            }
        },

        // 鏁板€煎瀷鍧愭爣杞撮粯璁ゅ弬鏁�
        valueAxis: {
            axisLine: {            // 鍧愭爣杞寸嚎
                show: false
            },
            axisTick: {            // 鍧愭爣杞村皬鏍囪
                show: false
            },
            splitArea: {           // 鍒嗛殧鍖哄煙
                show: true,       // 榛樿涓嶆樉绀猴紝灞炴€how鎺у埗鏄剧ず涓庡惁
                areaStyle: {       // 灞炴€reaStyle锛堣瑙乤reaStyle锛夋帶鍒跺尯鍩熸牱寮�
                    color: ['rgba(250,250,250,0.2)','rgba(200,200,200,0.2)']
                }
            }
        },

        timeline : {
            lineStyle : {
                color : '#005eaa'
            },
            controlStyle : {
                normal : { color : '#005eaa'},
                emphasis : { color : '#005eaa'}
            }
        },

        // K绾垮浘榛樿鍙傛暟
        k: {
            itemStyle: {
                normal: {
                    color: '#c12e34',          // 闃崇嚎濉厖棰滆壊
                    color0: '#2b821d',      // 闃寸嚎濉厖棰滆壊
                    lineStyle: {
                        width: 1,
                        color: '#c12e34',   // 闃崇嚎杈规棰滆壊
                        color0: '#2b821d'   // 闃寸嚎杈规棰滆壊
                    }
                }
            }
        },

        map: {
            itemStyle: {
                normal: {
                    areaStyle: {
                        color: '#ddd'
                    },
                    label: {
                        textStyle: {
                            color: '#c12e34'
                        }
                    }
                },
                emphasis: {                 // 涔熸槸閫変腑鏍峰紡
                    areaStyle: {
                        color: '#e6b600'
                    },
                    label: {
                        textStyle: {
                            color: '#c12e34'
                        }
                    }
                }
            }
        },

        force : {
            itemStyle: {
                normal: {
                    linkStyle : {
                        color : '#005eaa'
                    }
                }
            }
        },

        chord : {
            itemStyle : {
                normal : {
                    borderWidth: 1,
                    borderColor: 'rgba(128, 128, 128, 0.5)',
                    chordStyle : {
                        lineStyle : {
                            color : 'rgba(128, 128, 128, 0.5)'
                        }
                    }
                },
                emphasis : {
                    borderWidth: 1,
                    borderColor: 'rgba(128, 128, 128, 0.5)',
                    chordStyle : {
                        lineStyle : {
                            color : 'rgba(128, 128, 128, 0.5)'
                        }
                    }
                }
            }
        },

        gauge : {
            axisLine: {            // 鍧愭爣杞寸嚎
                show: true,        // 榛樿鏄剧ず锛屽睘鎬how鎺у埗鏄剧ず涓庡惁
                lineStyle: {       // 灞炴€ineStyle鎺у埗绾挎潯鏍峰紡
                    color: [[0.2, '#2b821d'],[0.8, '#005eaa'],[1, '#c12e34']],
                    width: 5
                }
            },
            axisTick: {            // 鍧愭爣杞村皬鏍囪
                splitNumber: 10,   // 姣忎唤split缁嗗垎澶氬皯娈�
                length :8,        // 灞炴€ength鎺у埗绾块暱
                lineStyle: {       // 灞炴€ineStyle鎺у埗绾挎潯鏍峰紡
                    color: 'auto'
                }
            },
            axisLabel: {           // 鍧愭爣杞存枃鏈爣绛撅紝璇﹁axis.axisLabel
                textStyle: {       // 鍏朵綑灞炴€ч粯璁や娇鐢ㄥ叏灞€鏂囨湰鏍峰紡锛岃瑙乀EXTSTYLE
                    color: 'auto'
                }
            },
            splitLine: {           // 鍒嗛殧绾�
                length : 12,         // 灞炴€ength鎺у埗绾块暱
                lineStyle: {       // 灞炴€ineStyle锛堣瑙乴ineStyle锛夋帶鍒剁嚎鏉℃牱寮�
                    color: 'auto'
                }
            },
            pointer : {
                length : '90%',
                width : 3,
                color : 'auto'
            },
            title : {
                textStyle: {       // 鍏朵綑灞炴€ч粯璁や娇鐢ㄥ叏灞€鏂囨湰鏍峰紡锛岃瑙乀EXTSTYLE
                    color: '#333'
                }
            },
            detail : {
                textStyle: {       // 鍏朵綑灞炴€ч粯璁や娇鐢ㄥ叏灞€鏂囨湰鏍峰紡锛岃瑙乀EXTSTYLE
                    color: 'auto'
                }
            }
        },

        textStyle: {
            fontFamily: '寰蒋闆呴粦, Arial, Verdana, sans-serif'
        }
    };

    return theme;
});