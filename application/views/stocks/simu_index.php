<!--华山论剑首页，模拟炒股首页-->
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="zh-cn">
<?php $this->load->view('./templates/head'); ?>
<?php
$user_data = $user_info['data_user']; //获取用户资金数据
$user_stocks = $user_info['data_stock']; //获取用户持仓数据
?>
<?php $this->load->view('./stocks/graph'); ?>
<body class="bg-gray">
<div class="wrapper">
    <?php $this->load->view('./stocks/bonds_navbar'); ?>
    <div class="container">
        <div class="row">
            <?php $this->load->view('./stocks/simu_menu'); ?>
        </div>
        <div class="row">
            <div class="col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1">
                <div class="bg-white stocks_min_h block-radius">
                    <div class="simulate_panel">
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="home">
                                <div id="pie_canvas"></div>
                                <div>
                                    <h4 class="blue-color margin_to_top">我的资金</h4>
                                    <div class="table-responsive">
                                        <table class="table table-bordered basic_fund_info">
                                            <thead>
                                            <tr>
                                                <th>总资产</th>
                                                <th>总现金</th>
                                                <th>股票市值</th>
                                                <th>仓位</th>
                                                <th>浮动盈亏</th>
                                                <th>盈亏率</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td id="my_asset"></td>
                                                <td class="formatted"><?php echo $user_data['cash_all']; ?></td>
                                                <td id="stock_value"></td>
                                                <td id="my_position"></td>
                                                <td id="pl_value"></td>
                                                <td id="pl_rate"></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div>
                                    <h4 class="blue-color margin_to_top">我的收益</h4>
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th>周期</th>
                                            <th>本日收益率</th>
                                            <th>本周收益率</th>
                                            <th>本月收益率</th>
                                            <th>总收益率</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>
                                                收益率
                                            </td>
                                            <td class="render">
                                                <?php echo number_format(floatval($user_data['day_rate']) * 100, 2); ?>
                                                %
                                            </td>
                                            <td class="render">
                                                <?php echo number_format(floatval($user_data['week_rate']) * 100, 2); ?>
                                                %
                                            </td>
                                            <td class="render">
                                                <?php echo number_format(floatval($user_data['month_rate']) * 100, 2); ?>
                                                %
                                            </td>
                                            <td class="render">
                                                <?php echo number_format(floatval($user_data['profit_rate']) * 100, 2); ?>
                                                %
                                            </td>

                                        </tr>
                                        <tr>
                                            <td>排名</td>
                                            <td><?php echo $user_data['day_rank']; ?></td>
                                            <td><?php echo $user_data['week_rank']; ?></td>
                                            <td><?php echo $user_data['month_rank']; ?></td>
                                            <td>
                                                <?php echo $user_data['profit_rank']; ?>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="warehouse">
                                    <h4 class="blue-color">我的持仓</h4>

                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                            <tr>
                                                <th>股票代码</th>
                                                <th>股票名称</th>
                                                <th>总股数(股)</th>
                                                <th>可卖数量(股)</th>
                                                <th>买入成本</th>
                                                <th>当前价</th>
                                                <th>浮动盈亏</th>
                                                <th>盈亏率</th>
                                                <th>今日涨跌幅</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php foreach ($user_stocks as $stock_item): ?>
                                                <tr id="<?php echo $stock_item['SecurityID']; ?>">
                                                    <td data-toggle="modal" data-target="#graphModal"
                                                        onclick="fillimage('<?= $stock_item['SecurityID']; ?>', '<?= $stock_item['Symbol']; ?>')">
                                                        <a href="#"
                                                           class="hty_a"><?php echo $stock_item['SecurityID']; ?></a>
                                                    </td>
                                                    <td><?php echo $stock_item['Symbol']; ?></td>
                                                    <td class="formatted"><?php echo $stock_item['Volume_All']; ?></td>
                                                    <td class="formatted"><?php echo intval($stock_item['Volume_All']) - intval($stock_item['Ban_Volume']) - intval($stock_item['Order_Volume']); ?></td>
                                                    <td><?php echo number_format(floatval($stock_item['BuyCost']), 2); ?></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                            <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--悬停go-top按钮-->
    <?php $this->load->view('./templates/go-top'); ?>
</div>
<?php $this->load->view('./templates/footer'); ?>

<div class="modal fade" id="graphModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h3 class="modal-title" id="graph_modal_title"></h3>
            </div>
            <div class="modal-body" id="graph_modal_body">
            </div>
        </div>
    </div>
</div>
</body>
<script>
    var interval;
