<!--实名认证页面-->
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="zh-cn">
<?php $this->load->view('./templates/head'); ?>
<body>
<div class="wrapper">
    <?php $this->load->view('./templates/navbar'); ?>
    <?php $this->load->view('./templates/jumptron'); ?>
    <div class="container">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-danger">
                <div class="panel-heading">
                    <strong>实名认证</strong>
                </div>
                <div class="panel-body">
                    <div class="col-md-6 col-md-offset-3">
                        <form>
                            <div class="form-group">
                                <label for="real_name">真实姓名</label>
                                <input type="text" class="form-control" id="real_name" placeholder="请填写真实姓名">
                            </div>
                            <div class="form-group">
                                <label for="user_idc">身份证号码 <span id="user_idc_error"
                                                                  class="self_master_address"></span></label>
                                <input type="text" class="form-control" id="user_idc" placeholder="请输入身份证号码">
                            </div>
                            <div class="form-group">
                                <label for="user_idc_pic">上传身份证正面照</label>
                                <input type="file" id="user_idc_pic" onchange="readFile(this)">

                                <p class="help-block">建议使用二代身份证</p>
                            </div>
                            <button type="submit" class="btn btn-danger btn-block self-btn-danger">认证</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="alert alert-warning" role="alert">
                <ul>
                    <li>请填写您本人真实有效的身份信息，一旦认证成功，信息将不可更改。</li>
                    <li>若要入驻成为海天理财师，必须完成实名认证。</li>
                    <li>冒用他人信息是违法行为，海天互联将保留追究其法律责任的权利。</li>
                    <li>请上传您的身份证正面照片，并确保清晰度。</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('./templates/footer'); ?>
</body>
</html>
<script>
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
    }
    //验证身份证号码的有效性
    $(document).ready(function () {
        var user_idc = $('#user_idc'); //获取身份证号码输入框
        var user_idc_error = $('#user_idc_error'); //获取身份证号码输入框
        user_idc.blur(function () {
            var id_num = user_idc.val();
            if (IdCardValidate(id_num) == false && id_num.length > 0) {
                user_idc_error.html('(身份证格式错误！)');
            }
        });
        user_idc.focus(function () {
            user_idc_error.html('');
        });
    });

    var Wi = [7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2, 1];    // 加权因子
    var ValideCode = [1, 0, 10, 9, 8, 7, 6, 5, 4, 3, 2];            // 身份证验证位值.10代表X
    function IdCardValidate(idCard) {
        idCard = trim(idCard.replace(/ /g, ""));               //去掉字符串头尾空格
        if (idCard.length == 18) {
            var a_idCard = idCard.split("");                // 得到身份证数组
            if (isValidityBrithBy18IdCard(idCard) && isTrueValidateCodeBy18IdCard(a_idCard)) {   //进行18位身份证的基本验证和第18位的验证
                return true;
            } else {
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
        for (var i = 0; i < 17; i++) {
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
    function isValidityBrithBy18IdCard(idCard18) {
        var year = idCard18.substring(6, 10);
        var month = idCard18.substring(10, 12);
        var day = idCard18.substring(12, 14);
        var temp_date = new Date(year, parseFloat(month) - 1, parseFloat(day));
        // 这里用getFullYear()获取年份，避免千年虫问题
        if (temp_date.getFullYear() != parseFloat(year)
            || temp_date.getMonth() != parseFloat(month) - 1
            || temp_date.getDate() != parseFloat(day)) {
            return false;
        } else {
            return true;
        }
    }
    //去掉字符串头尾空格
    function trim(str) {
        return str.replace(/(^\s*)|(\s*$)/g, "");
    }

</script>