<!--华山论剑首页，模拟炒股首页-->
<!--我的股票下面，股票当前价，股票市值，浮动盈亏，盈亏率，今日涨跌幅是动态获取和变化的-->
<!--我的债券下面，债券当前价，债券市值，浮动盈亏，盈亏率，今日涨跌幅，全价是动态获取和变化的-->
<!--总资产是总现金与所持证券的市值之和-->
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="zh-cn">
<?php
/**
 * user_data - dict - 用户资金数据
 *             key:
 *                cash_all - 总现金
 *                cash_use - 可用现金
 *                cash_freeze - 冻结资金
 * user_stocks - dict - 用户股票持仓
 * user_bonds - dict - 用户债券持仓
 *             key:
 *                SecurityID - 代码
 *                Symbol - 名称
 *                Volume_All -
 *                Ban_Volume - 不可卖出数量
 *                Order_Volume - ？
 *                BuyCost - 买入成本
 *                day_letf - 距付息日（天）- (*仅债券有该字段)
 *                expire-day - 到期时间 - (*仅债券有该字段)
 *                interest - ？ - (*仅债券有该字段)
 * base_funds - number - 用户起始资金
 */
$user_data = $user_info['data_user'];
$user_stocks = $user_info['data_stock'];
$user_bonds = $user_info['data_bond'];
$base_funds = $user_data['base_cash'];
?>
<!--绘图文件-->
<?php $this->load->view('./stocks/graph'); ?>
<?php $this->load->view('./templates/head'); ?>
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
                                <div class="row">
                                    <div id="pie_canvas" class="col-md-8"></div>
                                    <div class="col-md-4">
                                        <h4 class="theme-color container_to_top">我的资金</h4>
                                        <div class="table-responsive">
                                            <table class="table  basic_fund_info">
                                                <tr><th>总资产</th><td id="my_asset" class="formatted"></td></tr>
                                                <tr><th>总现金</th><td class="formatted"><?php echo $user_data['cash_all']; ?></td></tr>
                                                <tr><th>可用现金</th><td class="formatted"><?php echo $user_data['cash_use']; ?></td></tr>
                                                <tr><th>股票市值</th><td id="stock_value"></td></tr>
                                                <tr><th>债券市值</th><td id="bond_value"></td></tr>
                                                <tr><th>仓位</th><td id="my_position"></td></tr>
                                                <tr><th>总盈亏</th><td id="pl_value"></td></tr>
                                                <tr><th>总盈亏率</th><td id="pl_rate"></td></tr>
                                                <tr><th>浮动盈亏</th><td id="fd_value"></td></tr>
                                                <tr><th>浮动盈亏率</th><td id="fd_rate"></td></tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="warehouse">
                                    <h4 class="theme-color">我的股票<small>(行情每8s刷新)</small></h4>
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                            <tr>
                                                <th>代码</th>
                                                <th>名称</th>
                                                <th>持仓</th>
                                                <th>可卖</th>
                                                <th>成本价</th>
                                                <th>当前价</th>
                                                <th>浮动盈亏</th>
                                                <th>盈亏率</th>
                                                <th>涨跌幅</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php foreach ($user_stocks as $stock_item): ?>
                                                <tr id="<?php echo $stock_item['SecurityID']; ?>">
                                                    <td data-toggle="modal" data-target="#graphModal" onclick="fillimage('<?= $stock_item['SecurityID']; ?>', '<?= $stock_item['Symbol']; ?>')">
                                                        <a href="#" class="hty_a"><?php echo $stock_item['SecurityID']; ?></a>
                                                    </td>
                                                    <td><?php echo $stock_item['Symbol']; ?></td>
                                                    <td class="formatted"><?php echo intval($stock_item['Volume_All']); ?></td>
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
                                    <div class="warehouse">
                                        <h4 class="theme-color">我的债券<small>(行情每8s刷新)</small></h4>
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <thead>
                                                <tr>
                                                    <th>代码</th>
                                                    <th>简称</th>
                                                    <th>持仓</th>
                                                    <th>可卖</th>
                                                    <th>买入成本</th>
                                                    <th>全价</th>
                                                    <th>距付息日</th>
                                                    <th>到期时间</th>
                                                    <th>现价</th>
                                                    <th>浮动盈亏</th>
                                                    <th>盈亏率</th>
                                                    <th>涨跌幅</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php foreach ($user_bonds as $stock_item): ?>
                                                    <tr id="<?php echo $stock_item['SecurityID']; ?>" data-interest="<?php echo $stock_item['interest']; ?>">
                                                        <td><?php echo $stock_item['SecurityID']; ?></td>
                                                        <td><?php echo $stock_item['Symbol']; ?></td>
                                                        <td class="formatted"><?php echo intval($stock_item['Volume_All']); ?></td>
                                                        <td class="formatted"><?php echo intval($stock_item['Volume_All']) - intval($stock_item['Ban_Volume']) - intval($stock_item['Order_Volume']); ?></td>
                                                        <td><?php echo number_format(floatval($stock_item['BuyCost']), 2); ?></td>
                                                        <td id="completed_cost"></td>
                                                        <td><?php echo intval($stock_item['day_left']); ?></td>
                                                        <td><?php echo $stock_item['profit_end']; ?></td>
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
    </div>
