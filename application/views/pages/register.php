<!--注册页面-->
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="zh-cn">
<?php $this->load->view('./templates/head'); ?>
<body>
<div class="wrapper">
    <?php $this->load->view('./templates/navbar'); ?>
    <?php $this->load->view('./templates/jumptron'); ?>
    <!--    --><?php //echo base_url("index.php/register/send_code/")?>

    <div class="container">
        <div class="panel">
            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-4 col-sm-offset-4 col-md-4 col-md-offset-4">
                        <div class="page-header">
                            <h1>海天理财
                                <small>会员注册</small>
                            </h1>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-4 col-sm-offset-4 col-md-4 col-md-offset-4">

                        <?php echo form_open('register/load_info') ?>
                        <div class="form-group has-feedback">
                            <label for="user_mobile">手机号</span></label>
                            <label id="user_mobile_error" style="color: red"></label>
                            <input type="tel" class="form-control" id="user_mobile" name="phone_number"
                                   placeholder="请输入11位有效手机号码" required onblur=" validate_phone(this,'user_mobile')"
                                   data-container="body" data-placement="top"
                                   data-content="请输入11位有效手机号码！">

                            <span class="glyphicon glyphicon-phone form-control-feedback" aria-hidden="true"></span>
                        </div>
                        <div class="form-group register_input">
                            <div class="input-group">
                                <input type="text" class="form-control" id="verification_code" name="phone_code"
                                       placeholder="输入手机收到的验证码" required>
                                <span class="input-group-btn">
                                    <button href="#" id="send_code" class="btn btn-danger btn-a-light">发送验证码</button>
                                </span>
                            </div>
                            <!-- /input-group -->
                        </div>


                        <div class="form-group has-feedback register_input">
                            <label for="password1">登陆密码 </label>
                            <label id="password1_error" style="color: red"></label>
                            <input type="password" class="form-control" id="password1" name="password"
                                   placeholder="密码长度6~32位" required
                                   onblur=" validate_pwd(this)"
                                   data-container="body" data-placement="top"
                                   data-content="密码长度必须在6~32位！">
                            <span class="glyphicon glyphicon-lock form-control-feedback" aria-hidden="true"></span>
                        </div>

                        <div class="form-group has-feedback register_input">
                            <label for="password2">确认密码 </label>
                            <label id="password2_error" style="color: red"></label>
                            <input type="password" class="form-control" id="password2" name="passconf"
                                   placeholder="再次输入密码" required
                                   onblur=" validate_pwdconf(this)"
                                   data-container="body" data-placement="top"
                                   data-content="前后密码输入不一致！">
                            <span class="glyphicon glyphicon-lock form-control-feedback" aria-hidden="true"></span>
                        </div>

                        <button type="submit" class="btn btn-lg btn-block btn-danger">注册</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<!--.wrapper-->
<?php $this->load->view('./templates/footer'); ?>

<script type="text/javascript">
    var second = 59;
    var speed = 1000;
    var send_code = $('#send_code');
    var count_down = false;
    //    倒计时一分钟
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

        //输入手机号时设置发送验证码按钮为不可用状态
        user_mobile.focus(function(){
            $('#send_code').attr("disabled","disabled");
        });
        user_mobile.blur(function(){
            if(user_mobile.val().length == 11){
                $('#send_code').removeAttr('disabled');}
        });


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

        //    检查用户输入的手机号码是否已经被注册
        user_mobile.blur(

            function () {
                var phone_num = $('#user_mobile').val();
                $.get("<?php  echo base_url('/index.php/register/is_exist/web/')?>"+'/' + phone_num ,
                    function (data, status) {
//                        alert(data);
                        if (data  == 'true'){

                            $('#user_mobile_error').html('(该号码已注册！)');
                            $('#send_code').attr("disabled","disabled");
                        }
                    });
            }
        );


    });


    //检查手机号码的合法性，长度为11位
    function validate_phone(field, id) {
        with (field) {
            re =  /1[3458]{1}\d{9}$/;
            legal = re.test(value);
//            alert(legal);
            if (value.length != 11 || !legal) {
                $('#' + id + '_error').html('(请输入11位有效手机号码！)');
                $('#send_code').attr("disabled","disabled");
            }
            else {
                $('#' + id + '_error').html('');
            }
        }
    }


    //检查密码是否合法,密码长度6-50位
    function validate_pwd(field, id) {
        with (field) {
            if (value.length < 6 | value.length > 50) {
                $('#' + id + '_error').html('(请输入6~32位密码！)');
            }
            else {
                $('#' + id + '_error').html('');
            }
        }
    }

    //检查第二次输入的密码是否和第一次一样
    function validate_pwdconf(field, id) {
        with (field) {
            if (value != document.getElementById('password1').value) {
                $('#' + id + '_error').html('(两次输入不一致！)');
            }
            else {
                $('#' + id + '_error').html('');
            }
        }
    }


</script>

</html>
