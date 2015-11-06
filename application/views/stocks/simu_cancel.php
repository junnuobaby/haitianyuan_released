<!--模拟炒股，撤销委托单-->
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="zh-cn">
<?php $this->load->view('./templates/head'); ?>
<?php
$records = $pre_list['data_page'];
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
                            <h4 class="blue-color margin_to_top">今日委托单</h4>
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                        <th>时间</th>
                                        <th>证券代码</th>
                                        <th>证券名称</th>
                                        <th>委托方向</th>
                                        <th>委托数量</th>
                                        <th>委托价格</th>
                                        <th>委托金额</th>
                                        <th>预收交易费用</th>
                                        <th>状态</th>
                                        <th>动作</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($records as $stock_item): ?>
                                        <tr>
                                            <td><?php echo $stock_item['timestamp']?></td>
                                            <td><?php echo $stock_item['SecurityID']?></td>
                                            <td><?php echo $stock_item['Symbol']?></td>
                                            <td><?php if($stock_item['timestamp'] == '0'):?> 买入
                                                <?php elseif($stock_item['timestamp'] == '1'):?>
                                                卖出
                                                <?php endif;?></td>
                                            <td><?php echo $stock_item['Volume'];?></td>
                                            <td><?php echo $stock_item['Price']?></td>
                                            <td><?php echo $stock_item['Price']* $stock_item['Volume'];?></td>
                                            <td>5.00</td>
                                            <td>委托中</td>
                                            <td><a class="theme-color cancel_btn" data-id="<?php echo $stock_item['pre_id'];?>">撤单</a></td>
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
        $('a.cancel_btn').click(function () {
            var record_id = $(this).data('id');
            $.ajax({
                url: '<?php echo base_url("index.php/stock/cancel_order/web"); ?>' + '/' + record_id,
                method: 'get',
                dataType: 'json',
                success: function(response){
                    if(response.status == '0'){
                        alert('撤销成功');
                    }
                    else if(response.status == '1'){
                        alert(response.msg);
                    }
                }
            });

        });
    });
</script>
</html>