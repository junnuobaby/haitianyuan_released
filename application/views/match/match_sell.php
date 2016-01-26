<!--模拟炒股金榜-卖出-->
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="zh-cn">
<?php $this->load->view('./templates/head'); ?>
<?php
//获取持有的证券列表
$sell_stocks = $sell_list;
?>
<body class="match_index_body bg-gray">
<div class="wrapper">
    <?php $this->load->view('./stocks/bonds_navbar'); ?>
    <div class="container">
        <?php $this->load->view('./match/match_center_sidebar'); ?>
        <div class="col-md-10">
            <div class="bg-white stocks_min_h  block-radius">
                <div class="simulate_panel">
                    <div class="tab-content">
                        <h4 class="theme-color container_to_top">卖出证券</h4>
                        <div class="alert alert-info hidden" role="alert">卖出委托已经成功提交。您可以点击“撤单”来查看或撤销买入委托。</div>
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="col-md-5">
                                    <form class="form-horizontal" onkeydown="if(event.keyCode==13)return false;"
                                          autocomplete="off">
                                        <div class="form-group">
                                            <label for="bond_code" class="col-sm-4 control-label">证券代码:</label>
                                            <div class="col-sm-8 bond_code_div">
                                                <select class="form-control" id="bond_code">
                                                    <option></option>
                                                    <?php if (count($sell_stocks) == 0): ?>
                                                        <option disabled="disabled">暂无可卖证券</option>
                                                    <?php else: ?>
                                                        <?php foreach ($sell_stocks as $stock_item): ?>
                                                            <option
                                                                data-code="<?php echo $stock_item['SecurityID']; ?>"
                                                                data-name="<?php echo $stock_item['Symbol']; ?>"
                                                                data-volume="<?php echo $stock_item['max_volume']; ?>"
                                                                data-identity="<?php echo $stock_item['is_bond']; ?>"
                                                                data-cost="<?php echo $stock_item['BuyCost']; ?>">
                                                                &nbsp;&nbsp;<?php echo $stock_item['SecurityID'] ?>
                                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $stock_item['Symbol'] ?>
                                                            </option>
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group hidden largest_quantity">
                                            <label class="col-sm-4 control-label">买入价:</label>
                                            <div class="col-sm-8">
                                                <div class="input-group">
                                                        <span class="form-control warning_bg_color"
                                                              id="buy_in_price"></span>
                                                    <div class="input-group-addon">元</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group hidden largest_quantity">
                                            <label class="col-sm-4 control-label">最多可卖出:</label>
                                            <div class="col-sm-8">
                                                <div class="input-group">
                                                        <span class="form-control warning_bg_color"
                                                              id="largest_quantity"></span>
                                                    <div class="input-group-addon">手</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="buy_price" class="col-sm-4 control-label">卖出价格:</label>
                                            <div class="col-sm-8">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" id="buy_price" name="buy_price">
                                                    <div class="input-group-addon">元</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="buy_quantity" class="col-sm-4 control-label">卖出数量:</label>
                                            <div class="col-sm-8">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" id="buy_quantity" name="buy_quantity">
                                                    <div class="input-group-addon">手</div>
                                                </div>
                                                <span class="theme-color">(股票1手 = 100股)</span>
                                                <div class="theme-color">(债券1手 = 10张)</div>
                                            </div>
                                        </div>
                                        <a class="btn  bg-theme buy_stock_btn" id="buy">卖出</a>
                                    </form>
                                </div>
                                <div class="col-md-3 col-md-offset-1">
                                    <h4 id="bond_name" class="theme-color"></h4>
                                    <table class="table" id="bond_price">
                                        <tr><td>最新：</td></tr>
                                        <tr><td>昨收：</td></tr>
                                        <tr><td>涨停：</td></tr>
                                        <tr><td>跌停：</td></tr>
                                    </table>
                                </div>
                                <div class="col-md-3">
                                    <table class="table table-condensed" id="top_sell">
                                        <tr><td>卖五：</td></tr>
                                        <tr><td>卖四：</td></tr>
                                        <tr><td>卖三：</td></tr>
                                        <tr><td>卖二：</td></tr>
                                        <tr><td>卖一：</td></tr>
                                    </table>
                                    <table class="table table-condensed" id="top_buy">
                                        <tr><td>买一：</td></tr>
                                        <tr><td>买二：</td></tr>
                                        <tr><td>买三：</td></tr>
                                        <tr><td>买四：</td></tr>
                                        <tr><td>买五：</td></tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <h4 class="theme-color container_to_top">模拟交易说明：</h4>
                        <ol class="ht_indent">
                            <li>申报价格保留小数点后两位数字</li>
                            <li>交易时间与沪深A股的开市时间一致。一般为周一至周五，上午09:30至11:30，下午13:00至15:00。</li>
                            <li>交易价格按照实盘价格成交，目前支持全部沪深A股和债券，包括创业板。</li>
                            <li>所有买卖均实行T+1制度，即当天买入的股票只能在第二个交易日卖出。</li>
                            <li>买入卖出时，不收取印花税，超过一万收取交易金额的万分之三的手续费，手续费不足5元按5元收取。</li>
                            <li>大约可买入的数量根据可用金额和当前最新价计算获得。</li>
                            <li>买卖交易的股票数量不受实盘的买卖委托数量的限制。</li>
                            <li>股票价格到了跌停板后不再成交，直到停板被打开。</li>
                            <li>不能买入已经涨停的股票，不能卖出已经跌停的股票。</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><?php $this->load->view('./templates/go-top'); ?>
