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
                                <div>
                                    <h4 class="blue-color margin_to_top">我的资金</h4>
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                            <tr>
                                                <th>总现金</th>
                                                <th>可用现金</th>
                                                <th>股票市值</th>
                                                <th>仓位（%）</th>
                                                <th>冻结金额</th>
                                                <th>总盈亏</th>
                                                <th>总盈亏比</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td><?php echo $user_data['cash_all'];?></td>
                                                <td><?php echo $user_data['cash_use'];?></td>
                                                <td id="stock_value"></td>
                                                <td><?php echo floatval($user_data['position'])*100;?></td>
                                                <td><?php echo $user_data['cash_freeze'];?></td>
                                                <td id="pl_value"></td>
                                                <td id="pl_rate"></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div>
                                    <h4 class="blue-color margin_to_top">我的收益</h4>
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th>周期</th>
                                            <th>收益率</th>
                                            <th>排名</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>总收益率</td>
                                            <td><?php echo number_format(floatval($user_data['profit_rate']) * 100, 2);?>%</td>
                                            <td><?php echo $user_data['profit_rank']?></td>
                                        </tr>
                                        <tr>
                                            <td>本月收益率</td>
                                            <td><?php echo number_format(floatval($user_data['month_rate']) * 100, 2);?>%</td>
                                            <td><?php echo $user_data['month_rank']?></td>
                                        </tr>
                                        <tr>
                                            <td>本周收益率</td>
                                            <td><?php echo number_format(floatval($user_data['week_rate']) * 100, 2);?>%</td>
                                            <td><?php echo $user_data['week_rank'];?></td>
                                        </tr>
                                        <tr>
                                            <td>本日收益率</td>
                                            <td><?php echo number_format(floatval($user_data['day_rate']) * 100, 2);?>%</td>
                                            <td><?php echo $user_data['day_rank'];?></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div>
                                    <h4 class="blue-color margin_to_top ">我的持仓</h4>
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
                                                <th>盈亏比</th>
                                                <th>今日涨跌幅</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php foreach ($user_stocks as $stock_item): ?>
                                            <tr id="<?php echo $stock_item['SecurityID'];?>">
                                                <td><?php echo $stock_item['SecurityID'];?></td>
                                                <td><?php echo $stock_item['Symbol'];?></td>
                                                <td><?php echo $stock_item['Volume_All'];?></td>
                                                <td><?php echo intval($stock_item['Volume_All']) - intval($stock_item['Ban_Volume']) - intval($stock_item['Order_Volume']);?></td>
                                                <td><?php echo number_format(floatval($stock_item['BuyCost']), 2);?></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <?php endforeach;?>
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
</body>
<script>
    var interval;
    $(document).ready(function () {
        $('.main_jumptron').css('margin-bottom', '0px');
    });
    $(document).ready(function () {
        load_dynamic_data();
        clearInterval(interval);
        interval = setInterval(load_dynamic_data, 8000); //每隔8s自动请求一次
        //请求动态加载数据
        function load_dynamic_data(){
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
                        $('#stock_value').html(response.stock_value).css('color','red');  //获取并设置股票市值
                        var pl_value = $('#pl_value');
                        var pl_rate = $('#pl_rate');
                        if(parseFloat(response.pl_value) > 0){
                            pl_value.css('color','red');
                        }else{
                            pl_value.css('color','green');
                        }
                        if(parseFloat(response.pl_rate) > 0){
                            pl_rate.css('color','red');
                        }else{
                            pl_rate.css('color','green');
                        }
                        pl_value.html(response.pl_value); //获取并设置总盈亏金额
                        pl_rate.html(response.pl_rate); //获取并设置总盈亏比
                        var stock_info = response.stock_info;
                        for(key in stock_info){
                            var tr_id = '#' + key;
                            if(stock_info[key].length == 0){
                                $(tr_id).children('td:eq(5)').html('--');  //设置当前价
                                $(tr_id).children('td:eq(6)').html('--');   //设置浮动盈亏
                                $(tr_id).children('td:eq(7)').html('--');   //设置盈亏比
                                $(tr_id).children('td:eq(8)').html('--');  //设置涨跌幅
                            }else{
                                var trade_price = parseFloat(stock_info[key]['TradePrice']).toFixed(2);  //获取当前价，保留小数点后两位
                                var id_extent = (parseFloat(stock_info[key]['id_extent'])*100).toFixed(2);  //获取涨跌幅，保留小数点后两位
                                if(parseFloat(stock_info[key]['float_pl']) < 0){
                                    $(tr_id).children('td:eq(6)').css('color','green');
                                }else if(parseFloat(stock_info[key]['float_pl']) >= 0){
                                    $(tr_id).children('td:eq(6)').css('color','red');
                                }
                                if(parseFloat(stock_info[key]['float_pl_rate']) < 0){
                                    $(tr_id).children('td:eq(7)').css('color','green');
                                }else if(parseFloat(stock_info[key]['float_pl_rate']) >= 0){
                                    $(tr_id).children('td:eq(7)').css('color','red');
                                }
                                if(id_extent < 0){
                                    $(tr_id).children('td:eq(8)').css('color','green');
                                }else if(id_extent >= 0){
                                    $(tr_id).children('td:eq(8)').css('color','red');
                                }
                                $(tr_id).children('td:eq(5)').html(trade_price);  //设置当前价
                                $(tr_id).children('td:eq(6)').html(parseFloat(stock_info[key]['float_pl']).toFixed(2));   //设置浮动盈亏
                                $(tr_id).children('td:eq(7)').html(parseFloat(stock_info[key]['float_pl_rate'] ).toFixed(2) + '%');   //设置盈亏比
                                $(tr_id).children('td:eq(8)').html(id_extent + '%');  //设置涨跌幅
                            }
                        }
                    }
                });
        }

    })
</script>
</html>