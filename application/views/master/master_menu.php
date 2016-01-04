<div class="sub_nav">
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="<?php if($nav_mode == 'master_homepage') echo 'active theme-color';?>"><a href="<?php echo base_url('index.php/home/load_home/web/' .'master'. '/' . $master_id.'/'.'1');?>">问答</a></li>
        <li role="presentation" class="<?php if($nav_mode == 'master_opinion') echo 'active';?>"><a href="<?php echo base_url('index.php/home/load_home/web/' . 'master' . '/' . $master_id . '/' . '2'); ?>">观点</a></li>
        <li role="presentation" class="<?php if($nav_mode == 'master_simulation') echo 'active theme-color';?>"><a href="<?php echo base_url('index.php/home/load_home/web/' . 'master' . '/' . $master_id . '/' . '3'); ?>">华山论剑</a></li>
        <li role="presentation" class="<?php if($nav_mode == 'master_match') echo 'active';?>"><a href="<?php echo base_url('index.php/home/load_home/web/' . 'master' . '/' . $master_id . '/' . '4'); ?>">示范</a></li>
    </ul>
</div>