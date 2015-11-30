<!--首页-->
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
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        欢迎您登陆<strong>海天理财</strong></div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-6 col-sm-6">
                                <img src="<?php echo base_url('/assets/images/weibo_pic1.jpg'); ?>"
                                     alt="..." class="img-rounded img-responsive">
                            </div>

                            <div class="col-md-6 col-sm-6 ">
                                <?php $username_error = form_error('user_name_input'); ?>
                                <?php $password_error = form_error('password_input'); ?>
                                <?php echo form_open('login/login','class="form-horizontal login_form"'); ?>
                                    <div class="form-group <?php echo $username_error ? 'has-error' : ''; ?>">
                                        <label for="weibo_name" class="col-md-3 col-sm-3 control-label">用户名：</label>

                                        <div class="col-md-7 col-sm-7">
                                            <input type="text" class="form-control" id="user_name_input"
                                                   name="user_name_input"
                                                   placeholder="<?php echo $username_error ? $username_error : '用户名/手机号码/邮箱'?>">
                                        </div>
                                    </div>
                                    <div class="form-group <?php echo $password_error ? 'has-error' : ''; ?>">
                                        <label for="weibo_password" class="col-md-3 col-sm-3 control-label">密码：</label>

                                        <div class="col-md-7 col-sm-7">
                                            <input type="password" class="form-control" id="password_input"
                                                   name="password_input" placeholder="<?php echo $password_error ? $password_error :'请输入密码';?>">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-6">

                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class=" col-md-7 col-md-offset-3">
                                            <button type="submit" class="btn btn-block btn-danger">登陆</button>
                                        </div>
                                    </div>
                                </form>

                                <div class="row">
                                    <div
                                        class="col-sm-4 col-sm-offset-6 col-md-4 col-md-offset-6 col-lg-3 col-lg-offset-7">
                                        <a href="#">忘记密码？</a>
                                    </div>
                                </div>


                                <div class="row login_form">
                                    <div class="col-md-7 col-md-offset-3">
                                        <ul class="nav navbar-nav">
                                            <!--qq第三方登陆-->
                                            <li><a href="#">
                                                    <img width="20px" height="20px" src="<?php echo base_url('/assets/images/qq.png'); ?>"
                                                         alt="..." class="img-rounded narbar_li"></a></li>
                                            <!--微博第三方登陆-->
                                            <li><a href="#">
                                                    <img src="<?php echo base_url('/assets/images/weibo.png'); ?>"
                                                         alt="..." class="img-rounded narbar_li"></a></li>
                                            <!--微信第三方登陆-->
                                            <li><a href="#">
                                                    <img src="<?php echo base_url('/assets/images/weixin.jpg'); ?>"
                                                         alt="..." class="img-rounded narbar_li"></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <p>提示：授权后表明你已同意<a href="#" target="_blank"><strong>海天理财登陆服务协议</strong></a></p>
            </div>
        </div>
    </div>
</div>
<!--.wrapper-->
<?php $this->load->view('./templates/footer'); ?>

</body>
</html>
