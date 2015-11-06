<!--模拟炒股，已成交的订单-->
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="zh-cn">
<?php $this->load->view('./templates/head'); ?>
<?php
$done_records = $done_list;  //获取已成交记录
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
                <div class="bg-white stocks_min_h  block-radius">
                    <div class="simulate_panel">
                        <div class="tab-content">
                            <h4 class="blue-color margin_to_top">今日成交</h4>
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th>时间</th>
                                            <th>证券代码</th>
                                            <th>证券名称</th>
                                            <th>委托方向</th>
                                            <th>成交数量</th>
                                            <th>成交价格</th>
                                            <th>成交金额</th>
                                            <th>实际交易费用</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($done_records as $stock_item): ?>
                                        <tr>
                                            <td><?php echo $stock_item['timestamp'];?></td>
                                            <td><?php echo $stock_item['SecurityID'];?></td>
                                            <td><?php echo $stock_item['Symbol'];?></td>
                                            <td><?php if ($stock_item['trade_type'] == '0') {
                                                    echo '买入';
                                                } else {
                                                    echo "卖出";
                                                } ?></td>
                                            <td><?php echo $stock_item['Volume']; ?></td>
                                            <td><?php echo $stock_item['Price'];?></td>
                                            <td><?php echo $stock_item['Price'] * $stock_item['Volume']; ?></td>
                                            <td><?php
                                                $trade_money = $stock_item['Price'] * $stock_item['Volume'];
                                                if($trade_money >= 10000){
                                                    echo $trade_money * 0.0003;
                                                }else{
                                                    echo '5.00';
                                                }
                                                ?></td>
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

    <!--悬停go-top按钮-->
    <?php $this->load->view('./templates/go-top'); ?>
</div>
<?php $this->load->view('./templates/footer'); ?>
</body>
<script>
    $(document).ready(function () {
        $('.main_jumptron').css('margin-bottom', '0px');
    });
</script>
</html>