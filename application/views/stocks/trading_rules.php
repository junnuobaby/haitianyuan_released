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
                        <h3 class="text-center margin_to_bottom">模拟炒股交易规则</h3>
                        <section>
                            <h5>一、模拟炒股用户必须是海天的注册用户</h5>
                            <div>
                                <ol>
                                    <li>模拟炒股用户最多可以同时拥有3个模拟股票账户，包括免费帐户、比赛帐户、VIP帐户。</li>
                                    <li>免费帐户：默认虚拟资金10万，可通过介绍好友增加资金，介绍一个好友注册送800元模拟资金。</li>
                                    <li>比赛帐户：默认虚拟资金100万，不能自行添加或者减少虚拟资金，只能通过市场股票买卖赚取。</li>
                                    <li>VIP帐户：默认虚拟资金为0，要通过股城币转换，转换比例：1股城币：2000虚拟资金。</li>
                                    <li>交易费用：印花税——单边（卖）0.1%，佣金（双边）0.05%，过户费（上海股）0.1%。</li>
                                </ol>
                            </div>
                        </section>
                        <section>
                            <h5>二、交易时间与委托买卖</h5>
                            <div>
                                <ol>
                                    <li>实时交易时间为每周一至周五，每天上午 9 ：31 至 11 ：30 ，下午 13 ：00 至 14：59。</li>
                                    <li>海天模拟炒股平台每天24小时接受埋单买卖委托且长期有效。</li>
                                    <li>海天模拟炒股平台与现实股市同样实行 T+1 操作，当天买入的股票当天不能卖出。 帐户也不能透支及买空卖空。</li>
                                </ol>
                            </div>
                        </section>
                        <section>
                            <h5>三、清算交割</h5>
                            <p>
                                 用户委托买入时，其账号上的可用资金额相应减少，在买单撮合成交时系统自动清算交割，并且计入交易费用。
                                委托卖出时，其账号上的股票立即被减少可卖数，可用资金额暂不增加，只有等待股票卖出成功时
                                系统自动清算交割，资金数量才会被刷新，并且计入交易费用。</p>
                        </section>
                        <section>
                            <h5>四、查询、撤单</h5>
                            <ol>
                                <li>用户可实时查询本人股票帐户、资金帐户、委托成交、买卖历史记录、当日排行榜等情况。</li>
                                <li>对尚未成交的委托可撤单。</li>
                            </ol>
                        </section>
                        <section>
                            <h5>五、模拟炒股的理念</h5>
                            <ol>
                                <li>总结经验、磨炼意志，加强学习的逼真性，是大多数股民的首选练习办法。</li>
                                <li>通过模拟比赛或VIP会员模拟炒股操作，考核自己在炒股方面的水平。</li>
                                <li>在模拟炒股的同时要时刻处于真实的状态实战环境中，这样才能提高能力，总结出经验。</li>
                                <li>先学习、后实践，新手应该仔细阅读本文说明。</li>
                            </ol>
                        </section>
                        <section>
                            <h5>六、注意事项</h5>
                            <p>模拟炒股毕竟同真实炒股有着性质上的不同，切不可混淆。前者的作用是练习，没有实际损失；后者处于较大的风险当中，必须谨慎。</p>
                        </section>
                        <section>
                            <h5>七、本规则未作说明的其它规则同交易所公布的证券买卖规定基本一致。</h5>
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
        $('section ol').css({'line-height':'2em', 'margin-left':'2em'});
        $('section p').css('text-indent','2em');

    });
</script>
</html>