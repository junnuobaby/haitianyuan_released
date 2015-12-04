<!--模拟炒股，撤销委托单-->
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
            <div class="col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1">
                <div class="bg-white stocks_min_h  block-radius">
                    <article class="simulate_panel">
                        <h3 class="text-center margin_to_bottom">模拟炒股操作指南</h3>
                        <section>
                            <h5>一、买入股票</h5>
                            <p>输入股票代码或名称（如600000 浦发银行），输入你要买入的价格，如果不输入默认为当前该股价格，最后输入需要买入的数量（数量必须是100的倍数，且不能超过自己帐户的可买数量）。
                                点击确定买入股票即可下单成功，等待系统成交。同时在你输入股票后即可在右边查询到该股现在的买卖五档价格表。</p>
                            <h5>二、卖出股票</h5>
                            <p>点击卖出股票即可查询到用户的所有帐户类型的持股信息，在要卖出的股票后面填写要卖出的价格跟卖出数量（数量不限制）即可下单成功，等待系统成交，直接点击卖出，系统将按实时价格立即成交。</p>
                            <h5>三、撤单操作</h5>
                            <p>当你在进行买入股票或者卖出股票的时候，若设置了买入或者卖出价后，系统正在等待成交时，该笔交易就会显示在此，如果想取消该笔交易，点击该笔交易后面的撤单即可。被冻结的股票或者资金则会解冻。</p>
                            <h5>四、VIP充值</h5>
                            <p>VIP用户充值成功以后，到帐的是海天币（海天币可在我的账户的基本信息中查询），要进行转换成VIP账户虚拟资金后才可进行VIP账户的买卖股票操作,在转换股城币数量后面填写需要转换的海天币数量即可。
                                （注：用户账户有100个股城币，如需全部转换，只需填写100即可，不是填写转换后的虚拟资金数量。）</p>
                        </section>
                    </article>
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
        $('section').css('max-width', '800px');
        $('section h5').addClass('theme-color');
        $('section p').css({'text-indent':'2em', 'line-height':'2em'});
    });
</script>
</html>