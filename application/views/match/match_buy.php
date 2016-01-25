<!--模拟炒股金榜-买入-->
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="zh-cn">
<?php $this->load->view('./templates/head'); ?>
<body class="match_index_body bg-gray">
<div class="wrapper">
    <?php $this->load->view('./stocks/bonds_navbar'); ?>
    <div class="container">
        <?php $this->load->view('./match/match_center_sidebar'); ?>
        <div class="col-md-10">
            <div class="bg-white stocks_min_h  block-radius">
                <div class="simulate_panel">
                    <div class="tab-content">
                        <h4 class="theme-color container_to_top">买入证券</h4>
                        <div class="alert alert-info hidden" role="alert">买入委托已经成功提交。您可以点击“撤单”来查看或撤销买入委托。</div>
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="col-md-5">
                                    <form class="form-horizontal" onkeydown="if(event.keyCode==13)return false;" autocomplete="off">
                                        <div class="form-group">
                                            <label class="col-sm-4 control-label">可用现金:</label>
                                            <div class="col-sm-8">
                                                <div class="input-group">
                                                    <span class="form-control warning_bg_color formatted"><?php echo $cash_use; ?></span>
                                                    <div class="input-group-addon">元</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="bond_code" class="col-sm-4 control-label">证券代码:</label>
                                            <div class="col-sm-8 bond_code_div">
                                                <input type="text" class="form-control" id="bond_code" autocomplete="off" name="bond_code" placeholder="代码 / 名称">
                                                <div class="hint_list"></div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="buy_price" class="col-sm-4 control-label">买入价格:</label>
                                            <div class="col-sm-8">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" id="buy_price" name="buy_price" placeholder="保留小数点后两位">
                                                    <div class="input-group-addon">元</div>
                                                </div>
                                                <span class="theme-color hidden buy_price_alert">请输入正确的买入价格</span>
                                            </div>
                                        </div>
                                        <div class="form-group hidden largest_quantity">
                                            <label class="col-sm-4 control-label">大约可买入:</label>
                                            <div class="col-sm-8">
                                                <div class="input-group">
                                                    <span class="form-control warning_bg_color" id="largest_quantity"></span>
                                                    <div class="input-group-addon">手</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="buy_quantity" class="col-sm-4 control-label">买入数量:</label>
                                            <div class="col-sm-8">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" id="buy_quantity" name="buy_quantity">
                                                    <div class="input-group-addon">手</div>
                                                </div>
                                                <span class="theme-color">(股票1手 = 100股)</span>
                                                <div class="theme-color">(债券1手 = 10张)</div>
                                            </div>
                                        </div>
                                        <a class="btn  bg-theme buy_stock_btn" id="buy">买入</a>
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
    /**
     * 全局变量
     * interval - setInterval返回的ID值
     * is_bond - 选中的证券是否为债券，默认为股票
     * interest - 仅为债券时有该值。
     */
    var interval;
    var is_bond = false;
    var bond_interest = 0;
    $(document).ready(function () {
        $('.main_jumptron').css('margin-bottom', '0px');
        $('.formatted').each(function () {
            var value = format_num($(this).html());
            $(this).html(value);
        });
    });
    $(document).ready(function () {
        var xhr;
        var code_input = $('#bond_code');
        var hint_list = $('div.hint_list');
        // 响应按键操作并使用AJAX请求获取匹配结果
        code_input.keyup(get_hint_list);
        // 实现导航功能，添加向上和向下箭头键以及enter键选择列表项的功能
        code_input.keydown(navigate_list);
        hint_list.delegate('tr', 'mouseover mouseout click', mouse_list);

        // 获取自动补全的代码列表
        function get_hint_list(event) {
            var code_input_val = $.trim($(this).val());
            if (code_input_val == '' || event.which == 27) {
                hint_list.empty().hide();
            }
            //如果输入的是数字
            if ((event.which >= 48 && event.which <= 57) || event.which == 8 || event.which == 46
                || (event.which >= 96 && event.which <= 105)) {
                if (xhr) {
                    xhr.abort();
                }
                if (code_input_val.length >= 1) {
                    xhr = $.ajax({
                        url: '<?php echo base_url("index.php/stock/req_st_data/web/gs/3"); ?>' + '/' + code_input_val,
                        method: 'get',
                        cache: false,
                        dataType: 'json',
                        success: show_hint_list
                    });
                }
            }
            //输入的是非数字
            else if (!(event.which == 38 || event.which == 40 || event.which == 13)) {
                if (xhr) {
                    xhr.abort();
                }
                if (code_input_val.length >= 1) {
                    xhr = $.ajax({
                        url: '<?php echo base_url("index.php/stock/req_st_data/web/gs/3"); ?>' + '/' + encodeURIComponent(code_input_val),
                        method: 'get',
                        cache: false,
                        dataType: 'json',
                        success: show_hint_list
                    });
                }
            }
        }

        // 生成并显示提示列表
        function show_hint_list(data) {
            var response = data.st_code;
            var content = '<table class="table table-responsive table-condensed">' +
                '<tr><th>代码</th><th>名称</th></tr>';
            for (var i = 0; i < response.length; i++) {
                content += '<tr><td>' + response[i]['SecurityID'] + '</td><td>' + response[i]['Symbol'] + '</td></tr>';
            }
            content += '</table>';
            $('div.hint_list').html(content).show();
        }

        //响应上下键事件
        function navigate_list(event) {
            var cur = $('div.hint_list tr.hint_active');
            var bond_code = $('#bond_code');
            switch (event.which) {
                case 38:  //上键
                    if (cur.length > 0) {
                        cur.removeClass('hint_active').prev('tr').addClass('hint_active');
                    }
                    else {
                        $('div.hint_list tr:last').addClass('hint_active');
                    }
                    break;
                case 40:  //下键
                    if (cur.length > 0) {
                        cur.removeClass('hint_active').next('tr').addClass('hint_active');
                    }
                    else {
                        $('div.hint_list tr:nth-child(2)').addClass('hint_active');
                    }
                    break;
                case  13: //enter键
                    bond_code.val($('div.hint_list tr.hint_active td:first').html());
                    $('div.hint_list').empty().hide();
                    selected_code_info(bond_code.val());
                    clearInterval(interval);
                    interval = setInterval(selected_code_info(bond_code.val()), 8000); //每隔8s自动请求一次
                    break;
            }
        }

        //鼠标移动和点击事件
        function mouse_list(event) {
            var cur = $('div.hint_list tr.hint_active');
            var bond_code = $('#bond_code');
            if (event.type == 'mouseover') {
                cur.removeClass('hint_active');
            }
            $(this).toggleClass('hint_active');
            if (event.type == 'click') {
                bond_code.val($(this).children('td:first').html());
                $('div.hint_list').empty().hide();
                bond_code.focus();
                selected_code_info(bond_code.val());
                clearInterval(interval);
                interval = setInterval(function () {selected_code_info(bond_code.val())}, 8000); //每隔8s自动请求一次
            }
        }

        //在鼠标点击选中和enter键之后调用该函数
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
                alert('已停牌');
                clearInterval(interval);
            }
            else {
                var response = data.st_info;
                var bond_name = response.Symbol; //ajax获取证券名称
                is_bond = (data.is_bond == 1);
                bond_interest = is_bond ? response.interest : 0;
                if(isNaN(bond_interest)){
                    alert('暂不支持该股票！');
                }
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

                //设置价格显示颜色
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

        //用户输入买入价格后提示最大可买入量
        $('#buy_price').bind({
            blur: function () {
                var bond_price = $.trim($(this).val());
                var available_money = "<?php echo $cash_use;?>";
                if (isNaN(bond_price) || parseFloat(bond_price) <= 0) {
                    $('span.buy_price_alert').removeClass('hidden');
                }
                if (bond_price.length > 0 && !isNaN(bond_price) && parseFloat(bond_price) > 0) {
                    bond_interest = parseFloat(bond_interest);
                    bond_price = decimal(bond_price);
                    available_money = parseFloat(available_money);
                    var quantity_avail = (is_bond) ? parseInt(available_money / ((bond_price + bond_interest) * 10)) : parseInt(available_money / (bond_price * 100));
                    $('div.largest_quantity').removeClass('hidden');
                    $('#largest_quantity').html(quantity_avail);
                }
            },
            focus: function () {
                $('span.buy_price_alert').addClass('hidden');
                $('div.largest_quantity').addClass('hidden');
            }
        });

        //买入按钮事件
        $('#buy').click(function () {
            var bond_code = $('#bond_code').val(); //证券代码
            var bond_name = $('#bond_name').html(); //证券名称
            var bond_price = decimal($('#buy_price').val()); //买入价格
            var bond_quantity = $('#buy_quantity').val(); //买入数量(以手为单位)
            var info_str = '确定买入' + bond_quantity + '手' + bond_name + '?';
            var bond_quantities = (is_bond) ? parseInt(bond_quantity) * 10 : parseInt(bond_quantity) * 100; //买入股数

            if (validate(bond_code, bond_price, bond_quantity) && validate_charge(bond_quantities, bond_price, "<?php echo $cash_use;?>")) {
                if (confirm(info_str)) {
                    $.ajax({
                        url: '<?php echo base_url("index.php/stock/req_st_data/web/gs/6"); ?>',
                        method: 'post',
                        data: {
                            SecurityID: bond_code,
                            BuyPrice: bond_price,
                            BuyVolume: bond_quantities,
                            Symbol: bond_name
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
            }

            //提交之前验证数据是否填写以及填写正确
            function validate(code, price, quantity) {
                if ($.trim(code).length !== 6) {
                    alert('请填写6位数字的证券代码');
                    return false;
                }
                if (($.trim(price).length < 1) || parseFloat(price) <= 0) {
                    alert('请输入合法的买入价格');
                    return false;
                }
                if (($.trim(quantity).length < 1) || parseInt(quantity) < 1 || parseInt(quantity) > parseInt($('#largest_quantity').html())) {
                    alert('请输入合法的买入数量');
                    return false;
                }
                return true;
            }

            //验证余额是否够支付预收手续费用
            function validate_charge(buy_num, buy_price, avail_money){
                var total = parseFloat(buy_num) * parseFloat(buy_price);
                var charge_money;
                if((total * 0.0003) > 5){
                    charge_money = total * 0.0003;
                }else{
                    charge_money = 5;
                }
                return (charge_money + total) < parseFloat(avail_money);
            }
        });
    });
</script>