</div>
<?php $this->load->view('./templates/go-top'); ?>
<?php $this->load->view('./templates/footer'); ?>
<div class="modal fade" id="graphModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title" id="graph_modal_title"></h3>
            </div>
            <div class="modal-body" id="graph_modal_body"></div>
        </div>
    </div>
</div>
</body>
<script>
    /**
     * 格式化显示数据
     * 给数字渲染颜色
     */
    $(document).ready(function () {
        $('.main_jumptron').css('margin-bottom', '0px');
        $('.formatted').each(function () {
            var value = format_num($(this).html());
            $(this).html(value);
        });
        $('.render').each(function () {
            var value = $(this).html().indexOf('-');
            if (value == -1) {
                $(this).css('color', 'red');
            } else {
                $(this).css('color', 'green');
            }
        });
    });

    /**
     * 全局变量
     * interval - setInterval返回的ID值
     * 局部变量
     * base_funds - 初始资金
     * cash_all - 总现金
     * stock_info - 存有持仓股票信息的数组
     * bond_info - 存有持仓债券信息的数组
     * stock_value - 股票市值
     * bond_value - 债券市值
     * asset_all - 总资产（总现金+股票市值+债券市值）
     * position - 仓位 （（股票市值+债券市值）/ 总资产）
     * fpl_value - 浮动盈亏金额
     * fpl_rate - 获浮动盈亏率
     * tpl_value - 总盈亏金额
     * tpl_rate - 总盈亏率
     * 单支证券变量
     * key - 证券代码
     * tr_id - 行ID
     * trade_price - 当前价
     * id_extent - 涨跌幅
     */
    var interval;
    $(document).ready(function () {
        load_dynamic_data();
        clearInterval(interval);
        interval = setInterval(load_dynamic_data, 8000);
        function load_dynamic_data() {
            $.ajax({
                url: '<?php echo base_url("index.php/stock/get_dynamic_info/web"); ?>',
                method: 'get',
                dataType: 'json',
                success: function (response) {
                    var base_funds = parseFloat('<?php echo $base_funds;?>');
                    var cash_all = parseFloat('<?php echo $user_data['cash_all']; ?>');
                    var stock_info = response.stock_info;
                    var bond_info = response.bond_info;
                    var stock_value = parseFloat(response.stock_value);
                    var bond_value = parseFloat(response.bond_value);
                    var asset_all = parseFloat(cash_all + stock_value + bond_value);
                    var position = parseFloat(stock_value + bond_value) * 100 / asset_all;
                    var fpl_value = parseFloat(response.pl_value);
                    var fpl_rate = parseFloat(response.pl_rate);
                    var tpl_value = asset_all - base_funds;
                    var tpl_rate = decimal((tpl_value * 100) / base_funds);
                    var key,tr_id,trade_price,id_extent;

                    $('#stock_value').html(format_num(stock_value));
                    $('#bond_value').html(format_num(bond_value));
                    $('#my_asset').html(format_num(asset_all));
                    $('#my_position').html(format_num(position) + '%');
                    $('#pl_value').html(format_num(tpl_value)).css('color', (parseFloat(tpl_value) > 0) ? 'red' : 'green');
                    $('#pl_rate').html(tpl_rate + '%').css('color', (parseFloat(tpl_rate) > 0) ? 'red' : 'green');
                    $('#fd_value').html(format_num(fpl_value)).css('color', (parseFloat(fpl_value) > 0) ? 'red' : 'green');
                    $('#fd_rate').html(fpl_rate).css('color', (parseFloat(fpl_rate) > 0) ? 'red' : 'green');

                    for (key in stock_info) {
                        tr_id = '#' + key;
                        if (stock_info[key].length == 0) {
                            $(tr_id).children('td:gt(4)').each(function () {
                                $(this).html('--');
                            });
                        } else {
                            trade_price = decimal(stock_info[key]['TradePrice']);
                            id_extent = decimal(parseFloat(stock_info[key]['id_extent']) * 100);
                            $(tr_id).children('td:eq(5)').html(trade_price);
                            $(tr_id).children('td:eq(6)').html(format_num(decimal(stock_info[key]['float_pl']))).css('color', (parseFloat(stock_info[key]['float_pl']) > 0) ? 'red' : 'green');  //设置浮动盈亏
                            $(tr_id).children('td:eq(7)').html(format_num(stock_info[key]['float_pl_rate']) + '%').css('color', (parseFloat(stock_info[key]['float_pl_rate']) > 0) ? 'red' : 'green');   //设置盈亏比
                            $(tr_id).children('td:eq(8)').html(id_extent + '%').css('color', (parseFloat(id_extent) > 0) ? 'red' : 'green');
                        }
                    }
                    for (key in bond_info) {
                        tr_id = '#' + key;
                        if (bond_info[key].length == 0) {
                            $(tr_id).children('td:gt(7)').each(function () {
                                $(this).html('--');
                            });
                        } else {
                            trade_price = decimal(bond_info[key]['TradePrice']);  //获取当前价，保留小数点后两位
                            id_extent = decimal(parseFloat(bond_info[key]['id_extent']) * 100);  //获取涨跌幅，保留小数点后两位

                            $(tr_id).children('td:eq(8)').html(trade_price);  //设置当前价
                            $(tr_id).children('td:eq(9)').html(format_num(decimal(bond_info[key]['float_pl']))).css('color', (parseFloat(bond_info[key]['float_pl']) > 0) ? 'red' : 'green');   //设置浮动盈亏
                            $(tr_id).children('td:eq(10)').html(format_num(bond_info[key]['float_pl_rate']) + '%').css('color', (parseFloat(bond_info[key]['float_pl_rate']) > 0) ? 'red' : 'green');   //设置盈亏比
                            $(tr_id).children('td:eq(11)').html(id_extent + '%').css('color', (parseFloat(id_extent) > 0) ? 'red' : 'green');  //设置涨跌幅
                            $('#completed_cost').html(format_num(parseFloat($(tr_id).data('interest')) + parseFloat(trade_price)));  //设置全价
                        }
                    }
                    //绘制资金分布饼图
                    var parts = ['可用现金', '债券市值', '股票市值', '冻结资金'];
                    var cash_use = decimal(parseFloat("<?php echo $user_data['cash_use'];?>"));
                    var cash_freeze = decimal(parseFloat("<?php echo $user_data['cash_freeze'];?>"));
                    var parts_value = [
                        {value: cash_use, name: '可用现金'},
                        {value: bond_value, name: '债券市值'},
                        {value: stock_value, name: '股票市值'},
                        {value: cash_freeze, name: '冻结资金'}
                    ];
                    var pie_div_id = document.getElementById('pie_canvas');
                    draw_pie(parts, parts_value, pie_div_id); //绘制资金使用情况饼图
                }
            });
        }
    });

    /**
     * 用新浪接口获取分时图
     * stock_id - 股票代码
     * stock_name - 股票名称
     */
    function fillimage(stock_id, stock_name) {
        var modal_body = document.getElementById("graph_modal_body");
        var modal_title = document.getElementById("graph_modal_title");
        var start_code = stock_id.toString().substr(0, 2);
        console.log(start_code);
        if (start_code == '30' || start_code == '00') {
            stock_id = 'sz' + stock_id;
        } else if (start_code == '60') {
            stock_id = 'sh' + stock_id;
        } else {
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