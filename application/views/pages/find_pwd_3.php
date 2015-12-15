<!--重置密码页面-->
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
                    <h3 class="panel-title">重置密码</h3>
                </div>
                <div class="panel-body">
                    <?php $new_pwd_error = form_error('new_pwd'); ?>
                    <?php $new_pwd_again_error = form_error('new_pwd_again'); ?>
                    <?php echo form_open('/findpwd/findpwd_3_submit', 'class="form-horizontal f_pwd_form" id="reset_pwd_form"'); ?>
                        <div class="form-group <?php echo $new_pwd_error ? 'has-error' : ''; ?>">
                            <label for="new_pwd" class="col-sm-3 control-label">新密码</label>
                            <div class="col-sm-5">
                                <input type="password" class="form-control" id="new_pwd" name="new_pwd" placeholder="<?php if($new_pwd_error) echo $new_pwd_error; else echo '请输入不少于6位的密码，不能为纯数字'; ?>">
                                <span class="new_pwd_error"></span>
                            </div>
                        </div>
                        <div class="form-group <?php echo $new_pwd_again_error ? 'has-error' : ''; ?>">
                            <label for="new_pwd_agin" class="col-sm-3 control-label">确认密码</label>
                            <div class="col-sm-5">
                                <input type="password" class="form-control" id="new_pwd_agin" name="new_pwd_again" placeholder="<?php if($new_pwd_again_error) echo $new_pwd_again_error; else echo '请再次输入新密码'; ?>">
                                <span class="new_pwd_again_error"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-5">
                                <button type="submit" class="btn bg-theme btn-block" id="reset_pwd_btn">重置密码</button>
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
        $('input[type="password"]').focus(function () {
            $('.new_pwd_error').html();
            $('.new_pwd_again_error').html();
        });
        $('#reset_pwd_btn').click(function () {
            var pwd = $('#new_pwd');
            var pwd_value = $.trim(pwd.val());
            var pwd_again = $('#new_pwd_again');
            var pwd_again_value = $.trim(pwd_again.val());
            console.log('pwd_value:' + pwd_value );
            console.log('pwd_again_value:' + pwd_value );
            if(pwd_value.length < 6 || /^\d+$/.test(pwd_value)){
                $('.new_pwd_error').html('密码不能少于6位，且不能为纯数字');
            }else if(pwd_value !== pwd_again_value) {
                $('.new_pwd_again_error').html('两次密码不一致');
            }
            else{
                $('#reset_pwd_form').submit();
            }
        });
    });
</script>