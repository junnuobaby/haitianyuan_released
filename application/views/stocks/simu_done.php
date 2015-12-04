<!--模拟炒股，已成交的订单-->
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="zh-cn">
<?php $this->load->view('./templates/head'); ?>
<?php
$done_records = $done_list['data_page'];  //获取已成交记录
$pages = $done_list['pagination']; //获取分页
?>
<body class="bg-gray">
<div class="wrapper">
    <?php $this->load->view('./stocks/bonds_navbar'); ?>
    <div class="container">
        <div class="row">
            <?php $this->load->view('./stocks/simu_menu'); ?>
        </div>
        <div class="row">
                <div class="bg-white stocks_min_h  block-radius">
                    <div class="simulate_panel">
                        <div class="tab-content">
                            <h4 class="theme-color container_to_top">成交记录</h4>

                            <div class="panel panel-default border_none">
                                <div class="panel-body">
                                    <table class="table table-responsive table-hover table-bordered">
                                        <thead>
                                        <tr>
                                            <th>成交时间</th>
                                            <th>证券代码</th>
                                            <th>证券名称</th>
                                            <th>委托方向</th>
                                            <th>成交量(股)</th>
                                            <th>成交价格</th>
                                            <th>成交金额</th>
                                            <th>成交全价</th>
                                            <th>手续费</th>
                                            <th>印花税</th>
                                            <th>其他杂费</th>
                                            <th>发生金额</th>
                                            <th>现金余额</th>
                                            <th>备注</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($done_records as $stock_item): ?>
                                            <tr>
                                                <td><?php echo $stock_item['timestamp']; ?></td>
                                                <td data-toggle="modal" data-target="#graphModal" onclick="fillimage('<?= $stock_item['SecurityID']; ?>', '<?= $stock_item['Symbol']; ?>')"><a href="#" class="hty_a"><?php echo $stock_item['SecurityID']; ?></a></td>
                                                <td><?php echo $stock_item['Symbol']; ?></td>
                                                <td><?php if ($stock_item['trade_type'] == '1') {echo '买入';} else if ($stock_item['trade_type'] == '3') {echo "卖出";} else if($stock_item['trade_type'] == '3'){echo '债券付息';}?></td>
                                                <td class="formatted"><?php echo $stock_item['Volume']; ?></td>
                                                <td class="formatted decimal"><?php echo $stock_item['price_deal']; ?></td>
                                                <td class="formatted"><?php echo $stock_item['fund_deal']; ?></td>
                                                <td class="formatted"><?php echo $stock_item['price_full']; ?></td>
                                                <td class="formatted decimal"><?php echo $stock_item['fee'];?></td>
                                                <td class="formatted decimal"><?php echo $stock_item['tax'];?></td>
                                                <td class="formatted decimal"><?php echo $stock_item['other_fee'];?></td>
                                                <td class="formatted decimal"><?php echo $stock_item['hap_fund'];?></td>
                                                <td class="formatted decimal"><?php echo $stock_item['remain_fund'];?></td>
                                                <td class="formatted decimal"><?php echo $stock_item['tip'];?></td>
                                            </tr>
                                        <?php endforeach; ?>
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