<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="zh-cn">
<?php $this->load->view('./templates/head'); ?>
<body>
<div class="wrapper">
    <?php $this->load->view('./info/info_navbar'); ?>
    <?php $this->load->view('./templates/jumptron'); ?>
    <div class="container">
        <div class="row">
            <div class="col-md-5" id="contact_us">
                <h1><span class="glyphicon glyphicon-earphone"></span> 联系我们</h1><br/>
                <ul>
                    <li>地址：深圳市南山区丽山路10号桑泰大厦10层1021</li><br/>
                    <li>邮编：518055</li><br/>
                    <li>客服电话：<p style="display:inline;">8888888888</p></li><br/>
                    <li>客服邮箱： <p style="display:inline;">htlog@haitianyuan.com</p></li>
                </ul>
            </div>
            <div class="col-md-7">
                <img src="<?php echo base_url('/assets/images/thumbnail/map.jpg'); ?>" class="img-rounded img-responsive">
            </div>
        </div>
    </div>


</div>
<?php $this->load->view('./templates/footer'); ?>
</body>
</html>
