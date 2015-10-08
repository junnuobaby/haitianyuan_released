/**
 * Created by tangchaohong on 2015/8/12.
 * 对用户填写的信息页面内容进行前台验证
 */

//处理上传的身份证照片，转为base64
function readFile(obj) {
    var file = obj.files[0];
    //判断类型是不是图片
    if (!/image\/\w+/.test(file.type)) {
        alert("请确保文件为图像类型");
        return false;
    }
    var reader = new FileReader();
    reader.readAsDataURL(file);
    reader.onload = function (e) {
        alert(this.result); //就是base64
        $('#base64_pic').val(this.result);
    }
}


$('#myTabs a').click(function (e) {
    e.preventDefault()
    $(this).tab('show')
})


//onfocus触发时，隐藏提示语
function hide_tips(id) {
    $('#' + id + '_error').html('');
}

//    用户名格式验证，用户名可以为中文，字母，数字和下划线的组成，但不能以数字开头
function validate_id(field, id) {
    with (field) {
        var result = new RegExp("^[a-zA-Z\u4e00-\u9fa5][0-9a-zA-Z\u4e00-\u9fa5]*");
        if (!result.test(value) && value.length > 0) {
            $('#' + id + '_error').html('(用户名格式错误！)');
        }
        else {
            $('#' + id + '_error').html('');
        }
    }
}


//    e-mail 格式验证
function validate_email(field, id) {
    var apos = field.value.indexOf("@");
    var dotpos = field.value.lastIndexOf(".");
    if ((apos < 1 || dotpos - apos < 2) && field.value.length > 0) {
        $('#' + id + '_email_error').html('(邮箱格式错误！)');
    }
    else {
        $('#' + id + '_email_error').html('');
    }
}


//验证身份证的有效性
$(document).ready(function () {
    $('#master_idc').blur(function () {
        id_num = $('#master_idc').val();
        if(IdCardValidate(id_num) == false && id_num.length > 0){
            $('#master_idc_error').html('(身份证格式错误！)');
        }
    });
    $('#master_idc').focus(function (){
        hide_tips('master_idc');
    });
});

var Wi = [ 7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2, 1 ];    // 加权因子
var ValideCode = [ 1, 0, 10, 9, 8, 7, 6, 5, 4, 3, 2 ];            // 身份证验证位值.10代表X
function IdCardValidate(idCard) {
    idCard = trim(idCard.replace(/ /g, ""));               //去掉字符串头尾空格
    if (idCard.length == 18) {
        var a_idCard = idCard.split("");                // 得到身份证数组
        if(isValidityBrithBy18IdCard(idCard)&&isTrueValidateCodeBy18IdCard(a_idCard)){   //进行18位身份证的基本验证和第18位的验证
            return true;
        }else {
            return false;
        }
    } else {
        return false;
    }
}
/**
 * 判断身份证号码为18位时最后的验证位是否正确
 * @param a_idCard 身份证号码数组
 * @return
 */
function isTrueValidateCodeBy18IdCard(a_idCard) {
    var sum = 0;                             // 声明加权求和变量
    if (a_idCard[17].toLowerCase() == 'x') {
        a_idCard[17] = 10;                    // 将最后位为x的验证码替换为10方便后续操作
    }
    for ( var i = 0; i < 17; i++) {
        sum += Wi[i] * a_idCard[i];            // 加权求和
    }
    valCodePosition = sum % 11;                // 得到验证码所位置
    if (a_idCard[17] == ValideCode[valCodePosition]) {
        return true;
    } else {
        return false;
    }
}
/**
 * 验证18位数身份证号码中的生日是否是有效生日
 * @param idCard 18位书身份证字符串
 * @return
 */
function isValidityBrithBy18IdCard(idCard18){
    var year =  idCard18.substring(6,10);
    var month = idCard18.substring(10,12);
    var day = idCard18.substring(12,14);
    var temp_date = new Date(year,parseFloat(month)-1,parseFloat(day));
    // 这里用getFullYear()获取年份，避免千年虫问题
    if(temp_date.getFullYear()!=parseFloat(year)
        ||temp_date.getMonth()!=parseFloat(month)-1
        ||temp_date.getDate()!=parseFloat(day)){
        return false;
    }else{
        return true;
    }
}
//去掉字符串头尾空格
function trim(str) {
    return str.replace(/(^\s*)|(\s*$)/g, "");
}
