/**
 * Created by tch on 2015/8/31.
 * 理财师个人主页(master_profile)的个人资料页面相关js.
 */
//页面初始化，从后台读取个人信息的值并显示
$(document).ready(function () {
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