//    $(document).ready(function () {
//        var parts = ['可用现金', '冻结金额', '股票市值'];
//        var cash_use = decimal(parseFloat("<?php //echo $basic_info['cash_use'];?>//"));
//        var cash_freeze = decimal(parseFloat("<?php //echo $basic_info['cash_freeze'];?>//"));
//        var stock_value = decimal(parseFloat("<?php //echo $stock_value;?>//"));
//        var parts_value = [
//            {value:cash_use, name:'可用现金'},
//            {value:cash_freeze, name:'冻结金额'},
//            {value:stock_value, name:'股票市值'}
//        ];
//        var pie_div_id = document.getElementById('pie_canvas');
//        draw_pie(parts, parts_value, pie_div_id); //绘制资金使用情况饼图
//
//    });
    $(document).ready(function () {
        $('.main_jumptron').css('margin-bottom', '0px');
        //将数据显示格式化
        $('.formatted').each(function () {
            var value = format_num($(this).html());
            $(this).html(value);
        });
        //拥有.render类的元素，若大于0，设置为红色，若小于0，设置为绿色
        $('.render').each(function () {
            var value = $(this).html().indexOf('-');
            if (value == -1) {
                $(this).css('color', 'red');
            } else {
                $(this).css('color', 'green');
            }
        });
    });
    $(document).ready(function () {
        load_dynamic_data();
        clearInterval(interval);
        interval = setInterval(load_dynamic_data, 8000); //每隔8s自动请求一次
        //请求动态加载数据
        function load_dynamic_data() {
            var xhr;
            var key;
            if (xhr) {
                xhr.abort();
            }
            xhr = $.ajax({
                url: '<?php echo base_url("index.php/stock/get_dynamic_info/web"); ?>',
                method: 'get',
                dataType: 'json',
                success: function (response) {
                    $('#stock_value').html(format_num(response.stock_value));  //获取并设置股票市值
                    var cash_all = '<?php echo $user_data['cash_all']; ?>'; //获取总现金
                    var asset_all = parseFloat(cash_all) + parseFloat(response.stock_value);
                    $('#my_asset').html(format_num(asset_all));  //设置总资产
                    var position = parseFloat(response.stock_value) * 100 / parseFloat(asset_all);
                    $('#my_position').html(format_num(position) + '%'); //设置仓位
                    var pl_value = $('#pl_value');
                    var pl_rate = $('#pl_rate');
                    if (parseFloat(response.pl_value) > 0) {
                        pl_value.css('color', 'red');
                    } else {
                        pl_value.css('color', 'green');
                    }
                    if (parseFloat(response.pl_rate) > 0) {
                        pl_rate.css('color', 'red');
                    } else {
                        pl_rate.css('color', 'green');
                    }
                    pl_value.html(format_num(response.pl_value)); //获取并设置总盈亏金额
                    pl_rate.html(response.pl_rate); //获取并设置总盈亏比
                    var stock_info = response.stock_info;
                    for (key in stock_info) {
                        var tr_id = '#' + key;
                        if (stock_info[key].length == 0) {
                            $(tr_id).children('td:eq(5)').html('--');  //设置当前价
                            $(tr_id).children('td:eq(6)').html('--');   //设置浮动盈亏
                            $(tr_id).children('td:eq(7)').html('--');   //设置盈亏比
                            $(tr_id).children('td:eq(8)').html('--');  //设置涨跌幅
                        } else {
                            var trade_price = decimal(stock_info[key]['TradePrice']);  //获取当前价，保留小数点后两位
                            var id_extent = decimal(parseFloat(stock_info[key]['id_extent']) * 100);  //获取涨跌幅，保留小数点后两位
                            if (parseFloat(stock_info[key]['float_pl']) < 0) {
                                $(tr_id).children('td:eq(6)').css('color', 'green');
                            } else if (parseFloat(stock_info[key]['float_pl']) >= 0) {
                                $(tr_id).children('td:eq(6)').css('color', 'red');
                            }
                            if (parseFloat(stock_info[key]['float_pl_rate']) < 0) {
                                $(tr_id).children('td:eq(7)').css('color', 'green');
                            } else if (parseFloat(stock_info[key]['float_pl_rate']) >= 0) {
                                $(tr_id).children('td:eq(7)').css('color', 'red');
                            }
                            if (id_extent < 0) {
                                $(tr_id).children('td:eq(8)').css('color', 'green');
                            } else if (id_extent >= 0) {
                                $(tr_id).children('td:eq(8)').css('color', 'red');
                            }
                            $(tr_id).children('td:eq(5)').html(trade_price);  //设置当前价
                            var base_funds = "<?php echo $user_info['base_cash']?>";
                            var float_pl = decimal(parseFloat(asset_all) * 100/ parseFloat(base_funds));
                            $(tr_id).children('td:eq(6)').html(format_num(float_pl));   //设置浮动盈亏
                            $(tr_id).children('td:eq(7)').html(format_num(stock_info[key]['float_pl_rate']) + '%');   //设置盈亏比
                            $(tr_id).children('td:eq(8)').html(id_extent + '%');  //设置涨跌幅
                        }
                    }
                }
            });
        }
    });

    //从新浪获取分时图
    function fillimage(stock_id, stock_name) {
        var modal_body = document.getElementById("graph_modal_body");
        var modal_title = document.getElementById("graph_modal_title");
        var start_code = stock_id.toString().substr(0, 2);
        console.log(start_code);
        if (start_code == '30' || start_code == '00') {
            stock_id = 'sz' + stock_id;
        } else if (start_code == '60') {
            stock_id = 'sh' + stock_id;
        }
        else {
            modal_body.innerHTML = '暂无该数据';
            return;
        }
        modal_body.innerHTML = "<h3>分时图</h3>";
        modal_body.innerHTML += "<img src='http://image.sinajs.cn/newchart/min/n/" + stock_id + ".gif' />";
        modal_body.innerHTML += "<hr/>";
        modal_body.innerHTML += "<h3>K线图</h3>";
        modal_body.innerHTML += "<img src='http://image.sinajs.cn/newchart/daily/n/" + stock_id + ".gif' />";
        modal_title.innerHTML = "<h2>" + "<strong>" + stock_name + "</strong>" + "(" + stock_id + ")" + "</h2>"
    }
</script>

</html>