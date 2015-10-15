<!--理财师个人信息管理页面-->
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="zh-cn">
<?php $this->load->view('./templates/head'); ?>
<body>
<link href="<?php echo base_url('/assets/css/jquery.Jcrop.css'); ?>" rel="stylesheet" media="screen">
<script src="<?php echo base_url('/assets/js/htyjs/general_navbar.js') ?>"></script>
<script src="<?php echo base_url('/assets/js/webjs/Region.js') ?>"></script>
<script src="<?php echo base_url('/assets/js/webjs/jquery.Jcrop.js') ?>"></script>
<script src="<?php echo base_url('/assets/js/moment.js') ?>"></script>
<?php
$basic_info = array(
    "username" => $this->session->userdata('username'),
    "gender" => $this->session->userdata('gender') == 1 ? '男' : '女',
    "birthday" => $this->session->userdata('birthday'),
    "institue" => $this->session->userdata('institue'),
    "qualification" => $this->session->userdata('qualification'),
    "signature" => $this->session->userdata('signature'),
    "location" => $this->session->userdata('location'),
    "email" => $this->session->userdata('email'),
    "mobile" => $this->session->userdata('mobile')

);
$user_address = explode('-', $basic_info['location']); //分割地址，得到省份/市/县
?>
<div class="wrapper">
    <?php $this->load->view('./templates/navbar'); ?>
    <div class="container" style="margin-top: 100px">
        <div class="row">
            <div class="col-sm-3 col-md-3 ">
                <?php $this->load->view('./user/user_sidebar'); ?>
            </div>

            <div class="col-md-9 col-sm-9">
                <!--登陆信息面板-->
                <div class="panel panel-danger">
                    <div class="panel-heading">
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#login_info_panel" aria-controls="home"
                                                                      role="tab" data-toggle="tab">修改登录账号</a></li>
                            <li role="presentation"><a href="#pwd_panel" aria-controls="profile" role="tab"
                                                       data-toggle="tab">修改密码</a></li>
                        </ul>
                    </div>
                    <div class="panel-body master-profile-panel">
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="login_info_panel">
                                <!--修改手机号码-->
                                <form>
                                    <input type="hidden" name="name" value="mobile">

                                    <div class="form-group">
                                        <label for="master_profile_phone">手机号码</label>
                                        <label id="master_profile_phone_error" style="color: red"></label>
                                        <input type="text" class="form-control" id="master_profile_phone"
                                               name="mobile" onchange="display_phone_block(this)"
                                               data-old="<?php echo $basic_info['mobile']; ?>">
                                    </div>

                                    <div id="submit_phone_block" style="display: none">
                                        <div class="form-group">
                                            <div class="input-group input-group-verification">
                                                <input type="text" class="form-control" id="verification_code"
                                                       name="phone_code"
                                                       placeholder="输入手机收到的验证码">
                                        <span class="input-group-btn">
                                            <button href="#" id="send_code"
                                                    class="btn btn-warning self-btn-danger btn-a-light">发送验证码
                                            </button>
                                        </span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <button type="button" id ="mobile_btn" class="btn btn-warning  btn-round self-btn-danger">
                                                确定
                                            </button>
                                        </div>
                                    </div>
                                </form>
                                <!--修改邮箱-->

                                <form>
                                    <input type="hidden" name="name" value="email">

                                    <div class="form-group">
                                        <label for="master_profile_email">邮箱</label>
                                        <label id="master_profile_email_error" style="color: red"></label>
                                        <input type="email" class="form-control" id="master_profile_email"
                                               name="email"
                                               data-old="<?php echo $basic_info['email']; ?>" required
                                               onchange="display_email_block(this)">
                                    </div>
                                    <div id="submit_email_block" class="form-group" style="display: none">
                                        <button type="button"  id="email_btn" class="btn btn-warning  btn-round self-btn-danger">
                                            确定
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <!--修改登录密码-->
                            <div role="tabpanel" class="tab-pane" id="pwd_panel">
                                <form id="pwd_form" class="form-horizontal">
                                    <input type="hidden" name="name" value="password">

                                    <div class="form-group">
                                        <label for="old_pwd" class="col-sm-4 col-md-4 control-label">旧的登录密码</label>

                                        <div class="col-sm-8 col-md-8">
                                            <input type="password" class="form-control" id="old_pwd">
                                            <a class="basic-info-a" href="#">(忘记密码)</a>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="new_pwd" class="col-sm-4 col-md-4 control-label">新密码</label>

                                        <div class="col-sm-8 col-md-8">
                                            <input type="password" class="form-control" id="new_pwd">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="repeat_pwd" class="col-md-4 col-sm-4 control-label">再次输入新密码</label>

                                        <div class="col-sm-8 col-md-8">
                                            <input type="password" class="form-control" id="conf_pwd">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-offset-4 col-sm-8 col-md-8 col-md-offset-4">
                                            <button type="submit" class="btn btn-danger self-btn-danger">修改密码</button>
                                            <span id="pwd_error_msg" class="self_master_address"></span>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!--基本信息面板-->
                <div class="panel panel-danger">
                    <div class="panel-heading">更改个人基本信息(点击即可修改)</div>
                    <div class="panel-body master-profile-panel">
                        <!--上传头像-->
                        <div>
                            <form action="http://192.168.0.105/modify_info/do_upload" enctype="multipart/form-data"
                                  method="post" onsubmit="return checkCoords();">
                                <p><strong>更换头像(图片文件宽高不得大于500)</strong></p>
                                <a href="#" class="avatar-upload">
                                    <input type="file" id="master-profile-avatar"
                                           name="master-profile-avatar" onchange="read_avatar()">选择文件
                                </a>

                                <div id="display_avatar_div">
                                    <div class="row">
                                        <!--预览图-->
                                        <div class="col-md-7">
                                            <div id="display_avatar_block">
                                                <img id='master-profile-avatar-display'
                                                     name='master-profile-avatar-display' alt="..." src="">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- 表单元素，值为裁剪时获取到的左上角x坐标,y坐标，宽度，高度 -->
                                    <input type="hidden" id="x" name="x">
                                    <input type="hidden" id="y" name="y">
                                    <input type="hidden" id="w" name="w">
                                    <input type="hidden" id="h" name="h">
                                    <!--点击按钮提交表单-->
                                    <button type="submit"
                                            class="btn btn-warning btn-sm self-btn-danger"> 确定裁剪
                                    </button>
                                </div>
                            </form>
                        </div>
                        <!--使用x-editable修改个人基本信息-->
                        <table class="table">
                            <tr>
                                <td width="20%">用户名</td>
                                <td width="80%"><a href="#" id="master_profile_name" name="username"
                                                   data-type="text" data-pk="1" data-url="/post" class="basic-info-a"
                                                   data-title="修改用户名"></a></td>
                            </tr>
                            <tr>
                                <td width="20%">性别</td>
                                <td width="80%"><a href="#" id="master_profile_sex" name="gender" data-type="select"
                                                   data-pk="1"
                                                   data-url="/post" class="basic-info-a" data-title="选择性别"
                                                   data-emptytext="未设置"></a></td>
                            </tr>

                            <tr>
                                <td width="20%">出生年月</td>
                                <td width="80%"><a href="#" id="master_profile_birthday" name="birthday"
                                                   data-type="combodate" class="basic-info-a" data-pk="1"
                                                   data-url="/post" data-title="设置出生年月"></a>
                                </td>
                            </tr>
                            <tr>
                                <td width="20%">居住地</td>
                                <td width="80%">
                                    <!-- 居住地信息以form形式提交-->
                                    <form>
                                        <input type="hidden" name="name" value="location">

                                        <div class="self_master_address">
                                            <span>*</span> 省
                                            <select id="sel_Province" style="width:80px" name="sel_Province"></select>
                                            <span>*</span> 市
                                            <select id="sel_City" name="sel_City"></select>
                                            <span>*</span> 县/区
                                            <select id="sel_County" name="sel_County"></select>
                                            <button type="button" id="address_btn" class="btn btn-danger btn-xs self-btn-danger">
                                                确定
                                            </button>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                            <tr>
                                <td width="20%">机构</td>
                                <td width="80%"><a href="#" id="master_profile_company" name="master_profile_company"
                                                   data-type="text" data-pk="1" data-url="/post" class="basic-info-a"
                                                   data-title="修改所属机构"></a></td>
                            </tr>
                            <tr>
                                <td width="20%">资格证号码</td>
                                <td width="80%"><a href="#" id="master_profile_identification"
                                                   name="master_profile_identification"
                                                   data-type="text" data-pk="1" data-url="/post" class="basic-info-a"
                                                   data-title="修改资格证号码"></a></td>
                            </tr>
                            <tr>
                                <td width="20%">个人简介</td>
                                <td width="80%"><a href="#" id="master_profile_comments"
                                                   name="master_profile_comments"
                                                   data-type="textarea" data-pk="1" class="basic-info-a"
                                                   data-title="编辑个人简介" data-emptytext="未填写"></a></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--.wrapper-->
