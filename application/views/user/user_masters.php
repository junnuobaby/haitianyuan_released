<!--理财师主页-->
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="zh-cn">
<?php $this->load->view('./templates/head'); ?>
<body class="bg-gray">
<?php $this->load->view('./templates/navbar'); ?>
<?php
$user_id = $info['host_id'];
$user_info = array(
    'master_id' => 1,
    'online_state' => false,   //是否在线，在线为true
    'username' => "开普勒",
    'concerns_count' => "104",
    'fans_count' => "2000",
    'vips_count' => "1190",
    'questions_count' => "2388",
    'satisfication_rate' => "80%",
    'response_time' => "2",
    'signature' => "生活源于自然,成功源于专业,理财源于全面,具备全面的金融理财学识,精通投资策略分析和资产配置",
);
$vips = array($user_info, $user_info, $user_info);
?>
<div class="wrapper">
    <?php
    $data['info'] = $info;
    $this->load->view('./user/user_jumptron', $data);
    ?>
    <div class="container master_homepage_container">
        <div class="col-md-8 col-sm-8 bg-white block-radius user_min_height">
            <?php $menu_view['user_id'] = $user_id; ?>
            <?php $this->load->view('./user/user_menu', $menu_view); ?>
            <div class="tab-content">
                <div class="tab-pane" id="self_master">
                    <div class="bg-white q_a_container">
                        <div class="panel-body">
                            <?php foreach ($vips as $vip): ?>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="master_avatar_box">
                                            <img src="<?php echo base_url('/assets/images/touxiang/1.jpg');?>" class="img-responsive img-circle user_homepage_avatar" alt="..."></div>
                                    </div>
                                    <div class="col-md-9">
                                        <h4><a href= "#" class="theme-color"><?php echo $vip['username']; ?></a></h4>
                                        <p>关注 <?php echo $vip['concerns_count']; ?> | 粉丝 <?php echo $vip['fans_count']; ?>
                                            | <?php if ($vip['online_state'] == true) {
                                                echo '在线';
                                            } else {
                                                echo "离线";
                                            } ?></p>
                                        <p>个性签名：<?php echo $vip['signature']; ?></p>
                                    </div>
                                </div>
                                <hr class="qu_hr"/>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php $this->load->view('./templates/right-sidebar'); ?>
    </div>
    <?php $this->load->view('./templates/go-top'); ?>
</div>
<?php $this->load->view('./templates/footer'); ?>
</body>
</html>