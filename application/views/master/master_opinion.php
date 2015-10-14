<!--理财师主页-->
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="zh-cn">
<?php $this->load->view('./templates/head'); ?>
<body class="bg-gray">
<!--<script src="--><?php //echo base_url('/assets/js/htyjs/general_navbar.js') ?><!--"></script>-->
<?php $this->load->view('./templates/navbar'); ?>
<?php
$view_list = $op_qa['data_page'];
$pages = $op_qa['pagination'];
?>
<div class="wrapper">
    <?php
    $data['info'] = $info;
    $data['is_fan'] = $is_fan;
    $master_id = $info['host_id'];
    $this->load->view('./master/master_jumptron', $data); ?>
    <!--页面主要内容-->
    <div class="container master_homepage_container">
        <div class="col-md-8 col-sm-8 bg-white block-radius">
            <div class="sub_nav">
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" ><a href="<?php echo base_url('index.php/home/load_home/web/' .'master'. '/' . $master_id.'/'.'1');?>" >问答</a></li>
                    <li role="presentation" class="active"><a href="#">观点</a></li>
                    <li role="presentation"><a href="#">示范</a></li>
                    <li role="presentation"><a href="#" >华山论剑</a></li>
                    <li role="presentation"><a href="#" >论坛</a></li>
                </ul>
            </div>
            <div class="tab-content">
                <!--观点-->
                <div  class="tab-pane active" id="viewpoint">
                    <div class="bg-white q_a_container">
                        <?php foreach ($view_list as $view_item): ?>
                            <div class="master_view">
                                <article>
                                    <header>
                                        <h4 class="inline_div"><a href="<?php echo base_url('index.php/home/get_detail/web/' .'op'. '/' . $view_item['op_id']);?>"
                                                                  target="_blank"> <?php echo $view_item['op_title']; ?></a></h4>
                                        <span class="key_word"><?php echo $view_item['op_kwords']; ?></span>
                                    </header>
                                    <section>
                                        <!--控制最多显示内容不超过100个字-->
                                        <p><?php if (strlen($view_item['op_content']) >= 150) {
                                                echo mb_substr($view_item['op_content'], 0, 150, 'utf-8') . '...';
                                            } else {
                                                echo $view_item['op_content'];
                                            }
                                            ?>
                                        </p>
                                    </section>
                                    <section class="view_footer">
                                        <span><?php echo $view_item['op_timestamp']; ?></span>&nbsp;&nbsp;&nbsp;&nbsp;
                                    </section>
                                </article>
                            </div>
                            <hr class="view_hr"/>
                        <?php endforeach; ?>
                        <div class="txt_center"><p class="pages"><?php echo $pages ?></p></div>
                    </div>
                </div>
            </div>
        </div>
        <?php $this->load->view('./templates/right-sidebar'); ?>
    </div>
    <!--悬停go-top按钮-->
    <?php $this->load->view('./templates/go-top'); ?>
</div>
<?php $this->load->view('./templates/footer'); ?>
</body>
</html>