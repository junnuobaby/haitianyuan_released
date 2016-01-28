<!--模拟炒股，已成交的订单-->
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="zh-cn">
<?php $this->load->view('./templates/head', array('title' => '已成交')); ?>
<?php
/**
 * done_records - dict - 获取已成交记录
 * pages - 分页
 */
$done_records = $done_list['data_page'];
$pages = $done_list['pagination'];
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
                                <h4 class="theme-color container_to_top">成交记录</h4>
                                <div class="panel panel-default border_none">
                                    <div class="panel-body">
                                        <table class="table table-responsive table-hover table-bordered">
                                            <thead>
                                            <tr>
                                                <th>成交时间</th>
                                                <th>代码</th>
                                                <th>名称</th>
                                                <th>操作</th>
                                                <th>委托价</th>
                                                <th>成交价</th>
                                                <th>成交量</th>
                                                <th>手续费</th>
                                                <th>印花税</th>
                                                <th>详细</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php $count_num = 0; ?>
                                            <?php foreach ($done_records as $stock_item): ?>
                                                <tr>
                                                    <td><?php echo $stock_item['timestamp']; ?></td>
                                                    <td data-toggle="modal" data-target="#graphModal" onclick="fillimage('<?= $stock_item['SecurityID']; ?>', '<?= $stock_item['Symbol']; ?>')"><a href="#" class="theme-color"><?php echo $stock_item['SecurityID']; ?></a></td>
                                                    <td><?php echo $stock_item['Symbol']; ?></td>
                                                    <td><?php if ($stock_item['trade_type'] == '1') {echo '买入';} else if ($stock_item['trade_type'] == '3') {echo "卖出";} else if($stock_item['trade_type'] == '3'){echo '债券付息';}?></td>
                                                    <td class="formatted"><?php echo $stock_item['price_order']; ?></td>
                                                    <td class="formatted decimal"><?php echo $stock_item['price_deal']; ?></td>
                                                    <td class="formatted"><?php echo $stock_item['Volume']; ?></td>
                                                    <td class="formatted"><?php echo $stock_item['fee'];?></td>
                                                    <td class="formatted"><?php echo $stock_item['tax'];?></td>
                                                    <td data-index="<?php echo $count_num; ?>" class="order_detail"><a href="#" class="theme-color">查看</a></td>
                                                </tr>
                                                <?php $count_num++; ?>
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
<!--显示每天成交记录详情的模态框-->
<div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4>订单详情</h4>
            </div>
            <div id="detail_modal_cnt"></div>
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

    //填充每条委托单的详情
    var detail_lists = [];
    <?php
    $count = 0;
    foreach($done_records as $stock_item) {
        echo "var detail_list = new Object();\n";
        foreach($stock_item as $key => $value) {
            echo "detail_list['" . $key . "'] = '" . $value . "'\n";
        }
        echo "detail_lists[" . $count . "] = detail_list;\n";
        $count += 1;
    }
    ?>

    $('.order_detail').bind('click', function fill_order_detail(){
        var index = $(this).data('index');
        var detail_content = '<table class="table table-bordered table-responsive">';
        detail_content += '<tr><th>成交日期</th><td>' + detail_lists[index]['timestamp'] + '</td></tr>';
        detail_content += '<tr><th>操作</th><td>' + (detail_lists[index]['trade_type'] == 1 ? "买入" : "卖出") + '</td></tr>';
        detail_content += '<tr><th>代码</th><td>' + detail_lists[index]['SecurityID'] + '</td></tr>';
        detail_content += '<tr><th>名称</th><td>' + detail_lists[index]['Symbol'] + '</td></tr>';
        detail_content += '<tr><th>委托价</th><td>' + format_num(detail_lists[index]['price_order']) + '</td></tr>';
        detail_content += '<tr><th>成交价</th><td>' + format_num(detail_lists[index]['price_deal']) + '</td></tr>';
        detail_content += '<tr><th>成交全价</th><td>' + format_num(detail_lists[index]['price_full']) + '</td></tr>';
        detail_content += '<tr><th>成交量</th><td>' + format_num(detail_lists[index]['Volume']) + '</td></tr>';
        detail_content += '<tr><th>成交金额</th><td>' + format_num(detail_lists[index]['fund_deal']) + '</td></tr>';
        detail_content += '<tr><th>手续费</th><td>' + format_num(detail_lists[index]['fee']) + '</td></tr>';
        detail_content += '<tr><th>印花税</th><td>' + format_num(detail_lists[index]['tax']) + '</td></tr>';
        detail_content += '<tr><th>其他杂费</th><td>' + format_num(detail_lists[index]['other_fee']) + '</td></tr>';
        detail_content += '<tr><th>发生金额</th><td>' + format_num(detail_lists[index]['hap_fund']) + '</td></tr>';
        detail_content += '<tr><th>现金余额</th><td>' + format_num(detail_lists[index]['remain_fund']) + '</td></tr>';
        detail_content += '<tr><th>备注</th><td>' + detail_lists[index]['tip'] + '</td></tr>';
        $('#detail_modal_cnt').html(detail_content);
        $('#detailModal').modal('show');
    });

</script>
</html>