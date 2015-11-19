<!--模拟炒股，已成交的订单-->
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="zh-cn">
<?php $this->load->view('./templates/head'); ?>
<!--加载绘图程序-->
<?php $this->load->view('./stocks/graph'); ?>
<?php
//$basic_info = $performance['data_user'];  //用户收益率等当前信息
//$perform_info = $performance['data_line']; //用户历史收益率数据
//$perform_avg = $performance['data_avg'];  //平均历史收益率数据
//$stock_value = floatval($basic_info['fund']) - floatval($basic_info['cash_all']);  //计算持有股票的市值
//$profit_rate = number_format(floatval($basic_info['profit_rate']) * 100, 2);
//$profit_rank = floatval($basic_info['profit_rank']);
//$day_rate = number_format(floatval($basic_info['day_rate']) * 100,2);
//$day_rank = floatval($basic_info['day_rank']);
//$week_rate = number_format(floatval($basic_info['week_rate']) * 100, 2);
//$week_rank = floatval($basic_info['week_rank']);
//$month_rate = number_format(floatval($basic_info['month_rate']) * 100, 2);
//$month_rank = floatval($basic_info['month_rank']);
$data['performance'] = $performance;
?>
<body class="bg-gray">
<div class="wrapper">
    <?php $this->load->view('./stocks/bonds_navbar'); ?>
    <div class="container">
        <div class="row">
            <?php $this->load->view('./stocks/simu_menu'); ?>
        </div>
        <?php $this->load->view('./stocks/performance', $data); ?>
    </div>

    <!--悬停go-top按钮-->
    <?php $this->load->view('./templates/go-top'); ?>
</div>
<?php $this->load->view('./templates/footer'); ?>
</body>

</html>