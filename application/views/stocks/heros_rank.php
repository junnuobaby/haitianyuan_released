<!--模拟炒股，已成交的订单-->
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="zh-cn">
<?php $this->load->view('./templates/head'); ?>
<?php
$hero_lists = $heros_list;  //获取排行榜前100数据
?>
<body class="bg-gray">
<div class="wrapper">
    <?php $this->load->view('./stocks/bonds_navbar'); ?>
    <div class="container">
        <div class="row">
            <div class="col-md-2">
                <?php $this->load->view('./stocks/heros_rank_sidebar'); ?>
            </div>
            <div class="col-md-10 col-sm-10 bg-white ">
                <div class="stocks_min_h  block-radius">
                    <div class="rank_table">
                        <table class="table table-bordered table-condensed table-hover">
                            <thead>
                            <tr class="warning">
                                <th>用户名</th>
                                <th>总资产</th>
                                <th>仓位</th>
                                <th>总收益率</th>
                                <th>日收益率</th>
                                <th>周收益率</th>
                                <th>月收益率</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($hero_lists as $item):?>
                                <tr>
                                    <td><?= $item['user_name'];?></td>
                                    <td class="formatted"><?= $item['fund'];?></td>
                                    <td ><?= $item['position'];?></td>
                                    <td class="decimal"><?= $item['profit_rate'];?></td>
                                    <td class="decimal"><?= $item['day_rate'];?></td>
                                    <td class="decimal"><?= $item['week_rate'];?></td>
                                    <td class="decimal"><?= $item['month_rate'];?></td>
                                </tr>
                            <?php endforeach;?>
                            </tbody>
                        </table>
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
        $('.formatted').each(function(){
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