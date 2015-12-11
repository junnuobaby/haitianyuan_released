<!--实名认证页面4-->
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
                <div class="master-enter-status-timeline-completion c3"></div>
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
            <div class="panel panel-danger">
                <div class="panel-heading">
                    <strong>审核结果</strong>
                </div>
                <div class="panel-body">
                    <div>
                        <h3>恭喜您，成功入驻成为海天园理财师</h3>
                        <h5>立即前往我的<strong><a href="#" class="theme-color">主页</a></strong></h5>
                    </div>
                </div>
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
    $(document).ready(function () {
    });

</script>