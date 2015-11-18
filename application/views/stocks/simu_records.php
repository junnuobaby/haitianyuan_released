<!--模拟炒股，已成交的订单-->
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="zh-cn">
<?php $this->load->view('./templates/head'); ?>
<?php
$done_records = $his_list['data_page'];  //获取已成交记录
$pages = $his_list['pagination']; //获取分页
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
                            <h4 class="blue-color margin_to_top">交易记录</h4>

                            <div class="panel panel-default border_none">
                                <div class="panel-body">
                                    <table class="table table-striped table-bordered table-hover table-condensed">
                                        <thead>
                                        <tr>
                                            <th>时间</th>
                                            <th>证券代码</th>
                                            <th>证券名称</th>
                                            <th>委托</th>
                                            <th>数量</th>
                                            <th>价格</th>
                                            <th>金额</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($done_records as $stock_item): ?>
                                            <tr class="<?php if ($stock_item['trade_type'] == '0') {
                                                echo 'danger';
                                            } else if ($stock_item['trade_type'] == '2') {
                                                echo "info";
                                            } else if ($stock_item['trade_type'] == '4') {
                                                echo "warning";
                                            }
                                            ?>">
                                                <td><?php echo $stock_item['timestamp']; ?></td>
                                                <td><?php echo $stock_item['SecurityID']; ?></td>
                                                <td><?php echo $stock_item['Symbol']; ?></td>
                                                <td><?php if ($stock_item['trade_type'] == '0') {
                                                        echo '买入';
                                                    } else if ($stock_item['trade_type'] == '2') {
                                                        echo "卖出";
                                                    } else if ($stock_item['trade_type'] == '4') {
                                                        echo "撤销";
                                                    }
                                                    ?></td>
                                                <td class="formatted table_right"><?php echo $stock_item['Volume']; ?></td>
                                                <td class="formatted decimal  table_right"><?php if ($stock_item['trade_type'] == '4') {
                                                        echo $stock_item['price_order'];
                                                    } else {
                                                        echo $stock_item['Price'];
                                                    } ?></td>
                                                <td class="formatted table_right"><?php if ($stock_item['trade_type'] == '4') {
                                                        echo $stock_item['price_order'] * $stock_item['Volume'];
                                                    } else {
                                                        echo $stock_item['Price'] * $stock_item['Volume'];
                                                    } ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="txt_center"><p class="pages"><?php echo $pages; ?></p></div>
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
        $('.formatted').each(function () {
            var value = format_num($(this).html());
            $(this).html(value);
        });
        $('.decimal').each(function () {
            var value = decimal($(this).html());
            $(this).html(value);
        });
    });
</script>
</html>