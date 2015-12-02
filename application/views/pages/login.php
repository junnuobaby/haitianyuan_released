<!--登陆-->
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="zh-cn">
<?php $this->load->view('./templates/head'); ?>
<body>
<div class="wrapper">
    <?php $this->load->view('./templates/navbar'); ?>
    <!--海天登陆-->
    <div class="login-box <?php if ($nav_mode == 'register') {
        echo 'register';
    } ?>">
        <div class="login-form ">
            <h1>登陆海天
                <a href="#" class="pull-right turn-to-regist turn-btn">注册 <span
                        class="glyphicon glyphicon-hand-right"></span></a>
            </h1>
            <?php $username_error = form_error('user_name_input'); ?>
            <?php $password_error = form_error('password_input'); ?>
            <?php echo form_open('login/login', 'class="form-horizontal login_form"'); ?>
            <div class="input-group <?php echo $username_error ? 'has-error' : ''; ?>">
                    <span class="input-group-addon"><span
                            class="glyphicon glyphicon-user"></span></span>
                <input type="text" class="form-control" id="user_name_input"
                       name="user_name_input"
                       placeholder="手机号/会员名/邮箱">
            </div>
            <p class="theme-color hidden">请输入账号</p>

            <div class="input-group <?php echo $password_error ? 'has-error' : ''; ?>">
                    <span class="input-group-addon"><span
                            class="glyphicon glyphicon-lock"></span></span>
                <input type="password" class="form-control" id="password_input"
                       name="password_input"
                       placeholder="密码">
            </div>
            <p class="theme-color hidden">请输入密码</p>

            <div class="row pwd-help-info">
                <div class="col-md-6">
                    <input name="remember_me" value="remember" checked="checked" type="checkbox"> 记住我
                </div>
                <div class="col-md-6">
                    <a href="#" class="white-color pull-right">忘记密码？</a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="login-btn-div">
                        <button type="submit" class="btn btn-block self-btn-danger">登陆</button>
                    </div>
                </div>
            </div>
            </form>
        </div>
        <div class="social-login">
            <ul class="nav navbar-nav txt-center">
                <!--qq第三方登陆-->
                <li><a href="#" class="white-color">
                        <img width="20px" height="20px" src="<?php echo base_url('/assets/images/qq.png'); ?>"
                             alt="..." class="img-rounded narbar_li"> qq登陆</a></li>
                <!--微博第三方登陆-->
                <li><a href="#" class="white-color">
                        <img width="20px" height="20px" src="<?php echo base_url('/assets/images/weibo.png'); ?>"
                             alt="..." class="img-rounded narbar_li"> 微博登陆</a></li>
            </ul>
        </div>
    </div>
    <!--  海天注册-->
    <div class="login-box <?php if ($nav_mode == 'login') {
        echo 'register';
    } ?>">
        <div class="login-form register-form">
            <h1>注册账户
                <a href="#" class="pull-right turn-btn turn-to-login">登陆 <span
                        class="glyphicon glyphicon-hand-right"></span></a>
            </h1>

            <?php echo form_open('register/load_info', 'class="form-horizontal login_form"') ?>
            <div class="input-group">
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-earphone"></span>
                    </span>
                <input type="tel" class="form-control" id="user_mobile" name="phone_number"
                       placeholder="手机号">
            </div>
            <p class="theme-color hidden" id="user_mobile_error"></p>

            <div class="input-group">
                    <span class="input-group-addon"><span
                            class="glyphicon glyphicon-eye-open"></span></span>
                <input type="text" class="form-control" id="verification_code" name="phone_code"
                       placeholder="验证码" required>

                <div class="input-group-btn">
                    <button id="send_code" type="button" class="btn self-btn-danger" disabled="disabled">获取验证码</button>
                </div>
            </div>
            <div class="input-group">
                    <span class="input-group-addon"><span
                            class="glyphicon glyphicon-user"></span></span>
                <input type="text" class="form-control" id="nick_name"
                       name="nick_name" required
                       placeholder="请输入昵称">
            </div>
            <p class="theme-color hidden nick_name_error" id="nick_name_error"></p>

            <div class="input-group">
                    <span class="input-group-addon"><span
                            class="glyphicon glyphicon-lock"></span></span>
                <input type="text" class="form-control" id="password"
                       name="password"
                       placeholder="密码 (不少于6位)">
            </div>
            <p class="theme-color hidden" id="pwd_error"></p>

            <div class="row pwd-help-info">
                <div class="col-md-12">
                    <div class="login-btn-div">
                        <button type="submit" class="btn btn-block self-btn-danger">注册</button>
                    </div>
                </div>
            </div>
            </form>
        </div>
        <div class="social-login">
            <ul class="nav navbar-nav txt-center">
                <!--qq第三方登陆-->
                <li><a href="#" class="white-color">
                        <img width="20px" height="20px" src="<?php echo base_url('/assets/images/qq.png'); ?>"
                             alt="..." class="img-rounded narbar_li"> qq登陆</a></li>
                <!--微博第三方登陆-->
                <li><a href="#" class="white-color">
                        <img width="20px" height="20px" src="<?php echo base_url('/assets/images/weibo.png'); ?>"
                             alt="..." class="img-rounded narbar_li"> 微博登陆</a></li>
            </ul>
        </div>
    </div>
