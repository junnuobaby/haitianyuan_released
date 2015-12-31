<div class="sub_nav">
    <ul class="nav nav-tabs">
        <li role="presentation" class="<?php if($nav_mode == 'user_homepage') echo 'active';?>"><a href="<?php echo base_url('index.php/home/load_home/web/' .'user'. '/' . $user_id.'/'.'1');?>" data-toggle="tab">问答</a></li>
        <li role="presentation" class="<?php if($nav_mode == 'user_masters') echo 'active';?>"><a href="<?php echo base_url('index.php/home/load_home/web/' .'user'. '/' . $user_id.'/'.'2');?>" data-toggle="tab">私人理财师</a></li>
        <li role="presentation" class="<?php if($nav_mode == 'user_simulation') echo 'active';?>"><a href="<?php echo base_url('index.php/home/load_home/web/' .'user'. '/' . $user_id.'/'.'3');?>" data-toggle="tab">华山论剑</a></li>
        <li role="presentation" class="<?php if($nav_mode == 'user_match') echo 'active';?>"><a href="<?php echo base_url('index.php/home/load_home/web/' .'user'. '/' . $user_id.'/'.'4');?>" data-toggle="tab">海天赛场</a></li>
    </ul>
</div>