<!--模拟炒股页面的菜单栏组件-->
<div class="tab_header">
    <ul class="simulate_tablist txt_center">
        <li><a href="<?php echo base_url('/index.php/stock/index/web/1/1');?>" class="<?php if($nav_mode == "simu_index") echo "active_a_item"; ?>">首页</a></li>
        <li><a href="<?php echo base_url('/index.php/stock/index/web/1/2');?>" class="<?php if($nav_mode == "simu_buy") echo "active_a_item"; ?>">买入</a>
        </li>
        <li><a href="<?php echo base_url('/index.php/stock/index/web/1/3');?>" class="<?php if($nav_mode == "simu_sell") echo "active_a_item"; ?>">卖出</a></li>
        <li><a href="<?php echo base_url('/index.php/stock/index/web/1/4');?>" class="<?php if($nav_mode == "simu_cancel") echo "active_a_item"; ?>"> 撤单</a></li>
        <li><a href="<?php echo base_url('/index.php/stock/index/web/1/5');?>" class="<?php if($nav_mode == "simu_done") echo "active_a_item"; ?>">成交</a></li>
        <li><a href="#">业绩</a></li>
        <li ><a href="#">记录</a></li>
    </ul>
</div>