<!--排行榜-->
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="zh-cn">
<?php $this->load->view('./templates/head'); ?>
<?php
//$hero_lists = $heros_list;  //获取排行榜前100数据
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
<body class="bg-gray">
<div class="wrapper">
    <?php $this->load->view('./stocks/bonds_navbar'); ?>
    <div class="container">
        <div class="row">
            <div class="col-md-2">
                <div id="ranking_sidebar" class="flow-sidebar" data-spy="affix" data-offset-top='70'>
                    <div class="list-group">
                        <a href="<?php echo base_url('/index.php/stock/index/web/2/1');?>" class="list-group-item <?php if($nav_mode == "simu_heros_1") echo "active"; ?>"><span class="glyphicon glyphicon-star"></span> 总收益率排名</a>
                        <a href="<?php echo base_url('/index.php/stock/index/web/2/2');?>" class="list-group-item <?php if($nav_mode == "simu_heros_2") echo "active"; ?>"><span class="glyphicon glyphicon-asterisk"></span> 日收益率排名</a>
                        <a href="<?php echo base_url('/index.php/stock/index/web/2/3');?>" class="list-group-item <?php if($nav_mode == "simu_heros_3") echo "active"; ?>"><span class="glyphicon glyphicon-th-large"></span> 周收益率排名</a>
                        <a href="<?php echo base_url('/index.php/stock/index/web/2/4');?>" class="list-group-item <?php if($nav_mode == "simu_heros_4") echo "active"; ?>"><span class="glyphicon glyphicon-th"></span> 月收益率排名</a>
                    </div>
                </div>            </div>
            <div class="col-md-10 col-sm-10 bg-white ">
                <div class="stocks_min_h  block-radius">
                    <!--禅师级别-->
                    <div class="rank_table">
                        <div class="col-md-8 col-md-offset-4">
                            <div class="plaque">
                                <img width="70px" height="70px" class="img-responsive "
                                     src="<?php echo base_url('/assets/images/icon/chanshi.png'); ?>" alt="Logo加载中...">
                                <img class="img-responsive "
                                     src="<?php echo base_url('/assets/images/icon/chanshilogo.png'); ?>"
                                     alt="Logo加载中...">
                            </div>
                        </div>
                        <table class="table table-bordered table-condensed table-hover">
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
                            <?php foreach ($stage_1 as $item): ?>
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
                                            <img width="20px" height="20px" src="<?php echo base_url('/uploads/' . $item['face_pic']); ?>"
                                                class="img-responsive " alt="..."> <?= $item['user_name']; ?></td>
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
                    <!--宗师级别-->
                    <?php if (count($stage_2) > 0): ?>
                        <div class="rank_table">
                            <div class="col-md-8 col-md-offset-4">
                                <div class="plaque">
                                    <img width="70px" height="70px" class="img-responsive "
                                         src="<?php echo base_url('/assets/images/icon/zongshi.png'); ?>"
                                         alt="Logo加载中...">
                                    <img class="img-responsive "
                                         src="<?php echo base_url('/assets/images/icon/zongshilogo.png'); ?>"
                                         alt="Logo加载中...">
                                </div>
                            </div>
                            <table class="table table-bordered table-condensed table-hover">
                                <thead>
                                <tr class="rank_thead">
                                    <th>排名</th>
                                    <th>用户名</th>
                                    <th>总资产</th>
                                    <th>仓位</th>
                                    <th>日收益率</th>
                                    <th>周收益率</th>
                                    <th>月收益率</th>
                                    <th>总收益率</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($stage_2 as $item): ?>
                                    <?php $ranking += 1; ?>
                                    <?php if ($ranking > 10 && $ranking <= 40): ?>
                                        <tr class="rank_tbody">
                                            <td class="table_left"><?php
                                                if (floatval($item['scope']) > 0) {
                                                    echo "<span class='glyphicon glyphicon-arrow-up theme-color'></span>";
                                                } elseif (floatval($item['scope']) < 0) {
                                                    echo "<span class='glyphicon glyphicon-arrow-down green-color'></span>";
                                                } else {
                                                    echo "<span class='glyphicon glyphicon-option-horizontal theme-color'></span>";
                                                }
                                                ?>
                                                <?= $ranking; ?></td>
                                            <td class="table_left"><img width="20px" height="20px" src="<?php echo base_url('/uploads/' . $item['face_pic']); ?>"
                                                                        class="img-responsive " alt="..."> <?= $item['user_name']; ?></td>
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
                    <?php endif; ?>
                    <!--大师级别-->
                    <?php if (count($stage_3) > 0): ?>
                        <div class="rank_table">
                            <div class="col-md-8 col-md-offset-4">
                                <div class="plaque">
                                    <img width="70px" height="70px" class="img-responsive "
                                         src="<?php echo base_url('/assets/images/icon/dashi.png'); ?>"
                                         alt="Logo加载中...">
                                    <img class="img-responsive "
                                         src="<?php echo base_url('/assets/images/icon/dashilogo.png'); ?>"
                                         alt="Logo加载中...">
                                </div>
                            </div>
                            <table class="table table-bordered table-hover table-condensed">
                                <thead>
                                <tr class="rank_thead">
                                    <th>排名</th>
                                    <th>用户名</th>
                                    <th>总资产</th>
                                    <th>仓位</th>
                                    <th>日收益率</th>
                                    <th>周收益率</th>
                                    <th>月收益率</th>
                                    <th>总收益率</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($stage_3 as $item): ?>
                                    <?php $ranking += 1; ?>
                                    <?php if ($ranking > 40 && $ranking <= 100): ?>
                                        <tr class="rank_tbody">
                                            <td class="table_left"><?php
                                                if (floatval($item['scope']) > 0) {
                                                    echo "<span class='glyphicon glyphicon-arrow-up theme-color'></span>";
                                                } elseif (floatval($item['scope']) < 0) {
                                                    echo "<span class='glyphicon glyphicon-arrow-down green-color'></span>";
                                                } else {
                                                    echo "<span class='glyphicon glyphicon-option-horizontal theme-color'></span>";
                                                } ?>
                                                <?= $ranking; ?></td>
                                            <td class="table_left"><img width="20px" height="20px" src="<?php echo base_url('/uploads/' . $item['face_pic']); ?>"
                                                                        class="img-responsive " alt="..."> <?= $item['user_name']; ?></td>
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
                    <?php endif; ?>
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
        $('.formatted').each(function () {
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