<!--实名认证页面1-->
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="zh-cn">
<?php $this->load->view('./templates/head'); ?>
<?php $state = $auth_state; ?>
<body>
<div class="wrapper">
    <?php $this->load->view('./templates/navbar'); ?>
    <div class="container">
        <div class="master-enter-status">
            <div class="master-enter-status-timeline">
                <div class="master-enter-status-timeline-completion
                <?php if($state == 0){
                    echo 'c1';
                } elseif($state == 1){
                    echo 'c2';
                } elseif($auth_state == 2) {
                    echo 'c3';
                } ?>"></div>
            </div>
            <div class="image-master-enter-status image-master-enter-status-register active img-circle">
                <span class="status">成为海天会员</span>
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
            <!-- step_1-->
            <?php if($state == 0):?>
            <div class="panel panel-danger">
                <div class="panel-heading">
                    <strong>实名认证</strong>
                </div>
                <div class="panel-body">
                    <div class="col-md-10 col-md-offset-1">
                        <form  class="form-horizontal">
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-3 control-label">擅长领域</label>
                                <div class="col-sm-6">
                                    <input type="email" class="form-control" name="advantage" id="advantage" placeholder="擅长领域" required>
                                </div>
                                <span class="text-danger">必填</span>
                            </div>
                            <div class="form-group">
                                <label for="company" class="col-sm-3 control-label">所在公司</label>
                                <div class="col-sm-6">
                                    <input type="email" class="form-control" name="company" id="company" placeholder="所在公司" required>
                                </div>
                                <span class="text-danger">必填</span>
                            </div>
                            <div class="form-group">
                                <label for="certificate" class="col-sm-3 control-label">资格证号码</label>
                                <div class="col-sm-6">
                                    <input type="email" class="form-control"  name="certificate" id="certificate" placeholder="资格号码">
                                    <p class="text-danger">该号已存在</p>
                                </div>
                                <span>选填</span>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-3 control-label">真实姓名</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="real_name" id="real_name" placeholder="请填写身份证上的真实姓名" required>
                                </div>
                                <span class="text-danger">必填</span>
                            </div>
                            <div class="form-group">
                                <label for="user_idc" class="col-sm-3 control-label">身份证号码</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="user_idc" id="user_idc" placeholder="请输入身份证号码" required>
                                    <p class="text-danger">该号已存在</p>
                                </div>
                                <span class="text-danger">必填</span>
                            </div>
                            <div class="form-group">
                                <label for="user_idc_pic"  class="col-sm-3 control-label">上传身份证照</label>
                                <div class="col-sm-6">
                                    <input type="file" name="user_idc_pic" id="user_idc_pic" onchange="readFile(this)" required>
                                    <p class="help-block">请提交身份证正面照片</p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"></label>
                                <div class="col-sm-6">
                                    <button type="submit" class="btn  btn-block bg-theme">提交</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="alert alert-warning" role="alert">
                <ul class="ht_indent">
                    <li>因涉及金钱，请确保信息的真实性，海天互联承诺保障您的隐私。</li>
                    <li>请填写您本人真实有效的身份信息，一旦认证成功，信息将不可更改。</li>
                    <li>为保障您的合法权益，请完成实名认证。</li>
                    <li>冒用他人信息是违法行为，海天互联将保留追究其法律责任的权利。</li>
                    <li>请上传您的身份证正面照片，并确保清晰度。</li>
                </ul>
            </div>
            <?php endif;?>
            <!-- step_2-->
            <?php if($state == 1):?>
                <div class="well">
                    <h3>审核中，<small> 请耐心等待......</small></h3>
                    <h5 class="grey-color">可点击导航栏中理财师入驻按钮随时查看进度</h5>
                </div>
            <?php endif;?>
            <!-- step_4-->
            <?php if($state == 2):?>
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
            <?php endif;?>
        </div>
    </div>
</div>
<?php $this->load->view('./templates/footer'); ?>
</body>
</html>
<style>
    .image-master-enter-status-register .icon{
        background-image: url("<?php echo base_url('assets/images/settle/step_1.png'); ?>");
    }
    .image-master-enter-status-information .icon {
        background-image: url("<?php echo base_url('assets/images/settle/step_2.png'); ?>");
    }
    .image-master-enter-status-realname .icon {
        background-image: url("<?php echo base_url('assets/images/settle/step_3.png'); ?>");
    }
    .image-master-enter-status-completed .icon {
        background-image: url("<?php echo base_url('assets/images/settle/step_4.png'); ?>");
    }
</style>
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