<?php $this->load->view('./templates/footer'); ?>
<script>
    console.log(111);
    var phone = '<?php echo $basic_info["mobile"]; ?>'; //从session获取手机号
    var email = '<?php echo $basic_info["email"]; ?>'; //从session获取邮箱号
    var username = '<?php echo $basic_info["username"]; ?>'; //从session获取用户名
    var gender = '<?php echo $basic_info["gender"]; ?>'; //从session获取性别
    var birthday = '<?php echo $basic_info["birthday"]; ?>'; //从session获取出生年月
    var institue = '<?php echo $basic_info["institue"]; ?>'; //从session获取机构名称
    var qualification = '<?php echo $basic_info["qualification"]; ?>'; //从session获取资格证号
    var signature = '<?php echo $basic_info["signature"]; ?>'; //从session获取个人简介
    //从session获取地址，设置页面显示时加载的值
    var province = '<?php echo $user_address[0]; ?>'; //获取省份
    var city = '<?php echo $user_address[1]; ?>';     //获取城市
    var county = '<?php echo $user_address[2]; ?>';  //获取县

    $(document).ready(function () {

        //点击修改居住地
        $('#address_btn').click(function () {
            var sel_province = $('#sel_Province').val();
            var sel_city = $('#sel_City').val();
            var sel_county = $('#sel_County').val();
            alert(sel_city);
            $.post('<?php echo base_url("index.php/register/send_code/")?>', {name: 'location',province: sel_province, city: sel_city, county: sel_county});
        });

        //发送手机验证码
        send_code.click(function () {
            if (!count_down) {
                var xmlhttp = new XMLHttpRequest();
                var phone_number = $("#mobile").val();
                xmlhttp.open("GET", '<?php echo base_url("index.php/register/send_code/")?>' + '/web/' + phone_number, true);
                xmlhttp.send();
                countDown(second, speed);
            }
        });

        //点击确定修改手机号码
        $('#mobile_btn').click(function () {
            var phone_num = $('#mobile').val();
            $.post('<?php echo base_url("index.php/register/send_code/")?>',{name : 'mobile', mobile : phone_num}, function (data, status) {
                $("#submit_phone_block").slideUp("slow");
            });
        });
        //点击确定修改邮箱
        $('#email_btn').click(function () {
            var email_num = $('#email').val();
            $.post('<?php echo base_url("index.php/register/send_code/")?>',{name : 'email', email : email_num}, function (data, status) {
                $('#email_btn').slideUp("slow");
            });
        });
    });
    /**
     * Created by tch on 2015/8/31.
     * 理财师个人主页(master_profile)的个人资料页面相关js.
     */
