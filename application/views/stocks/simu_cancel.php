<!--模拟炒股，委托单-->
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="zh-cn">
<?php $this->load->view('./templates/head'); ?>
<?php
$records = $pre_list['data_page']; //获取还在委托状态的订单详情
$pages = $pre_list['pagination']; //获取分页
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
                            <h4 class="theme-color container_to_top">今日委托单</h4>

                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <table class="table  table-responsive table-hover">
                                        <thead>
                                        <tr>
                                            <th>时间</th>
                                            <th>证券代码</th>
                                            <th>证券名称</th>
                                            <th>委托方向</th>
                                            <th>数量（股）</th>
                                            <th>委托价格</th>
                                            <th>委托金额</th>
                                            <th>预收费用</th>
                                            <th>动作</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($records as $stock_item): ?>
                                            <tr class="done_record">
                                                <!--时间-->
                                                <td><?php echo $stock_item['timestamp']; ?></td>
                                                <!--证券代码-->
                                                <td data-toggle="modal" data-target="#graphModal"
                                                    onclick="fillimage('<?= $stock_item['SecurityID']; ?>', '<?= $stock_item['Symbol']; ?>')">
                                                    <a href="#"
                                                       class="hty_a"><?php echo $stock_item['SecurityID']; ?></a></td>
                                                <!--证券名称-->
                                                <td><?php echo $stock_item['Symbol']; ?></td>
                                                <!--委托方向-->
                                                <td><?php if ($stock_item['trade_type'] == '0') {
                                                        echo '买入';
                                                    } else {
                                                        echo "卖出";
                                                    } ?></td>
                                                <!--委托数量-->
                                                <td class="formatted"><?php echo $stock_item['Volume']; ?></td>
                                                <!--委托价格-->
                                                <td class="formatted"><?php echo $stock_item['Price']; ?></td>
                                                <!--委托金额-->
                                                <td class="formatted"><?php echo $stock_item['Price'] * $stock_item['Volume']; ?></td>
                                                <!--预收交易费用（不超过1万统一收5元，超过10000按万三标准收取）-->
                                                <td class="formatted"><?php
                                                    if ($stock_item['trade_type'] == '0') {
                                                        $trade_money = floatval($stock_item['Price'] * $stock_item['Volume']) * 0.0003;
                                                    } else {
                                                        $trade_money = floatval($stock_item['Price'] * $stock_item['Volume']) * 0.0013;
                                                    }
                                                    if ($trade_money > 5) {
                                                        echo number_format($trade_money, 2);
                                                    } else {
                                                        echo '5.00';
                                                    }
                                                    ?></td>
                                                <td><a href="#" class="theme-color cancel_btn"
                                                       data-id="<?php echo $stock_item['pre_id']; ?>">撤单</a></td>
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
        $('.main_jumptron').css('margin-bottom', '0');
        $('.formatted').each(function () {
            var value = format_num($(this).html());
            $(this).html(value);
        });
    });
    $(document).ready(function () {
        $('a.cancel_btn').click(function () {
            var record_id = $(this).data('id');
            var record_tr = $(this).parents('tr.done_record');
            if (confirm('确定撤销该订单？')) {
                $.ajax({
                    url: '<?php echo base_url("index.php/stock/cancel_order/web"); ?>' + '/' + record_id,
                    method: 'get',
                    dataType: 'json',
                    success: function (response) {
                        if (response.status == '0') {
                            record_tr.fadeOut('slow');
                        }
                        else if (response.status == '1') {
                            alert(response.msg);
                        }
                    }
                });
            }

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