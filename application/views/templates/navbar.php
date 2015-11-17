<!--导航栏-->
<nav class="navbar navbar-default navbar-fixed-top" xmlns="http://www.w3.org/1999/html" id="navbar">
    <div class="container">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo base_url('/index.php/index') ?>">首页</a>
            </div>

            <div class="collapse navbar-collapse narbar_font_size">
                <ul class="nav navbar-nav">
                    <li><a href="#">理财室</a></li>
                    <li><a href="<?php echo base_url('/index.php/stock/index/web/1/1');?>">华山论剑</a></li>
                    <li><a href="#">知识服务</a></li>
                    <li><a href="#">论坛</a></li>
                </ul>

                <!--根据是否登陆导航条显示不同的内容，当前默认为未登录-->
                <?php $login_state = $this->session->userdata('login_state'); ?>
                <?php $identity = $this->session->userdata('identity') == '0' ? 'user' : 'master'; ?>
                <?php $uuid = $this->session->userdata('uuid'); ?>
                <?php $signature = $this->session->userdata('signature'); ?>
                <?php if ($login_state == false): ?>
                    <div class="navbar-form navbar-right ">
                        <a href="<?php echo base_url('/index.php/login') ?>">
                            <input class="btn btn-danger" type="button" id="login" value="登陆"/></a>
                        <a href="<?php echo base_url('/index.php/register') ?>">
                            <input class="btn btn-danger" type="button" id="register" value="注册"/></a>
                    </div>

                <?php else: ?>
                    <!--登陆成功后导航条上显示的内容-->
                    <ul class="nav navbar-nav navbar-right gen_font_size">
                        <!--用户的个人主页-->
                        <?php if ($identity == 'master'): ?>
                            <li>
                                <a id="sel_center" href="<?php echo base_url('index.php/home/load_home/web/' . $identity . '/' . $uuid . '/' . '1'); ?>"><span class="glyphicon glyphicon-home"></span> 我的主页</a>
                            </li>
                        <?php else: ?>
                        <?php endif; ?>
                        <!--个人空间-->
                        <li><a id="sel_homepage" href="<?php echo base_url('index.php/my_center/index'); ?>"><span class="glyphicon glyphicon-user"></span> 个人中心</a></li>
                        <!--显示用户名-->
                        <li class="dropdown">
                            <a id='navbar-username' href="#" class="dropdown-toggle" data-toggle="dropdown"
                               role="button"
                               aria-haspopup="true" aria-expanded="false">
                                <?php echo $this->session->userdata('username'); ?><span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="#">我的私信</a></li>
                                <li><a href="#">我的收藏</a></li>
                                <li><a href="#">我的钱包</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="#">设置</a></li>
                                <li><a href="<?php echo base_url("index.php/login/logout"); ?>">退出</a></li>
                            </ul>
                        </li>
                    </ul>
                <?php endif; ?>
            </div>
        </div>
    </div>
</nav>
<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>

