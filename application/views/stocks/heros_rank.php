<!--模拟炒股，已成交的订单-->
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="zh-cn">
<?php $this->load->view('./templates/head'); ?>
<?php
$hero_lists = $heros_list;  //获取排行榜前100数据
$ranking = 0;
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
                            <tr >
                                <th style="text-align: center;">排名</th>
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
                                <?php $ranking += 1;?>
                                <tr style="text-align: right;">
                                    <td><?= $ranking;?></td>
                                    <td><?= $item['user_name'];?></td>
                                    <td class="formatted"><?= $item['fund'];?></td>
                                    <td><?= number_format(floatval($item['position']) * 100, 2);?>%</td>
                                    <td class="render"><?= number_format(floatval($item['profit_rate']) * 100, 2);?>%</td>
                                    <td class="render"><?= number_format(floatval($item['day_rate']) * 100, 2);?>%</td>
                                    <td class="render"><?= number_format(floatval($item['week_rate']) * 100, 2);?>%</td>
                                    <td class="render"><?= number_format(floatval($item['month_rate']) * 100, 2);?>%</td>
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
        //拥有.render类的元素，若大于0，设置为红色，若小于0，设置为绿色
        $('.render').each(function () {
            var value = $(this).html().indexOf('-');
            if (value == -1) {
                $(this).css('color', 'red');
            } else {
                $(this).css('color', 'green');
            }
        });
    });
</script>
</html>