//页面初始化，从后台读取个人信息的值并显示
    $(document).ready(function () {
        alert('hahah');
        //居住地插件初始化
        AreaSelector().init();

        $("#mobile").val(phone); //设置手机号
        $("#email").val(email); //设置邮箱
        $("#username").html(username); //设置用户名
        $("#gender").html(gender); //设置性别
        $("#birthday").html(birthday); //设置生日
        $("#institue").html(institue); //设置机构名称
        $("#qualification").html(qualification); //设置资格证号
        $("#signature").html(signature); //设置个人简介
        // 初始化省份、城市、地区
        AreaSelector().initProvince(province, city, county);
    });

    //发送验证码按钮倒计时一分钟
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


    //验证手机号码是否为11位以及是否修改手机号码，若满足条件则显示验证输入框和提交按钮
    function display_phone_block(id) {
        var txt = $(id).val();
        var submit_phone_block = $("#submit_phone_block");
        //若手机号码不足11位，显示警告信息
        if (txt.length != 11) {
            $("#master_profile_phone_error").html("(请输入11位手机号码)");
            return;
        }
        //若手机号码已经被注册，显示警告信息
        $.get("<?php  echo base_url('/index.php/register/is_exist/web/')?>" + '/' + txt,
            function (data, status) {
                if (data == 'true') {
                    $('#master_profile_phone_error').html('(该号码已注册！)');
                    return false;
                }
            });

        //若手机号码为11位且进行了修改
        if (txt != $(id).data('old')) {
            submit_phone_block.slideDown("slow");
        }
        else if (submit_phone_block.css('display') != 'none') {
            submit_phone_block.slideUp("slow");
        }
    }

    //验证邮箱格式是否正确，根据是否更改邮箱决定是否显示提交按钮
    function display_email_block(id) {
        var email_val = $(id).val();
        var apos = email_val.indexOf("@");
        var dotpos = email_val.lastIndexOf(".");
        var submit_email_block = $("#submit_email_block");
        //邮箱格式不正确，发出警告
        if ((apos < 1 || dotpos - apos < 2) && email_val.length > 0) {
            $('#master_profile_email_error').html('(邮箱格式错误！)');
            return;
        }
        else {
            $('#master_profile_email_error').html('');
        }
        //若更换了邮箱账号，验证该邮箱账号是否和原来一样，不一样就显示提交按钮
        if (email_val != $(id).data('old')) {
            submit_email_block.slideDown("slow");
        }
        else if (submit_email_block.css('display') != 'none') {
            submit_email_block.slideUp("slow");
        }
    }


    //设置全部使用x-editable的组件均为嵌入形式
    $.fn.editable.defaults.mode = 'popup';
    function success (response, newValue){
        if(!response.success) {
            return response.msg;
        }
    }
    function error (response, newValue) {
        return '服务器故障。';
    }
    $(document).ready(function () {

        $('#username').editable({success: success, error: error});
        $('#institue').editable({success: success, error: error});
        $('#qualification').editable({success: success, error: error});
        $('#master_profile_truename').editable({success: success, error: error});
        $('#master_profile_idcard').editable({success: success, error: error});
        //选择性别的x-editable选项
        $('#gender').editable({
            source: [
                {value: 1, text: '男'},
                {value: 0, text: '女'},
            ],
            success: success,
            error: error
        });

        //设置出生日期的x-editable选项
        $('#birthday').editable({
            format: 'YYYY-MM-DD',
            viewformat: 'YYYY/MM/DD',
            template: 'YYYY/MMMM/D',
            combodate: {
                minYear: 1920,
                maxYear: 2015,
                minuteStep: 1
            },
            success: success,
            error: error
        });
        //个人简介的x-editable选项
        $('#signature').editable({
            url: '/post',
            rows: 5,
            success: success,
            error: error
        });
    });

    //显示头像预览图片
    function read_avatar() {
        var display_avatar_div = $("#display_avatar_div");
        var obj = document.getElementById('master-profile-avatar');
        var file = obj.files[0];
        var reader = new FileReader();
        //判断类型是不是图片
        if (!/image\/\w+/.test(file.type)) {
            alert("请确保文件为图像类型");
            return false;
        }
        reader.onload = function (e) {


            $('#display_avatar_block').html('<img id="master-profile-avatar-display" class=" img-responsive"' +
                'name="master-profile-avatar-display"' +
                ' src="' + e.target.result + '" alt="我的头像">');
            $("#master-profile-avatar-display").Jcrop({
                aspectRatio: 1,
                onSelect: updateCoords,
                minSelect: [32, 32], //选框最小选择尺寸。说明：若选框小于该尺寸，则自动取消选择
                maxSize: [300, 300], //选框最大尺寸
            });
            //判断上传的图片文件宽高是否超过限制
            var img = document.getElementById('master-profile-avatar-display');
            var avatar_width = img.width;
            var avatar_height = img.height;
            if (avatar_width > 500) {
                alert("您上传的文件过宽，不得超过500px，请重新选择");
                return false;
            }
            if (avatar_height > 500) {
                alert("您上传的文件过高，不得超过500px，请重新选择");
                return false;
            }
            if (display_avatar_div.css('display') === 'none') {
                display_avatar_div.slideDown("slow");
            }

        };
        reader.readAsDataURL(file);
    }

    //当裁剪框变动时,将左上角相对图片的X坐标与Y坐标,宽度以及高度放到<input type="hidden">中(上传到服务器上裁剪会用到)
    function updateCoords(c) {
        $('#x').val(c.x);
        $('#y').val(c.y);
        $('#w').val(c.w);
        $('#h').val(c.h);
    }
    function checkCoords() {
        if (parseInt($('#w').val())) {
            return true;
        }
        alert('请先选择要裁剪的区域后，再提交。');
        return false;
    }

    //检查密码是否合法,密码长度6-50位
    function validate_pwd(id) {
        var value = $(id).val();
        if (value.length < 6 || value.length > 32) {
            $('#pwd_error_msg').html('(请输入6~32位密码！)');
            return false;
        }
        else {
            $('#pwd_error_msg').html('');
            return true;
        }

    }

    //检查第二次输入的密码是否和第一次一样
    function validate_pwdconf(id) {
        var value = $(id).val();
        if (value != $('#new_pwd').val()) {
            $('#pwd_error_msg').html('(两次输入不一致！)');
            return false
        }
        else {
            $('#pwd_error_msg').html('');
            return true;
        }
    }

    $(document).ready(function () {
        $('#pwd_form').submit(function(){
            if(validate_pwd('#new_pwd') && validate_pwd('#conf_pwd')){
                if(!validate_pwdconf('#conf_pwd')){
                    return false;
                }
            }
            else{
                return false;
            }
        });
    });




</script>
<!--<script src="--><?php //echo base_url('/assets/js/htyjs/master_profile.js') ?><!--"></script>-->
</body>
</html>

