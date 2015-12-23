<!--模拟炒股金榜-操作记录-->
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="zh-cn">
<?php $this->load->view('./templates/head'); ?>
<?php
$hero_lists = array_merge($heros_list, $heros_list, $heros_list, $heros_list, $heros_list, $heros_list, $heros_list,
    $heros_list, $heros_list, $heros_list);  //获取排行榜前100数据
$len = count($hero_lists);
$stage_1 = array();   //宗师级
$stage_2 = array();   //大师级
$stage_3 = array();   //高手级
if ($len <= 10) {
    $stage_1 = $hero_lists;
} elseif ($len > 10 && $len <= 40) {
    $stage_1 = array_slice($hero_lists, 0, 10);
    $stage_2 = array_slice($hero_lists, 10);
} elseif ($len > 40) {
    $stage_1 = array_slice($hero_lists, 0, 10);
    $stage_2 = array_slice($hero_lists, 10, 30);
    $stage_3 = array_slice($hero_lists, 40);
}
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