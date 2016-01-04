<!--理财师主页-->
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="zh-cn">
<?php $this->load->view('./templates/head'); ?>
<body class="bg-gray">
<?php $this->load->view('./templates/navbar'); ?>
<?php $this->load->view('./stocks/graph'); ?>
<?php
$basic_info = $stock['data_finance']['data_user'];  //用户收益率等当前信息
$profit_rate = number_format(floatval($basic_info['profit_rate']) * 100, 2);
$profit_rank = floatval($basic_info['profit_rank']);
$day_rate = number_format(floatval($basic_info['day_rate']) * 100, 2);
$day_rank = floatval($basic_info['day_rank']);
$week_rate = number_format(floatval($basic_info['week_rate']) * 100, 2);
$week_rank = floatval($basic_info['week_rank']);
$month_rate = number_format(floatval($basic_info['month_rate']) * 100, 2);
$month_rank = floatval($basic_info['month_rank']);
$all_assets = number_format($stock['stock_value'] + $stock['bond_value'] + $basic_info['cash_all']);
?>
<div class="wrapper">
    <?php
    $data['info'] = $info;
    $data['is_fan'] = $is_fan;
    $master_id = $info['host_id'];
    $this->load->view('./master/master_jumptron', $data); ?>
    <!--页面主要内容-->
    <div class="container master_homepage_container">
        <div class="col-md-8 col-sm-8 bg-white block-radius user_min_height">
            <?php $menu_view['master_id'] = $master_id; ?>
            <?php $this->load->view('./master/master_menu', $menu_view);?>
            <div class="tab-content">
                <div class="tab-pane active" id="simulation_contest">
                    <div class="bg-white q_a_container">
                        <section>
                            <h4 class="theme-color">收益率</h4>
                            <div class="row">
                                <div id="match_perform_canvas"></div>
                            </div>
                            <div class="row well">
                                <div class="col-md-3">
                                    <div class="table-responsive">
                                        <table class="table basic_fund_info">
                                            <tr><th>本日收益率</th><td id="my_position"><?php echo $day_rate; ?>%</td></tr>
                                            <tr><th>本日排名</th><td id="fd_rate"><?php echo $day_rank; ?></td></tr>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-md-3 col-md-offset-1">
                                    <div class="table-responsive">
                                        <table class="table basic_fund_info">
                                            <tr><th>周收益率</th><td id="pl_value"><?php echo $week_rate; ?>%</td></tr>
                                            <tr><th>周排名</th><td id="fd_value"><?php echo $week_rank; ?></td></tr>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-md-3 col-md-offset-1">
                                    <div class="table-responsive">
                                        <table class="table basic_fund_info">
                                            <tr><th>月收益率</th><td id="pl_rate"><?php echo $month_rate; ?>%</td></tr>
                                            <tr><th>月排名</th><td id="fd_rate"><?php echo $month_rank; ?></td></tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <section>
                            <h4 class="theme-color">资金</h4>
                            <div class="row well">
                                <div class="col-md-4">
                                    <div class="table-responsive">
                                        <table class="table basic_fund_info">
                                            <tr><th>总资产</th><td id="my_asset" class="formatted"><?php echo $all_assets;?></td></tr>
                                            <tr><th>总现金</th><td class="formatted"><?php echo $basic_info['cash_all'];?></td></tr>
                                            <tr><th>可用现金</th><td class="formatted"><?php echo $basic_info['cash_use'];?></td></tr>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="table-responsive">
                                        <table class="table basic_fund_info">
                                            <tr><th>股票市值</th><td id="stock_value"><?php echo $stock['stock_value'];?></td></tr>
                                            <tr><th>债券市值</th><td id="bond_value"><?php echo $stock['bond_value'];?></td></tr>
                                            <tr><th>仓位</th><td id="my_position"><?php echo $basic_info['position'];?></td></tr>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="table-responsive">
                                        <table class="table basic_fund_info">
                                            <tr><th>总盈亏</th><td id="pl_value"></td></tr>
                                            <tr><th>总盈亏率</th><td id="pl_rate"></td></tr>
                                            <tr><th>浮动盈亏</th><td id="fd_value"></td></tr>
                                            <tr><th>浮动盈亏率</th><td id="fd_rate"></td></tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <section>
                            <h4 class="theme-color">持有股票<small>(行情每8s刷新)</small></h4>
                            <div class="table-responsive">
                                <table class="table table-bordered table-condensed table-hover">
                                    <thead>
                                    <tr>
                                        <th>代码</th>
                                        <th>名称</th>
                                        <th>持仓</th>
                                        <th>可卖</th>
                                        <th>成本</th>
                                        <th>现价</th>
                                        <th>浮动盈亏</th>
                                        <th>盈亏率</th>
                                        <th>涨跌幅</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($user_stocks as $stock_item): ?>
                                        <?php $sell_avail = intval($stock_item['Volume_All']) - intval($stock_item['Ban_Volume']) - intval($stock_item['Order_Volume']);?>
                                        <tr id="<?php echo $stock_item['SecurityID']; ?>">
                                            <td data-toggle="modal" data-target="#graphModal" onclick="fillimage('<?= $stock_item['SecurityID']; ?>', '<?= $stock_item['Symbol']; ?>')">
                                                <a href="#"><?php echo $stock_item['SecurityID']; ?></a>
                                            </td>
                                            <td><?php echo $stock_item['Symbol']; ?></td>
                                            <td class="formatted"><?php echo intval($stock_item['Volume_All']); ?></td>
                                            <td class="formatted"><?php echo $sell_avail;?></td>
                                            <td><?php echo number_format(floatval($stock_item['BuyCost']), 2); ?></td>
                                            <td class="stock_present_price"></td>
                                            <td class="stock_pl_value"></td>
                                            <td class="stock_pl_rate"></td>
                                            <td class="stock_extend"></td>
                                        </tr>
                                    <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                            <h4 class="theme-color">持有债券<small>(行情每8s刷新)</small></h4>
                            <div class="table-responsive">
                                <table class="table table-bordered table-condensed table-hover">
                                    <thead>
                                    <tr>
                                        <th>代码</th>
                                        <th>简称</th>
                                        <th>成本</th>
                                        <th>现价</th>
                                        <th>全价</th>
                                        <th>持仓</th>
                                        <th>可卖</th>
                                        <th>浮动盈亏</th>
                                        <th>盈亏率</th>
                                        <th>涨跌幅</th>
                                        <th>距付息</th>
                                        <th>到期时间</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($user_bonds as $stock_item): ?>
                                        <?php $sell_avail = intval($stock_item['Volume_All']) - intval($stock_item['Ban_Volume']) - intval($stock_item['Order_Volume']);?>
                                        <tr id="<?php echo $stock_item['SecurityID']; ?>" data-interest="<?php echo $stock_item['interest']; ?>">
                                            <td><?php echo $stock_item['SecurityID']; ?></td>
                                            <td><?php echo $stock_item['Symbol']; ?></td>
                                            <td><?php echo number_format(floatval($stock_item['BuyCost']), 2); ?></td>
                                            <td class="bond_present_price"></td>
                                            <td class="completed_cost"></td>
                                            <td class="formatted"><?php echo intval($stock_item['Volume_All']); ?></td>
                                            <td class="formatted"><?php echo $sell_avail; ?></td>
                                            <td class="bond_pl_value"></td>
                                            <td class="bond_pl_rate"></td>
                                            <td class="bond_extend"></td>
                                            <td><?php echo intval($stock_item['day_left']); ?></td>
                                            <td><?php echo $stock_item['profit_end']; ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </section>
                    </div>
                </div>

            </div>
        </div>
        <?php $this->load->view('./templates/right-sidebar'); ?>
    </div>
    <!--悬停go-top按钮-->
    <?php $this->load->view('./templates/go-top'); ?>
