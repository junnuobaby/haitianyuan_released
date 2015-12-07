<!--模拟炒股，操作记录-->
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="zh-cn">
<?php $this->load->view('./templates/head'); ?>
<?php
/**
 * done_records - dict - 获取操作记录
 * pages - 分页
 */
$done_records = $his_list['data_page'];
$pages = $his_list['pagination'];
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
                            <h4 class="theme-color container_to_top">交易记录</h4>
                            <div class="panel panel-default border_none">
                                <div class="panel-body">
                                    <table class="table table-striped table-bordered table-hover">
                                        <thead>
                                        <tr>
                                            <th>时间</th>
                                            <th>代码</th>
                                            <th>名称</th>
                                            <th>操作</th>
                                            <th>价格</th>
                                            <th>数量</th>
<!--                                            <th>挂单全价</th>-->
                                            <th>金额</th>
<!--                                            <th>手续费</th>-->
<!--                                            <th>印花税</th>-->
<!--                                            <th>其他杂费</th>-->
<!--                                            <th>发生金额</th>-->
<!--                                            <th>现金余额</th>-->
                                            <th>备注</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($done_records as $stock_item): ?>
                                            <tr class="<?php if($stock_item['trade_type'] == '0') {
                                                echo 'danger';
                                            } else if($stock_item['trade_type'] == '2') {
                                                echo "info";
                                            } else if($stock_item['trade_type'] == '4') {
                                                echo "warning";
                                            }
                                            ?>">
                                                <td><?php echo $stock_item['timestamp']; ?></td>
                                                <td><?php echo $stock_item['SecurityID']; ?></td>
                                                <td><?php echo $stock_item['Symbol']; ?></td>
                                                <td><?php if($stock_item['trade_type'] == '0') {
                                                        echo '买入';
                                                    } else if($stock_item['trade_type'] == '2') {
                                                        echo "卖出";
                                                    } else if($stock_item['trade_type'] == '4') {
                                                        echo "撤单";
                                                    }else if($stock_item['trade_type'] == '6') {
                                                        echo "自动撤单";
                                                    }
                                                    ?></td>
                                            <td class="formatted decimal"><?php echo $stock_item['price_order'];?></td>
                                            <td class="formatted"><?php echo $stock_item['Volume']; ?></td>
<!--                                                <td class="formatted">--><?php //echo $stock_item['price_full'];?><!--</td>-->
                                                <td class="formatted"><?php echo $stock_item['fund_deal'];?></td>
<!--                                                <td class="formatted">--><?php //echo $stock_item['fee'];?><!--</td>-->
<!--                                                <td class="formatted">--><?php //echo $stock_item['tax'];?><!--</td>-->
<!--                                                <td class="formatted">--><?php //echo $stock_item['other_fee'];?><!--</td>-->
<!--                                                <td class="formatted">--><?php //echo $stock_item['hap_fund'];?><!--</td>-->
<!--                                                <td class="formatted">--><?php //echo $stock_item['remain_fund'];?><!--</td>-->
                                                <td><?php echo $stock_item['tip'];?></td>
                                            </tr><?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="text-center"><p class="pages"><?php echo $pages; ?></p></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--悬停go-top按钮-->
    <?php $this->load->view('./templates/go-top'); ?>
    <?php $this->load->view('./templates/footer'); ?>
</div>
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