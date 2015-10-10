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
$qa_list = $qa;
$master_id = $info['host_id'];
$username = $info['username'];
$face_pic = $info['face_pic'];
$online_state = $info['online_state'];
$concerns_count = $info['concerns_count'];
$fans_count = $info['fans_count'];
$vips_count = $info['vips_count'];
$questions_count = $info['questions_count'];
$satisfication_rate = $info['satisfication_rate'];
$response_time = $info['response_time'];
$signature = $info['signature'];
$view_list = $op;
?>
<div class="wrapper">
    <?php $this->load->view('./templates/navbar'); ?>
    <?php $this->load->view('./master/master_jumptron'); ?>
    <!--页面主要内容-->
    <div class="container master_homepage_container">
        <div class="col-md-8 col-sm-8 bg-white block-radius">
            <div class="sub_nav">
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#qa" role="tab" data-toggle="tab">问答</a></li>
                    <li role="presentation"><a href="#viewpoint" role="tab" data-toggle="tab">观点</a></li>
                    <li role="presentation"><a href="#demonstration" role="tab" data-toggle="tab">示范</a></li>
                    <li role="presentation"><a href="#contest" role="tab" data-toggle="tab">华山论剑</a></li>
                    <li role="presentation"><a href="#bbs" role="tab" data-toggle="tab">论坛</a></li>
                </ul>
            </div>
            <div class="tab-content">
                <!--问答-->
                <div role="tabpanel" class="tab-pane active" id="qa">
                    <div class="bg-white q_a_container">
                        <?php foreach ($qa_list as $qa_item): ?>
                            <div class="q_a">
                                <article>
                                    <h4 class="q_a_question inline_block">
                                        <span class="theme-color">问</span>
                                        <a href="#"><?php echo $qa_item['qu_content']; ?> </a></h4>
                                    <span>【<?php echo $qa_item['qu_timestamp']; ?>】</span>

                                    <p class="q_a_answer"><span
                                            class="theme-color">答:</span>&nbsp;&nbsp;<?php echo $qa_item['ans_content']; ?>
                                    </p>

                                    <div class="q_a_footer">
                                        <span>满意度：<?php echo 5; ?></span>
                                        <span>回答时间：<?php echo $qa_item['ans_timestamp']; ?></span>
                                    </div>
                                </article>
                            </div>
                            <hr class="q_a_hr"/>
                        <?php endforeach; ?>
                    </div>
                </div>
                <!--观点-->
                <div role="tabpanel" class="tab-pane" id="viewpoint">
                    <div class="bg-white q_a_container">
                        <?php foreach ($view_list as $view_item): ?>
                            <div class="master_view">
                                <article>
                                    <header>
                                        <h4 class="inline_div"><a href="#"
                                                                  target="_blank"> <?php echo $view_item['op_title']; ?></a>
                                        </h4>
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
                    </div>
                </div>
                <!--示范-->
                <div role="tabpanel" class="tab-pane" id="demonstration">...</div>
                <!--华山论剑+-->
                <div role="tabpanel" class="tab-pane" id="contest">...</div>
                <!--论坛-->
                <div role="tabpanel" class="tab-pane" id="bbs">...</div>
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