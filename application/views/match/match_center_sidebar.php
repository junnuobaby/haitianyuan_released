<!--金榜比赛侧边栏-->
<?php
$face_pic = $this->session->userdata('face_pic');
$user_name = $this->session->userdata('username');
?>
<div class="col-md-2">
    <section class="match_sidebar">
        <div class="match_avatar">
            <img width="180px" height="180px" class="img-circle img-responsive" src="<?php echo site_url('/uploads/'.$face_pic); ?>" alt="我的头像">
            <h4 class="text-center"><?php echo $user_name;?></h4>
        </div>

        <a class="match_center_item match_achive <?php if($sub_nav_mode == 'match_center_index') echo 'match_nav_active';?>" href="<?php echo base_url('/index.php/stock/match/web/1/1');?>"><span class="glyphicon glyphicon-home"></span>我的成绩</a>
        <a class="match_center_item" href="#match_trade" data-toggle="collapse"><span class="glyphicon glyphicon-jpy"></span>交易</a>
        <div class="collapse <?php if($sub_nav_mode == 'match_buy' || $sub_nav_mode == 'match_sell' || $sub_nav_mode == 'match_orders') echo 'in';?>" id="match_trade">
            <a href="<?php echo base_url('/index.php/stock/match/web/1/2');?>" class="match_trade_btn <?php if($sub_nav_mode == 'match_buy') echo 'match_nav_active';?>">买入</a>
            <a href="<?php echo base_url('/index.php/stock/match/web/1/3');?>" class="match_trade_btn <?php if($sub_nav_mode == 'match_sell') echo 'match_nav_active';?>">卖出</a>
            <a href="<?php echo base_url('/index.php/stock/match/web/1/4');?>" class="match_trade_btn <?php if($sub_nav_mode == 'match_orders') echo 'match_nav_active';?>">委托</a>
        </div>
        <a class="match_center_item " href="#match_records" data-toggle="collapse"><span class="glyphicon glyphicon-book"></span>交易记录</a>
        <div class="collapse <?php if($sub_nav_mode == 'match_done' || $sub_nav_mode == 'match_records') echo 'in';?>" id="match_records">
            <a href="<?php echo base_url('/index.php/stock/match/web/1/5');?>" class="match_trade_btn <?php if($sub_nav_mode == 'match_done') echo 'match_nav_active';?>">历史成交</a>
            <a href="<?php echo base_url('/index.php/stock/match/web/1/6');?>" class="match_trade_btn <?php if($sub_nav_mode == 'match_records') echo 'match_nav_active';?>">操作记录</a>
        </div>
        <a class="match_center_item" href="<?php echo base_url('index.php/match/match_rank');?>"><span class="glyphicon glyphicon-align-left"></span> 排行榜</a>
        <a class="match_center_item" href="#"><span class="glyphicon glyphicon-edit"></span>奖项公布</a>
    </section>
</div>
<style>
    .match_sidebar {
        background: #FFF6D2 url('<?php echo base_url('/assets/images/back/match_back2.png');?>') repeat scroll;
    }
    .match_index_body {
        background: #E33F27 url('<?php echo base_url('/assets/images/back/match_back1.png');?>') no-repeat scroll;
    }
</style>