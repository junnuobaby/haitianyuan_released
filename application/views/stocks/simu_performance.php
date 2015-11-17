<!--模拟炒股，已成交的订单-->
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="zh-cn">
<?php $this->load->view('./templates/head'); ?>
<!--加载绘图程序-->
<?php $this->load->view('./stocks/graph'); ?>
<?php
$basic_info = $performance['data_user'];  //用户收益率等当前信息
$perform_info = $performance['data_line']; //用户历史收益率数据
$perform_avg = $performance['data_avg'];  //平均历史收益率数据
$stock_value = floatval($basic_info['fund']) - floatval($basic_info['cash_all']);  //计算持有股票的市值
?>
<body class="bg-gray">
<div class="wrapper">
    <?php $this->load->view('./stocks/bonds_navbar'); ?>
    <div class="container">
        <div class="row">
            <?php $this->load->view('./stocks/simu_menu'); ?>
        </div>
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default mas_min_height">
                    <div class="panel-heading"><h4>历史成绩</h4></div>
                    <div class="panel-body">
                        <div id="perform_canvas"></div>
                        <hr/>
                        <div class="asset">
                            <h4>资产收益状况</h4>
                            <div class="asset_detail">
                                <div class="row">
                                    <div class="col-md-7">
                                        <div id="pie_canvas"></div>
                                    </div>
                                    <div class="col-md-5">
                                        <form class="form-horizontal" id="assets_form">
                                            <div class="form-group">
                                                <label class="control-label col-sm-4 grey-color">总资产：</label>
                                                <div class="col-sm-8 align_left">
                                                    <div class="form-control-static">
                                                        <span href="#" class="formatted"><?php echo $basic_info['fund'];?></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-sm-4 grey-color">可用现金：</label>
                                                <div class="col-sm-8 align_left">
                                                    <div class="form-control-static">
                                                        <span href="#" class="formatted"><?php echo $basic_info['cash_use'];?></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-sm-4 grey-color">冻结金额：</label>
                                                <div class="col-sm-8 align_left">
                                                    <div class="form-control-static">
                                                        <span href="#" class="formatted"><?php echo $basic_info['cash_freeze'];?></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-sm-4 grey-color">股票市值：</label>
                                                <div class="col-sm-8 align_left">
                                                    <div class="form-control-static">
                                                        <span href="#" class="formatted"><?php echo $stock_value;?></span>
                                                    </div>
                                                </div>
                                            </div>

                                        </form>
                                    </div>
                                    <div class="col-md-6"></div>
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
        //将数据显示格式化
        $('.formatted').each(function () {
            var value = format_num($(this).html());
            $(this).html(value);
        });
        var user_rate = new Array();
        var avg_rate = new Array();
        var time_list = new Array();
        <?php $count = 0;?>
        <?php foreach($perform_info as $item):?>
        <?php $day_rate = round(floatval($item['day_rate'])*100, 2);?>
        user_rate[<?php echo $count;?>] = <?php echo $day_rate;?>;
        time_list[<?php echo $count;?>] = "<?php echo explode(' ', $item['timestamp'])[0];?>";
        <?php $count += 1;?>
        <?php endforeach;?>

        <?php $count = 0;?>
        <?php foreach($perform_avg as $item):?>
        <?php $avg_rate = round(floatval($item['day_rate'])*100, 2);?>
        avg_rate[<?php echo $count;?>] = <?php echo $avg_rate;?>;
        <?php $count += 1;?>
        <?php endforeach;?>

        draw(user_rate, avg_rate, time_list);//绘制收益率曲线图

        var parts = ['可用现金', '冻结金额', '股票市值'];
        var cash_use = "<?php echo $basic_info['cash_use'];?>";
        var cash_freeze = "<?php echo $basic_info['cash_freeze'];?>";
        var stock_value = "<?php echo $stock_value;?>";
        var parts_value = [
            {value: cash_use, name:'可用现金'},
            {value: cash_freeze, name:'冻结金额'},
            {value: stock_value, name:'股票市值'}
        ];
        draw(parts, parts_value); //绘制资金使用情况饼图
    });

</script>

</html>