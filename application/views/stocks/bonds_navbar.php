<!--华山论剑导航栏-->
<nav class="bg-white text-center sub_navigation">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-12">
                <div>
                    <ul class="stocks_menu">
                        <li><a class="white-color" href="<?php echo base_url('/index.php/index');?>">海天首页</a></li>
                        <li class="<?php if($nav_mode == "simu_index") echo "nav_current"; ?>"><a href="<?php echo base_url('/index.php/stock/index/web/1/1');?>">模拟投资</a></li>
                        <li class="<?php if($nav_mode == "simu_heros_1") echo "nav_current"; ?>"><a href="<?php echo base_url('/index.php/stock/index/web/2');?>">英雄榜</a></li>
                        <li class="<?php if($nav_mode == "match_lists") echo "nav_current"; ?>"><a href="<?php echo base_url('/index.php/stock/index/web/3');?>">海天赛场</a></li>
                        <li class="<?php if($nav_mode == "simu_guides") echo "nav_current"; ?>"><a href="<?php echo base_url('/index.php/stock/index/web/4');?>">操作指南</a></li>
                        <li class="<?php if($nav_mode == "simu_rules") echo "nav_current"; ?>"><a href="<?php echo base_url('/index.php/stock/index/web/5');?>">交易规则</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>
<style>
    nav.sub_navigation {
        background-image: url(<?php echo base_url('/assets/images/back/stocks_nav_bg.png')?>);
    }
</style>