<?php $this->load->view('./templates/footer'); ?>
</body>
</html>
<script>
    var interval;
    var is_bond = false;
    var bond_interest = 0;
    var profit_end;

    $(document).ready(function () {
        $('.main_jumptron').css('margin-bottom', '0px');
    });
    $(document).ready(function () {
        var code_input = $('#bond_code');
        $(code_input).change(function () {
            var selected_code = $(this).children('option:selected').data('code');
            var selected_name = $(this).children('option:selected').data('name');
            var max_volume = $(this).children('option:selected').data('volume');
            var selected_cost = $(this).children('option:selected').data('cost');

            is_bond = ($(this).children('option:selected').data('identity') == 1);
            //显示最大可卖出数量
            $('div.largest_quantity').removeClass('hidden');
            //显示买入该股票价格
            $('#buy_in_price').html(decimal(selected_cost));
            if(is_bond){
                $('#largest_quantity').html(Math.round(parseInt(max_volume) / 10));
            }else{
                $('#largest_quantity').html(Math.round(parseInt(max_volume) / 100));
            }
            selected_code_info(selected_code);
            clearInterval(interval);
            interval = setInterval(function () {selected_code_info(selected_code)}, 8000); //每隔8s自动请求一次
        });

        //ajax向后台请求要卖出股票的最新信息
        function selected_code_info(code) {
            $.ajax({
                url: '<?php echo base_url("index.php/stock/req_st_data/web/gs/5"); ?>' + '/' + code,
                method: 'get',
                cache: false,
                dataType: 'json',
                success: code_info_display
            });
        }

        //显示所选证券的实时数据信息
        function code_info_display(data) {
            if (data.status == '2') {
                alert('本支股票已停牌');
                clearInterval(interval);
            }
            else {
                var response = data.st_info;
                var bond_name = response.Symbol; //ajax获取证券名称
                is_bond = (data.is_bond == 1);
                bond_interest = is_bond ? parseFloat(response.interest) : 0;
                profit_end = is_bond ? response.profit_end : '-';

                if(isNaN(bond_interest) || profit_end == null){
                    alert('暂不支持该证券！');
                }else{
                    var bond_cur_price = is_bond ? decimal_3(response.TradePrice) : decimal(response.TradePrice); //获取最新价
                    var bond_lastday_price = is_bond ? decimal_3(response.PreClosePx) : decimal(response.PreClosePx); //获取昨日收盘价
                    var bond_highest = is_bond ? decimal_3(1.1 * bond_lastday_price) : decimal(1.1 * bond_lastday_price); //涨停
                    var bond_lowest = is_bond ? decimal_3(0.9 * bond_lastday_price) : decimal(0.9 * bond_lastday_price); //跌停
                    var sell_1ist = [response.SellPrice1, response.SellPrice2, response.SellPrice3, response.SellPrice4, response.SellPrice5]; //卖五
                    var buy_1ist = [response.BuyPrice1, response.BuyPrice2, response.BuyPrice3, response.BuyPrice4, response.BuyPrice5];  //买五
                    var sell_volume = [response.SellVolume1, response.SellVolume2, response.SellVolume3, response.SellVolume4, response.SellVolume5]; //卖五
                    var buy_volume = [response.BuyVolume1, response.BuyVolume2, response.BuyVolume3, response.BuyVolume4, response.BuyVolume5];  //买五

                    for(var j= 0; j < sell_1ist.length; j++){
                        sell_1ist[j] = is_bond ? decimal_3(sell_1ist[j]) : decimal(sell_1ist[j]);
                        sell_volume[j] = is_bond ? format_num_3(sell_volume[j]) : format_num(sell_volume[j]);
                        buy_1ist[j] = is_bond ? decimal_3(buy_1ist[j]) : decimal(buy_1ist[j]);
                        buy_volume[j] = is_bond ? format_num_3(buy_volume[j]) : format_num(buy_volume[j]);
                    }

                    var bond_price_cnt = '<tr><td>最新：</td><td>' + bond_cur_price + '</td></tr>';
                    bond_price_cnt += '<tr><td>昨收：</td><td>' + bond_lastday_price + '</td></tr>';
                    bond_price_cnt += '<tr><td>涨停：</td><td>'+ bond_highest +'</td></tr>';
                    bond_price_cnt += '<tr><td>跌停：</td><td>' + bond_lowest + '</td></tr>';

                    if(is_bond){
                        bond_price_cnt += '<tr><td>全价：</td><td>' + decimal_3(bond_interest + parseFloat(bond_cur_price)) + '</td></tr>';
                        bond_price_cnt += '<tr><td>到期：</td><td>' + profit_end + '</td></tr>';
                    }

                    $('#bond_name').html(bond_name);
                    $('#bond_price').html(bond_price_cnt);


                    //设置卖五的价格和数量
                    var top_sell_cnt = '<tr><td>卖五：</td><td>' + sell_1ist[4] + '</td><td>' + sell_volume[4] + '</td></tr>';
                    top_sell_cnt += '<tr><td>卖四：</td><td>' + sell_1ist[3] + '</td><td>' + sell_volume[3] + '</td></tr>';
                    top_sell_cnt += '<tr><td>卖三：</td><td>' + sell_1ist[2] + '</td><td>' + sell_volume[2] + '</td></tr>';
                    top_sell_cnt += '<tr><td>卖二：</td><td>' + sell_1ist[1] + '</td><td>' + sell_volume[1] + '</td></tr>';
                    top_sell_cnt += '<tr><td>卖一：</td><td>' + sell_1ist[0] + '</td><td>' + sell_volume[0] + '</td></tr>';
                    $('#top_sell').html(top_sell_cnt);
                    //设置买五的价格和数量
                    var top_buy_cnt = '<tr><td>买一：</td><td>' + buy_1ist[0] + '</td><td>' + buy_volume[0] + '</td></tr>';
                    top_buy_cnt += '<tr><td>买二：</td><td>' + buy_1ist[1] + '</td><td>' + buy_volume[1] + '</td></tr>';
                    top_buy_cnt += '<tr><td>买三：</td><td>' + buy_1ist[2] + '</td><td>' + buy_volume[2] + '</td></tr>';
                    top_buy_cnt += '<tr><td>买四：</td><td>' + buy_1ist[3] + '</td><td>' + buy_volume[3] + '</td></tr>';
                    top_buy_cnt += '<tr><td>买五：</td><td>' + buy_1ist[4] + '</td><td>' + buy_volume[4] + '</td></tr>';
                    $('#top_buy').html(top_buy_cnt);

                    //根据价格设置显示颜色
                    var top_price = $('#bond_price tr td:nth-child(2),#top_buy tr td:nth-child(2), #top_sell tr td:nth-child(2)');
                    top_price.each(function () {
                        if (parseFloat($(this).html()) > parseFloat(bond_lastday_price)) {
                            $(this).addClass('red');
                        } else {
                            $(this).addClass('green');
                        }
                    });
                }
            }
        }

        //卖出按钮事件
        $('#buy').click(function () {
            var bond_code = $('#bond_code').children('option:selected').data('code'); //证券代码
            var bond_name = $('#bond_code').children('option:selected').data('name'); //证券名称
            var bond_price = $('#buy_price').val(); //卖出价格
            var bond_quantity = $('#buy_quantity').val(); //卖出数量
            var bond_quantities; //求卖出的股数（卖出手数*100）
            if(is_bond){
                bond_quantities = parseInt(bond_quantity) * 10;
            }else{
                bond_quantities = parseInt(bond_quantity) * 100;
            }
            var info_str = '确定卖出' + bond_quantity + '手' + bond_name + '?';
            if (confirm(info_str)) {
                $.ajax({
                    url: '<?php echo base_url("index.php/stock/req_st_data/web/gs/7"); ?>',
                    method: 'post',
                    data: {
                        SecurityID: bond_code,
                        Symbol: bond_name,
                        SellPrice: bond_price,
                        SellVolume: bond_quantities
                    },
                    dataType: 'json',
                    success: function (response) {
                        if (response.status == '0') {
                            $('div.alert-info').removeClass('hidden');
                        }
                        else if (response.status == '1') {
                            alert(response.msg);
                        }
                    },
                    error: function () {
                        alert('服务器错误');
                    }
                });
            }
        });
    });
</script>

