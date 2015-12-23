<!--模拟炒股金榜-我的成绩页面-->
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="zh-cn">
<?php $this->load->view('./templates/head'); ?>
<?php
/**
 * user_data - dict - 用户资金数据
 *             key:
 *                cash_all - 总现金
 *                cash_use - 可用现金
 *                cash_freeze - 冻结资金
 * user_stocks - dict - 用户股票持仓
 * user_bonds - dict - 用户债券持仓
 *             key:
 *                SecurityID - 代码
 *                Symbol - 名称
 *                Volume_All -
 *                Ban_Volume - 不可卖出数量
 *                Order_Volume - 冻结数量
 *                BuyCost - 买入成本
 *                day_left - 距付息日（天）- (*仅债券有该字段)
 *                profit_end - 到期时间 - (*仅债券有该字段)
 *                interest - 债券利息 - (*仅债券有该字段)
 * base_funds - number - 用户起始资金
 */
$user_data = $user_info['data_user'];
$user_stocks = $user_info['data_stock'];
$user_bonds = $user_info['data_bond'];
$base_funds = $user_data['base_cash'];
?>
<!--绘图文件-->
<?php $this->load->view('./stocks/graph'); ?>
<?php $this->load->view('./templates/head'); ?>
<body class="match_index_body bg-gray">
<div class="wrapper">
    <?php $this->load->view('./stocks/bonds_navbar'); ?>
    <div class="container">
        <?php $this->load->view('./match/match_center_sidebar'); ?>
        <div class="col-md-10">
            <div class="bg-white stocks_min_h block-radius">
                <div class="simulate_panel">
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="home">
                            <div class="row">
                                <h4 class="theme-color container_to_top">我的资金</h4>
                                <div id="pie_canvas" class="col-md-8">
<!--                                    <img src="--><?php //echo base_url('assets/images/pie.png'); ?><!--"/>-->
                                </div>
                                <div class="col-md-4">
                                    <div class="table-responsive">
                                        <table class="table basic_fund_info">
                                            <tr><th>总资产</th><td id="my_asset" class="formatted">1000000</td></tr>
                                            <tr><th>总现金</th><td class="formatted"><?php echo $user_data['cash_all']; ?></td></tr>
                                            <tr><th>可用现金</th><td class="formatted"><?php echo $user_data['cash_use']; ?></td></tr>
                                            <tr><th>股票市值</th><td id="stock_value">0.00</td></tr>
                                            <tr><th>债券市值</th><td id="bond_value">0.00</td></tr>
                                            <tr><th>仓位</th><td id="my_position">0%</td></tr>
                                            <tr><th>总盈亏</th><td id="pl_value">0</td></tr>
                                            <tr><th>总盈亏率</th><td id="pl_rate">0</td></tr>
                                            <tr><th>浮动盈亏</th><td id="fd_value">0</td></tr>
                                            <tr><th>浮动盈亏率</th><td id="fd_rate">0</td></tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="warehouse">
                                <h4 class="theme-color">我的收益</h4>
                                <div class="row">
                                    <div class="col-md-3">
                                        <table class="table">
                                            <tr><th>周收益率：</th><td>0.00%</td></tr>
                                            <tr><th>月收益率：</th><td>0.00%</td></tr>
                                            <tr><th>周排行：</th><td>10000</td></tr>
                                            <tr><th>月排行：</th><td>10000</td></tr>
                                        </table>
                                    </div>
                                    <div class="col-md-6 col-md-offset-2" >
                                        <img height='200px' src="<?php echo base_url('assets/images/profit.png'); ?>"/>
                                    </div>
                                </div>

                            </div>
                            <div class="warehouse">
                                <h4 class="theme-color">我的股票<small>(行情每8s刷新)</small></h4>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
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
                                <div class="warehouse">
                                    <h4 class="theme-color">我的债券<small>(行情每8s刷新)</small></h4>
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
                                </div>
                            </div>
                        </div>
                    </div>
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
    /**
     * 格式化显示数据
     * 给数字渲染颜色
     */
    $(document).ready(function () {
        $('.formatted').each(function () {
            var value = format_num($(this).html());
            $(this).html(value);
        });
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