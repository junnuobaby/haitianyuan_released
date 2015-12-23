<!--模拟炒股金榜-操作记录-->
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="zh-cn">
<?php $this->load->view('./templates/head'); ?>
<?php
$ranking = 0;
?>
<body class="match_index_body bg-gray">
<div class="wrapper">
    <?php $this->load->view('./stocks/bonds_navbar'); ?>
    <div class="container">
        <?php $this->load->view('./match/match_center_sidebar'); ?>
        <div class="col-md-10">
            <div class="stocks_min_h block-radius bg-white">
                <!--禅师级别-->
                <div class="rank_table">
                    <table class="table table-hover">
                        <thead>
                        <tr class="rank_thead">
                            <th>排名</th>
                            <th>用户名</th>
                            <th>总资产</th>
                            <th>仓位</th>
                            <th>本日收益率</th>
                            <th>本周收益率</th>
                            <th>本月收益率</th>
                            <th>总收益率</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($rank_lists as $item): ?>
                            <?php $ranking += 1; ?>
                            <?php if ($ranking <= 10): ?>
                                <tr class="rank_tbody">
                                    <td class="table_left">
                                        <?php
                                        if (floatval($item['scope']) > 0) {
                                            echo "<span class='glyphicon glyphicon-arrow-up theme-color'></span>";
                                        } elseif (floatval($item['scope']) < 0) {
                                            echo "<span class='glyphicon glyphicon-arrow-down green-color'></span>";
                                        } else {
                                            echo "<span class='glyphicon glyphicon-option-horizontal theme-color'></span>";
                                        }
                                        ?>
                                        <?= $ranking; ?></td>
                                    <td class="table_left">
                                        <?= $item['user_name']; ?></td>
                                    <td class="formatted table_right"><?= $item['fund']; ?></td>
                                    <td class="table_right"><?= number_format(floatval($item['position']) * 100, 2); ?>
                                        %
                                    </td>
                                    <td class="render table_right"><?= number_format(floatval($item['day_rate']) * 100, 2); ?>
                                        %
                                    </td>
                                    <td class="render table_right"><?= number_format(floatval($item['week_rate']) * 100, 2); ?>
                                        %
                                    </td>
                                    <td class="render table_right"><?= number_format(floatval($item['month_rate']) * 100, 2); ?>
                                        %
                                    </td>
                                    <td class="render table_right"><?= number_format(floatval($item['profit_rate']) * 100, 2); ?>
                                        %
                                    </td>
                                </tr>
                            <?php endif; ?>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div><?php $this->load->view('./templates/go-top'); ?>
<?php $this->load->view('./templates/footer'); ?>
</body>
</html>
<style>
    .match_index_body {
        background: #E33F27 url('<?php echo base_url('/assets/images/back/3.png');?>') no-repeat scroll;
    }
</style>
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
</script>