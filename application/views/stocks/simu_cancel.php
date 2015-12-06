<!--模拟炒股，委托单-->
<?phpdefined('BASEPATH') OR exit('No direct script access allowed');?>
<!DOCTYPE html>
<html lang="zh-cn">
<?php
/**
 * records - dict - 还在委托状态的订单详情
 *           key:
 *              pre_id - 订单编号
 *              trade_type - 操作（0 - 买入 2- 卖出）
 *              SecurityID - 代码
 *              Symbol - 名称
 *              Volume - 挂单数量
 *              price_order - 挂单价格
 *              price_full - 挂单全价
 *              fund_deal - 挂单金额
 *              fee - 手续费
 *              tax - 印花税
 *              other_fee - 其他杂费
 *              hap_fund - 发送金额
 *              remain_fund - 现金余额
 *              timestamp - 下单时间
 *              tip - 备注
 */
$records = $pre_list['data_page']; //获取还在委托状态的订单详情
$pages = $pre_list['pagination']; //获取分页
?>
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
                <div class="bg-white stocks_min_h  block-radius">
                    <div class="simulate_panel">
                        <div class="tab-content">
                            <h4 class="theme-color container_to_top">委托单</h4>
                            <div class="panel panel-default border_none">
                                <div class="panel-body">
                                    <table class="table table-bordered table-hover table-striped ">
                                        <thead>
                                        <tr>
    <!--                                        <th>编号</th>-->
                                            <th>代码</th>
                                            <th>名称</th>
                                            <th>操作</th>
                                            <th>委托数量</th>
                                            <th>委托价格</th>
<!--                                            <th>挂单全价</th>-->
                                            <th>金额</th>
<!--                                            <th>手续费</th>-->
<!--                                            <th>印花税</th>-->
<!--                                            <th>其他杂费</th>-->
<!--                                            <th>发生金额</th>-->
<!--                                            <th>现金余额</th>-->
                                            <th>委托时间</th>
                                            <th>备注</th>
                                            <th>详情</th>
<!--                                            <th>撤单</th>-->
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($records as $stock_item): ?>
                                            <tr class="done_record">
    <!--                                            <td>--><?php //echo $stock_item['pre_id']; ?><!--</td>-->

                                                <td data-toggle="modal" data-target="#graphModal" onclick="fillimage('<?= $stock_item['SecurityID']; ?>', '<?= $stock_item['Symbol']; ?>')">
                                                    <a href="#" class="hty_a"><?php echo $stock_item['SecurityID']; ?></a>
                                                </td>
                                                <td><?php echo $stock_item['Symbol']; ?></td>
                                            <td><?php if($stock_item['trade_type'] == '0') {
                                                    echo '买入';
                                                } else if($stock_item['trade_type'] == '2') {
                                                    echo "卖出";
                                                } ?></td>
                                                <td class="formatted"><?php echo $stock_item['Volume']; ?></td>
                                                <td class="formatted"><?php echo $stock_item['price_order']; ?></td>
<!--                                                <td class="formatted">--><?php //echo $stock_item['price_full']; ?><!--</td>-->
                                                <td class="formatted"><?php echo $stock_item['fund_deal']; ?></td>
<!--                                                <td class="formatted">--><?php //echo $stock_item['fee']; ?><!--</td>-->
<!--                                                <td class="formatted">--><?php //echo $stock_item['tax']; ?><!--</td>-->
<!--                                                <td class="formatted">--><?php //echo $stock_item['other_fee']; ?><!--</td>-->
<!--                                                <td class="formatted">--><?php //echo $stock_item['hap_fund']; ?><!--</td>-->
<!--                                                <td class="formatted">--><?php //echo $stock_item['remain_fund']; ?><!--</td>-->
                                                <td><?php echo $stock_item['timestamp']; ?></td>
                                                <td><a href="#">查看</a></td>
<!--                                                <td>--><?php //echo $stock_item['tip']; ?><!--</td>-->
                                                <td>
                                                    <a href="#" class="theme-color cancel_btn" data-id="<?php echo $stock_item['pre_id']; ?>">撤单</a>
                                                </td>
                                            </tr><?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="text-center"><p class="pages"><?php echo $pages; ?></p></div>
                        </div>
                    </div>
                </div>
            <div>
        </div>
    </div>

    <!--悬停go-top按钮--><?php $this->load->view('./templates/go-top'); ?>
</div><?php $this->load->view('./templates/footer'); ?>
<div class="modal fade" id="graphModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                <h3 class="modal-title" id="graph_modal_title"></h3>
            </div>
            <div class="modal-body" id="graph_modal_body"></div>
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