</div>
<?php $this->load->view('./templates/footer'); ?>
</body>
</html>
<script>
    /**
     * 绘制收益率曲线图
     */
    $(document).ready(function () {
        var user_rate = [];
        var avg_rate = [];
        var time_list = [];
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

        var div_id = document.getElementById('match_perform_canvas');
        draw(user_rate, avg_rate, time_list, div_id);//绘制收益率曲线图
    });

    $(document).ready(function () {
        var base_funds = parseFloat('<?php echo $basic_info['base_cash'];?>');
        var asset_all = parseFloat('<?php echo $all_assets;?>');
        var fpl_value = parseFloat('<?php echo $pl_value;?>');
        var fpl_rate = parseFloat('<?php echo $pl_rate;?>');
        var tpl_value = asset_all - base_funds;
        var tpl_rate = decimal((tpl_value * 100) / base_funds);

        $('#pl_value').html(format_num(tpl_value)).css('color', (parseFloat(tpl_value) > 0) ? 'red' : 'green');
        $('#pl_rate').html(tpl_rate + '%').css('color', (parseFloat(tpl_rate) > 0) ? 'red' : 'green');
        $('#fd_value').html(format_num(fpl_value)).css('color', (parseFloat(fpl_value) > 0) ? 'red' : 'green');
        $('#fd_rate').html(fpl_rate).css('color', (parseFloat(fpl_rate) > 0) ? 'red' : 'green');
    });
</script>