</div>
<!--.wrapper-->
<?php $this->load->view('./templates/footer'); ?>
</body>
</html>
<style>
    body {
        position: relative;
        background-image: url("<?php echo base_url('assets/images/back/1.jpg'); ?>");
    }
</style>
<script type="text/javascript">
    //    倒计时一分钟
    var second = 59;
    var speed = 1000;
    var send_code = $('#send_code');
    var count_down = false;
    function countDown(seconds, speed) {
        var txt = '倒计时 ' + ((seconds < 10) ? "0" + seconds : seconds) + ' 秒';
        send_code.html(txt);
        send_code.attr('disabled', 'disabled');
        count_down = true;
        var timeId = setTimeout("countDown(second--,speed)", speed);
        if (seconds == 0) {
            clearTimeout(timeId);
            send_code.html('获取验证码');
            send_code.removeAttr('disabled');
            second = 59;
            count_down = false;
        }
    }

    $(document).ready(function () {
        var user_mobile = $('#user_mobile');
        var nick_name = $('#nick_name');
        var password = $('#password');
        //发送手机验证码
        send_code.click(function () {
            if (!count_down) {
                var xmlhttp = new XMLHttpRequest();
                var phone_number = $("#user_mobile").val();
                xmlhttp.open("GET", '<?php echo base_url("index.php/register/send_code/")?>' + '/web/' + phone_number, true);
                xmlhttp.send();
                countDown(second, speed);
            }
        });
        //检查用户输入的手机号码是否已经被注册
        user_mobile.blur(function () {
                var phone_num = $.trim($('#user_mobile').val());
                if (validate_phone(phone_num)) {
                    $.get("<?php  echo base_url('/index.php/register/is_exist/web/')?>" + '/' + phone_num,
                        function (data) {
                            if (data == 'true') {
                                $('#user_mobile_error').removeClass('hidden').html('(该号码已注册！)');
                            }else{
                                $('#user_mobile_error').addClass('hidden');
                            }
                        });
                    $('#send_code').removeAttr('disabled');
                }
            }
        );
        //检查昵称是否已存在
        nick_name.blur(
            function () {
                var nick_name = $.trim($('#nick_name').val());
                if (validate_nick_name(nick_name)) {
                    $.get("<?php echo base_url('/index.php/register/is_exist/web/')?>" + '/' + nick_name,
                        function (data) {
                            if (data == 'true') {
                                $('#user_mobile_error').removeClass('hidden').html('(该昵称已存在！)');
                            }
                            else{
                                $('#user_mobile_error').addClass('hidden');
                            }
                        });
                }
            }
        );
        //检查密码格式,长度6~32位
        password.blur(function () {
            var value = $.trim(password.val());
            if (value.length < 6 || value.length > 32) {
                $('#pwd_error').removeClass('hidden').html('(请输入6~32位密码！)');
            } else {
                $('#pwd_error').addClass('hidden');
            }
        });
    });
    //检查手机号码的合法性，长度为11位
    function validate_phone(value) {
            re = /1[3458]{1}\d{9}$/;
            legal = re.test(value);
            if (value.length != 11 || !legal) {
                $('#user_mobile_error').removeClass('hidden').html('请输入11位有效手机号码！');
                $('#send_code').attr("disabled", "disabled");
                return false;
            }
            else {
                $('#user_mobile_error').addClass('hidden');
                return true;
            }

    }
    //昵称格式验证，不能全为数字
    function validate_nick_name(value) {
        if (/^\d+$/.test(value)) {
            $('#nick_name_error').removeClass('hidden').html('(昵称不能为纯数字！)');
            return false;
        }
        else {
            $('#nick_name_error').addClass('hidden');
            return true;
        }
    }

    //控制登陆界面的动画
    $(document).ready(function () {
        var login_box = $('div.login-box');
        $('a.turn-btn').click(function () {
            var cur_page = login_box.not('.register');
            if (cur_page.hasClass('active')) {
                cur_page.addClass('login-delay');
            }
            if (cur_page.hasClass('login-delay') && !cur_page.hasClass('active')) {
                cur_page.removeClass('login-delay');
            }
            login_box.toggleClass('active');

        });
    });
</script>