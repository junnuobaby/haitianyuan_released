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
                            <div class="panel panel-default border_none" >
                                <div class="panel-body">
                                    <table class="table table-striped table-bordered table-hover table-condensed">
                                        <thead>
                                        <tr>
                                            <th>时间</th>
                                            <th>证券代码</th>
                                            <th>证券名称</th>
                                            <th>委托方向</th>
                                            <th>委托数量</th>
                                            <th>委托价格</th>
                                            <th>委托金额</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($done_records as $stock_item): ?>
                                            <tr class="<?php if ($stock_item['trade_type'] == '0') {
                                                echo 'warning';
                                            } else if ($stock_item['trade_type'] == '1') {
                                                echo "danger";
                                            }else if ($stock_item['trade_type'] == '2') {
                                                echo "info";
                                            }else if ($stock_item['trade_type'] == '3') {
                                                echo "success";
                                            }else if ($stock_item['trade_type'] == '4') {
                                                echo "active";
                                            }
                                            ?>">
                                                <td><?php echo $stock_item['timestamp']; ?></td>
                                                <td><?php echo $stock_item['SecurityID']; ?></td>
                                                <td><?php echo $stock_item['Symbol']; ?></td>
                                                <td><?php if ($stock_item['trade_type'] == '0') {
                                                        echo '预买';
                                                    } else if ($stock_item['trade_type'] == '1') {
                                                        echo "买入";
                                                    }else if ($stock_item['trade_type'] == '2') {
                                                        echo "预卖";
                                                    }else if ($stock_item['trade_type'] == '3') {
                                                        echo "卖出";
                                                    }else if ($stock_item['trade_type'] == '4') {
                                                        echo "撤销";
                                                    }
                                                    ?></td>
                                                <td><?php echo $stock_item['Volume']; ?></td>
                                                <td><?php echo $stock_item['Price']; ?></td>
                                                <td><?php echo $stock_item['Price'] * $stock_item['Volume']; ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="txt_center"><p class="pages"><?php echo $pages; ?></p></div>
                        </div>
                        <ol class="ht_indent">
                            <li>目前可买卖股票和债券。</li>
                            <li>交易时间与沪深A股的开市时间一致。一般为周一至周五，上午09:30至11:30，下午13:00至15:00。</li>
                            <li>交易价格按照实盘价格成交，目前支持全部沪深A股，包括创业板。</li>
                            <li>所有买卖均实行T+1制度，即当天买入的股票只能在第二个交易日卖出。</li>
                            <li>买入时，不收取印花税，收取交易金额的千分之一的手续费，手续费不足5元按5元收取。</li>
                            <li>卖出时，收取交易金额千分之一的印花税，收取交易金额千分之一的手续费，手续费不足5元按5元收取。</li>
                            <li>买卖交易的股票数量不受实盘的买卖委托数量的限制。</li>
                            <li>股票价格到了涨跌停板后不再成交，直到停板被打开；</li>
                            <li>不能买入已经涨停的股票，不能卖出已经跌停的股票。</li>
                        </ol>
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