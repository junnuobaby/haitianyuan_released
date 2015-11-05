<!--模拟炒股，买入股票-->
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="zh-cn">
<?php $this->load->view('./templates/head'); ?>
<body class="bg-gray">
<div class="wrapper">
    <?php $this->load->view('./stocks/bonds_navbar'); ?>
    <div class="container">
        <div class="row">
            <?php $this->load->view('./stocks/simu_menu'); ?>
        </div>
        <div class="row">
            <div class="col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1">
                <div class="bg-white stocks_min_h  block-radius">
                    <div class="simulate_panel">
                        <div class="tab-content">
                            <h4 class="blue-color margin_to_top">买入证券</h4>

                            <div class="alert alert-info hidden" role="alert">买入委托已经成功提交。您可以点击“撤单”来查看或撤销买入委托。</div>
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <div class="col-md-5">
                                        <form class="form-horizontal" onkeydown="if(event.keyCode==13)return false;">
                                            <div class="form-group">
                                                <label for="bond_code" class="col-sm-4 control-label">证券代码:</label>

                                                <div class="col-sm-8 bond_code_div">
                                                    <input type="text" class="form-control" id="bond_code"
                                                           autocomplete="off" name="bond_code" placeholder="代码 / 名称">

                                                    <div class="hint_list"></div>
                                                </div>
                                            </div>
                                            <div class="form-group hidden largest_quantity">
                                                <label class="col-sm-4 control-label">最多可买入:</label>

                                                <div class="col-sm-8">
                                                    <div class="input-group">
                                                        <span class="form-control warning_bg_color"
                                                              id="largest_quantity"></span>
                                                        <div class="input-group-addon">手</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="buy_price" class="col-sm-4 control-label">买入价格:</label>

                                                <div class="col-sm-8">
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" id="buy_price"
                                                               name="buy_price">
                                                        <div class="input-group-addon">¥</div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="buy_quantity" class="col-sm-4 control-label">买入数量:</label>

                                                <div class="col-sm-8">
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" id="buy_quantity"
                                                               name="buy_quantity">

                                                        <div class="input-group-addon">手</div>
                                                    </div>
                                                    <span class="theme-color">(1手 = 100股)</span>
                                                </div>
                                            </div>
                                            <a class="btn btn-danger self-btn-danger buy_stock_btn" id="buy">买入</a>
                                        </form>
                                    </div>
                                    <div class="col-md-3 col-md-offset-1">
                                        <h4 id="bond_name" class="theme-color"></h4>
                                        <table class="table" id="bond_price">
                                            <tr>
                                                <td>最新：</td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>昨收：</td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>涨停：</td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>跌停：</td>
                                                <td></td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="col-md-3">
                                        <table class="table table-condensed" id="top_sell">
                                            <tr>
                                                <td>卖五：</td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>卖四：</td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>卖三：</td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>卖二：</td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>卖一：</td>
                                                <td></td>
                                            </tr>
                                        </table>
                                        <table class="table table-condensed" id="top_buy">
                                            <tr>
                                                <td>买一：</td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>买二：</td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>买三：</td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>买四：</td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>买五：</td>
                                                <td></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <h4 class="blue-color margin_to_top">模拟交易说明：</h4>
                            <ol class="ht_indent">
                                <li>目前可买卖股票和债券。</li>
                                <li>交易时间与沪深A股的开市时间一致。一般为周一至周五，上午09:30至11:30，下午13:00至15:00。</li>
                                <li>交易价格按照实盘价格成交，目前支持全部沪深A股，包括创业板。</li>
                                <li>所有买卖均实行T+1制度，即当天买入的股票只能在第二个交易日卖出。</li>
                                <li>买入时，不收取印花税，收取交易金额的千分之一的手续费，手续费不足5元按5元收取。</li>
                                <li>卖出时，收取交易金额千分之一的印花税，收取交易金额千分之一的手续费，手续费不足5元按5元收取。</li>
                                <li>买卖交易的股票数量不受实盘的买卖委托数量的限制。</li>
                                <li>股票价格到了涨跌停板后不再成交，直到停板被打开；</li>
                                <li>不能买入已经涨停的股票，不能卖出已经跌停的股票。</li>
                            </ol>

                        </div>
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
    });
    $(document).ready(function () {
        var xhr;
        var code_input = $('#bond_code');
        var hint_list = $('div.hint_list');
        code_input.keyup(get_hint_list);//响应按键操作并使用AJAX请求获取匹配结果
        code_input.keydown(navigate_list);//实现导航功能，添加向上和向下箭头键以及enter键选择列表项的功能
        hint_list.delegate('tr', 'mouseover mouseout click', mouse_list);

        //获取提示
        function get_hint_list(event) {
            var code_input_val = $.trim($(this).val());
            //如果输入框为空或者按了ESC键，则不显示提示框
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
                        url: '<?php echo base_url("index.php/stock/buy_code_complement/web"); ?>' + '/' + code_input_val,
                        method: 'get',
                        cache: false,
                        dataType: 'json',
                        success: show_hint_list
                    });
                }
            }
            //输入的是非数字
            else {
                if (xhr) {
                    xhr.abort();
                }
                if (code_input_val.length >= 1) {
                    xhr = $.ajax({
                        url: '<?php echo base_url("index.php/stock/buy_code_complement/web"); ?>' + '/' + encodeURIComponent(code_input_val),
                        method: 'get',
                        cache: false,
                        dataType: 'json',
                        success: show_hint_list
                    });
                }
            }
        }

        // 显示提示列表
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
                case 38:   //上键
                    if (cur.length > 0) {
                        cur.removeClass('hint_active').prev('tr').addClass('hint_active');
                    }
                    else {
                        $('div.hint_list tr:last').addClass('hint_active');
                    }
                    break;

                case 40:   //下键
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
                    setInterval(selected_code_info(bond_code.val()), 8000); //每隔8s自动请求一次
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
                setInterval(function () {
                    selected_code_info(bond_code.val())
                }, 8000); //每隔8s自动请求一次

            }
        }

        //在鼠标点击选中和enter键之后调用该函数
        function selected_code_info(code) {
            $.ajax({
                url: '<?php echo base_url("index.php/stock/get_bs/web"); ?>' + '/' + code,
                method: 'get',
                cache: false,
                dataType: 'json',
                success: code_info_display
            });
        }

        //显示所选证券的实时数据信息
        function code_info_display(data) {
            var response = data.st_info;
            var bond_name = response.Symbol; //ajax获取证券名称
            var bond_cur_price = response.TradePrice; //获取最新价
            var bond_lastday_price = response.PreClosePx; //获取昨日收盘价
            var bond__highest = (1.1 * bond_lastday_price).toFixed(2); //涨停
            var bond_lowest = (0.9 * bond_lastday_price).toFixed(2); //跌停
            var sell_1ist = [response.SellPrice1, response.SellPrice2, response.SellPrice3, response.SellPrice4, response.SellPrice5]; //卖五
            var buy_1ist = [response.BuyPrice1, response.BuyPrice2, response.BuyPrice3, response.BuyPrice4, response.BuyPrice5];  //买五

            $('#bond_name').html(bond_name);
            $('#bond_price tr:nth-child(1) td:nth-child(2)').html(bond_cur_price);
            $('#bond_price tr:nth-child(2) td:nth-child(2)').html(bond_lastday_price);
            $('#bond_price tr:nth-child(3) td:nth-child(2)').html(bond__highest);
            $('#bond_price tr:nth-child(4) td:nth-child(2)').html(bond_lowest);

            $('#top_sell tr:nth-child(1) td:nth-child(2)').html(sell_1ist[4]); //卖五
            $('#top_sell tr:nth-child(2) td:nth-child(2)').html(sell_1ist[3]); //卖四
            $('#top_sell tr:nth-child(3) td:nth-child(2)').html(sell_1ist[2]); //卖三
            $('#top_sell tr:nth-child(4) td:nth-child(2)').html(sell_1ist[1]); //卖二
            $('#top_sell tr:nth-child(5) td:nth-child(2)').html(sell_1ist[0]); //卖一

            $('#top_buy tr:nth-child(1) td:nth-child(2)').html(buy_1ist[0]); //买一
            $('#top_buy tr:nth-child(2) td:nth-child(2)').html(buy_1ist[1]); //买二
            $('#top_buy tr:nth-child(3) td:nth-child(2)').html(buy_1ist[2]); //买三
            $('#top_buy tr:nth-child(4) td:nth-child(2)').html(buy_1ist[3]); //买四
            $('#top_buy tr:nth-child(5) td:nth-child(2)').html(buy_1ist[4]); //买五

            //根据价格设置显示颜色
            var top_price = $('#bond_price tr td:nth-child(2),#top_buy tr td:nth-child(2), #top_sell tr td:nth-child(2)');
            top_price.each(function () {
                if (parseFloat($(this).html()) > parseFloat(bond_lastday_price)) {
                    $(this).addClass('theme-color');
                } else {
                    $(this).addClass('green-color');
                }
            });
            //将当前价格设置为默认的买入价格
            $('#buy_price').val(bond_cur_price);
            var bond_price = $('#buy_price').val(); //买入价格
            var available_money = "<?php echo $cash_use;?>";
            var quantity_avail = Math.round(parseFloat(available_money) / (parseFloat(bond_price) * 100)); //计算当前可买入的最大股数
            $('div.largest_quantity').removeClass('hidden');
            $('#largest_quantity').html(quantity_avail);
        }

        //点击买入按钮，将买入股票信息
        $('#buy').click(function () {
            var bond_code = $('#bond_code').val(); //证券代码
            var bond_name = $('#bond_name').html(); //证券名称
            var bond_price = $('#buy_price').val(); //买入价格
            var bond_quantity = $('#buy_quantity').val(); //买入数量(以手为单位)
            var info_str = '确定买入 ' + bond_quantity + ' 手' + bond_name + '?';
            var bond_quantities = parseInt(bond_quantity) * 100; //求买入的股数（买入数量*100）

            if (confirm(info_str)) {
                $.ajax({
                    url: '<?php echo base_url("index.php/stock/buy_stock/web"); ?>',
                    method: 'post',
                    data: {SecurityID: bond_code, BuyPrice: bond_price, BuyVolume: bond_quantities, Symbol: bond_name},
                    dataType: 'json',
                    success: function (response) {
                        if (response.status == '0') {
                            $('div.alert-info').removeClass('hidden');
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
</html>