<!--理财师个人空间侧边栏-->
<?php
$basic_info = array(
    "username" => $this->session->userdata('username'),
    "concerns_count" => $this->session->userdata('concerns_count'),
    "fans_count" => $this->session->userdata('fans_count'),
    "vips_count" => $this->session->userdata('vips_count'),
    "face_pic" => $this->session->userdata('face_pic')
);
?>
<div class="profile-sidebar">
    <div class="profile-userpic">
        <img class="img-circle img-responsive"
             src="<?php echo site_url('/uploads/'.$basic_info['face_pic']); ?>" alt="我的头像">
    </div>

    <div class="text-center">
        <h4><?php echo $basic_info["username"] ?></h4>
        <h5><a href="<?php echo base_url("index.php/auth/index"); ?>"><span class="label label-danger">实名认证</span></a></h5>
    </div>
    <div class="row">
        <div class="col-md-4 text-center">
            <a href="#"><h4 id=""><strong><?php echo $basic_info["concerns_count"]; ?></strong></h4></a>
            <h5>关注</h5>
        </div>
        <div class="col-md-4 text-center">
            <a href="#"><h4><strong><?php echo $basic_info["fans_count"]; ?></strong></h4></a>
            <h5>粉丝</h5>
        </div>
        <div class="col-md-4 text-center">
            <a href="#"><h4><strong><?php echo $basic_info["vips_count"]; ?></strong></h4></a>
            <h5>会员</h5>
        </div>
    </div>

    <div class="profile-usermenu">
        <ul class="list-group ">
            <li class="list-group-item ">
                <h4><i class="glyphicon glyphicon-edit"></i> 问答管理</h4>

                <div class="list-group">
                    <a href="<?php echo base_url('my_center/index/1/undo');?>" class="list-group-item">全部问题</a>
                </div>
            </li>
            <li class="list-group-item ">
                <h4><i class="glyphicon glyphicon-list-alt"></i> 观点管理</h4>
                <div class="list-group">
                    <a href="<?php echo base_url('opinion/pub_page');?>" class="list-group-item">发布观点</a>
                    <a href="<?php echo base_url('opinion/index');?>" class="list-group-item">已发布观点</a>
                </div>
            </li>
            <li class="list-group-item ">
                <h4><i class="glyphicon glyphicon-fire"></i> 华山论剑</h4>

                <div class="list-group">
                    <a href="#" class="list-group-item">模拟炒股</a>
                    <a href="#" class="list-group-item">示范操作</a>
                </div>
            </li>
            <li class="list-group-item ">
                <h4><i class="glyphicon glyphicon-jpy"></i> VIP管理</h4>

                <div class="list-group">
                    <a href="<?php echo base_url('index.php/my_center/index/4/1'); ?>" class="list-group-item">VIP价格</a>
                    <a href="<?php echo base_url('index.php/my_center/index/4/2'); ?>" class="list-group-item">VIP会员</a>
                </div>
            </li>
            <li class="list-group-item ">
                <h4><i class="glyphicon glyphicon-user"></i> 个人信息管理</h4>

                <div class="list-group">
                    <a href="#" class="list-group-item">我的钱包</a>
                    <a href="<?php echo base_url('index.php//my_center/index/5/1'); ?>" class="list-group-item">修改个人资料</a>
                </div>
            </li>
        </ul>
    </div>
</div>