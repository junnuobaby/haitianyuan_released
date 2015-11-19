<?php
$basic_info = $performance['data_user'];  //用户收益率等当前信息
$perform_info = $performance['data_line']; //用户历史收益率数据
$perform_avg = $performance['data_avg'];  //平均历史收益率数据
$stock_value = floatval($basic_info['fund']) - floatval($basic_info['cash_all']);  //计算持有股票的市值
$profit_rate = number_format(floatval($basic_info['profit_rate']) * 100, 2);
$profit_rank = floatval($basic_info['profit_rank']);
$day_rate = number_format(floatval($basic_info['day_rate']) * 100, 2);
$day_rank = floatval($basic_info['day_rank']);
$week_rate = number_format(floatval($basic_info['week_rate']) * 100, 2);
$week_rank = floatval($basic_info['week_rank']);
$month_rate = number_format(floatval($basic_info['month_rate']) * 100, 2);
$month_rank = floatval($basic_info['month_rank']);
?>
<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default mas_min_height">
            <div class="panel-heading"><h4>历史成绩</h4></div>
            <div class="panel-body">
                <div id="perform_canvas"></div>
                <hr/>
                <div id="profit_table">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>周期</th>
                            <th>本日收益率</th>
                            <th>本周收益率</th>
                            <th>本月收益率</th>
                            <th>总收益率</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>
                                收益率
                            </td>
                            <td class="render">
                                <?php echo $day_rate; ?>
                                %
                            </td>
                            <td class="render">
                                <?php echo $week_rate; ?>
                                %
                            </td>
                            <td class="render">
                                <?php echo $month_rate; ?>
                                %
                            </td>
                            <td class="render">
                                <?php echo $profit_rate; ?>
                                %
                            </td>
                        </tr>
                        <tr>
                            <td>排名</td>
                            <td><?php echo $day_rank; ?></td>
                            <td><?php echo $week_rank; ?></td>
                            <td><?php echo $month_rank; ?></td>
                            <td>
                                <?php echo $profit_rank; ?>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        //将数据显示格式化
        $('.formatted').each(function () {
            var value = format_num($(this).html());
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

        var div_id = document.getElementById('perform_canvas');
        draw(user_rate, avg_rate, time_list, div_id);//绘制收益率曲线图

        var parts = ['可用现金', '冻结金额', '股票市值'];
        var cash_use = decimal(parseFloat("<?php echo $basic_info['cash_use'];?>"));
        var cash_freeze = decimal(parseFloat("<?php echo $basic_info['cash_freeze'];?>"));
        var stock_value = decimal(parseFloat("<?php echo $stock_value;?>"));
        var parts_value = [
            {value: cash_use, name: '可用现金'},
            {value: cash_freeze, name: '冻结金额'},
            {value: stock_value, name: '股票市值'}
        ];
        var pie_div_id = document.getElementById('pie_canvas');
        draw_pie(parts, parts_value, pie_div_id); //绘制资金使用情况饼图

    });

</script>
