<!--模拟炒股页面的菜单栏组件-->
<div class="tab_header">
    <ul class="simulate_tablist txt_center">
        <li><a href="<?php echo base_url('/index.php/stock/index/web/1/1');?>" class="<?php if($nav_mode == "simu_index") echo "active_a_item"; ?>">首 页</a></li>
        <li><a href="<?php echo base_url('/index.php/stock/index/web/1/2');?>" class="<?php if($nav_mode == "simu_buy") echo "active_a_item"; ?>">买 入</a>
        </li>
        <li><a href="<?php echo base_url('/index.php/stock/index/web/1/3');?>" class="<?php if($nav_mode == "simu_sell") echo "active_a_item"; ?>">卖 出</a></li>
        <li><a href="<?php echo base_url('/index.php/stock/index/web/1/4');?>" class="<?php if($nav_mode == "simu_cancel") echo "active_a_item"; ?>">委 托</a></li>
        <li><a href="<?php echo base_url('/index.php/stock/index/web/1/5');?>" class="<?php if($nav_mode == "simu_done") echo "active_a_item"; ?>">成 交</a></li>
        <li><a href="<?php echo base_url('/index.php/stock/index/web/1/6');?>" class="<?php if($nav_mode == "simu_performance") echo "active_a_item"; ?>">业 绩</a></li>
        <li><a href="<?php echo base_url('/index.php/stock/index/web/1/7');?>" class="<?php if($nav_mode == "simu_records") echo "active_a_item"; ?>">记 录</a></li>
    </ul>
</div>