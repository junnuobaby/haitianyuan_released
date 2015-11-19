<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default mas_min_height">
            <div class="panel-heading"><h4>历史成绩</h4></div>
            <div class="panel-body">
                <div id="perform_canvas"></div>
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
                                <?php echo $week_rate;?>
                                %
                            </td>
                            <td class="render">
                                <?php echo $month_rate;?>
                                %
                            </td>
                            <td class="render">
                                <?php echo $profit_rate;?>
                                %
                            </td>
                        </tr>
                        <tr>
                            <td>排名</td>
                            <td><?php echo $day_rank;?></td>
                            <td><?php echo $week_rank; ?></td>
                            <td><?php echo $month_rank; ?></td>
                            <td>
                                <?php echo $profit_rank; ?>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <hr/>
                <div class="asset">
                    <div class="asset_detail">
                        <div class="row">
                            <div class="col-md-7">
                                <div id="pie_canvas"></div>
                            </div>
                            <div class="col-md-5">
                                <form class="form-horizontal" id="assets_form">
                                    <div class="form-group">
                                        <label class="control-label col-sm-4 grey-color">总资产：</label>
                                        <div class="col-sm-8 align_left">
                                            <div class="form-control-static">
                                                <span href="#" class="formatted"><?php echo $basic_info['fund'];?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-4 grey-color">可用现金：</label>
                                        <div class="col-sm-8 align_left">
                                            <div class="form-control-static">
                                                <span href="#" class="formatted"><?php echo $basic_info['cash_use'];?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-4 grey-color">冻结金额：</label>
                                        <div class="col-sm-8 align_left">
                                            <div class="form-control-static">
                                                <span href="#" class="formatted"><?php echo $basic_info['cash_freeze'];?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-4 grey-color">股票市值：</label>
                                        <div class="col-sm-8 align_left">
                                            <div class="form-control-static">
                                                <span href="#" class="formatted"><?php echo $stock_value;?></span>
                                            </div>
                                        </div>
                                    </div>

                                </form>
                            </div>
                            <div class="col-md-6"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
