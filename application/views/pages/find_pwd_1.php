<!--找回密码页面-->
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="zh-cn">
<?php $this->load->view('./templates/head'); ?>
<body class="bg-gray">
<div class="wrapper">
    <?php $this->load->view('./templates/navbar'); ?>
    <div class="container f_pwd_container">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">找回密码</h3>
                </div>
                <div class="panel-body">
                    <?php $f_account_error = form_error('f_account'); ?>
                    <?php $f_vcode_error = form_error('f_vcode'); ?>
                    <?php echo form_open('/findpwd/findpwd_1_submit', 'class="form-horizontal f_pwd_form"'); ?>
                        <div class="form-group <?php echo $f_account_error ? 'has-error' : ''; ?>">
                            <label for="f_account" class="col-sm-3 control-label">手机号码 / 邮箱</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" id="f_account" name="f_account"  placeholder="<?php if($f_account_error) echo $f_account_error; else echo ''; ?>">
                            </div>
                        </div>
                        <div class="form-group <?php echo $f_vcode_error ? 'has-error' : ''; ?>">
                            <label for="f_vcode" class="col-sm-3 control-label">验证码</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" id="f_vcode" name="f_vcode"  placeholder="<?php if($f_vcode_error) echo $f_vcode_error; else echo '';?>">
                                <span class="grey-color">请输入图中字符，不区分大小写</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label"></label>
                            <div class="col-sm-3">
                                <div id="vcode_img">
                                    <img class="img-responsive" src="<?php echo base_url('index.php/findpwd/update_captcha/'); ?>" alt="我的头像"/>
                                </div>
                            </div>
                            <a href="#" class="next_vcode">看不清，换一张</a>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-5">
                                <button type="submit" class="btn bg-theme btn-block">下一步</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="alert alert-warning" role="alert">
                <h4>如何找回密码？</h4>
                <ul class="ht_indent">
                    <li>输入您注册的手机号码，系统将发送重置验证码到您手机。</li>
                    <li>请输入您的邮箱地址，系统将发送重置验证码到邮箱中。</li>
                    <li>输入您收到的验证码，重置密码。</li>
                </ul><br/>
                <h4>为什么收不到重置验证码？</h4>
                <ul class="ht_indent">
                    <li>是否输入您注册时使用的手机号码。</li>
                    <li>是否输入正确的邮箱地址。</li>
                    <li>可能是本站的邮件系统繁忙或者故障，请稍候再试或者联系管理员。</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('./templates/footer'); ?>
</body>
</html>
<script>
    $(document).ready(function () {
        $('.next_vcode').click(function () {
            var img = '<img class="img-responsive" src="<?php echo base_url('index.php/findpwd/update_captcha/'); ?>" alt="我的头像"/>';
            $('#vcode_img').html(img);
        });
    });
</script>