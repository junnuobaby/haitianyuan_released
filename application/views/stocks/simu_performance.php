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
//数据预处理
$user_rate = array();  //保存用户历史收益率数组
$avg_rate = array();   //保存平均收益率的数组
$time_list = array();  //保存时间的数组
foreach ($perform_info as $item) {
    $time = explode(' ', '')
    array_push($user_rate, $item['day_rate']);
    array_push($time_list, $item['timestamp']);
}
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
                <div class="panel panel-default">
                    <div class="panel-heading"><h4>历史成绩</h4></div>
                    <div class="panel-body">
                        <div id="perform_canvas" style="height: 500px;"></div>
                        <div class="asset">
                            <h4>资产收益状况</h4>

                            <div class="asset_detail">

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
        draw();
    });
</script>

<style type="text/css">
    .asset_detail {
        background-image: url("<?php echo base_url('assets/images/baidubg.png'); ?>");
        background-color: #FFF8ED;
        height: 200px;
    }
</style>
</html>