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
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td><?php echo $user_data['cash_all'];?></td>
                                                <td><?php echo $user_data['cash_use'];?></td>
                                                <td id="stock_value"></td>
                                                <td><?php echo $user_data['position'];?></td>
                                                <td><?php echo $user_data['cash_freeze'];?></td>
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
                                            <td>0.00%</td>
                                            <td>未有排名</td>
                                        </tr>
                                        <tr>
                                            <td>本月收益率</td>
                                            <td>0.00%</td>
                                            <td>未有排名</td>
                                        </tr>
                                        <tr>
                                            <td>本周收益率</td>
                                            <td>0.00%</td>
                                            <td>未有排名</td>
                                        </tr>
                                        <tr>
                                            <td>平均周收益率</td>
                                            <td>0.00%</td>
                                            <td>未有排名</td>
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
                                                <th>总股数</th>
                                                <th>可卖数量</th>
                                                <th>买入成本</th>
                                                <th>当前价</th>
                                                <th>浮动盈亏</th>
                                                <th>涨跌幅</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php foreach ($user_stocks as $stock_item): ?>
                                            <tr>
                                                <td><?php echo $stock_item['SecurityID'];?></td>
                                                <td><?php echo $stock_item['SecurityID'];?></td>
                                                <td><?php echo $stock_item['Volume_All'];?></td>
                                                <td><?php echo intval($stock_item['Volume_All']) - intval($stock_item['Ban_Volume']);?></td>
                                                <td><?php echo $stock_item['BuyCost'];?></td>
                                                <td id="trade_price"></td>
                                                <td id="float_pl"></td>
                                                <td id="extent"></td>
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
    $(document).ready(function () {
        $('.main_jumptron').css('margin-bottom', '0px');
    });
    $(document).ready(function () {
        var xhr;
        if (xhr) {
            xhr.abort();
        }
        xhr = $.ajax({
                url: '<?php echo base_url("index.php/stock/get_dynamic_info/web"); ?>',
                method: 'get',
                dataType: 'json',
                success: function (response) {
                    $
                }
            }
        );
    })
</script>
</html>