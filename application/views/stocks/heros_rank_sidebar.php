<div>
    <div class="list-group">
        <span class="list-group-item">
           排行榜
        </span>
        <a href="<?php echo base_url('/index.php/stock/index/web/2/1');?>" class="list-group-item <?php if($nav_mode == "simu_heros_1") echo "active_list_item"; ?>">总收益率排名</a>
        <a href="<?php echo base_url('/index.php/stock/index/web/2/2');?>" class="list-group-item <?php if($nav_mode == "simu_heros_2") echo "active"; ?>">日收益率排名</a>
        <a href="<?php echo base_url('/index.php/stock/index/web/2/3');?>" class="list-group-item <?php if($nav_mode == "simu_heros_3") echo "active"; ?>">周收益率排名</a>
        <a href="<?php echo base_url('/index.php/stock/index/web/2/4');?>" class="list-group-item <?php if($nav_mode == "simu_heros_4") echo "active"; ?>">月收益率排名</a>
    </div>
</div>