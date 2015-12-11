<!--实名认证页面3-->
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="zh-cn">
<?php $this->load->view('./templates/head'); ?>
<body>
<div class="wrapper">
    <?php $this->load->view('./templates/navbar'); ?>
    <div class="container">
        <div class="master-enter-status">
            <div class="master-enter-status-timeline">
                <div class="master-enter-status-timeline-completion c2"></div>
            </div>
            <div class="image-master-enter-status image-master-enter-status-register active img-circle">
                <span class="status">登陆海天账号</span>
                <div class="icon"></div>
            </div>
            <div class="image-master-enter-status image-master-enter-status-information active img-circle">
                <span class="status">进行身份认证</span>
                <div class="icon"></div>
            </div>
            <div class="image-master-enter-status image-master-enter-status-realname active img-circle">
                <span class="status">人工审核</span>
                <div class="icon"></div>
            </div>
            <div class="image-master-enter-status image-master-enter-status-completed active img-circle">
                <span class="status">完成入驻</span>
                <div class="icon"></div>
            </div>
        </div>
        <div class="col-md-8 col-md-offset-2">
            <div class="well">
                <h3>审核中，<small> 请耐心等待......</small></h3>
                <h5 class="grey-color">可点击导航栏中理财师入驻按钮随时查看进度</h5>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('./templates/footer'); ?>
</body>
</html>
<style>
    .image-master-enter-status-register .icon{
        background-image: url("<?php echo base_url('assets/images/icon/step_1.png'); ?>");
    }
    .image-master-enter-status-information .icon {
        background-image: url("<?php echo base_url('assets/images/icon/step_2.png'); ?>");
    }
    .image-master-enter-status-realname .icon {
        background-image: url("<?php echo base_url('assets/images/icon/step_3.png'); ?>");
    }
    .image-master-enter-status-completed .icon {
        background-image: url("<?php echo base_url('assets/images/icon/step_4.png'); ?>");
    }
</style>
<script>

</script>