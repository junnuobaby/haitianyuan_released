<!--理财师个人中心页面-->
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="zh-cn">
<?php $this->load->view('./templates/head'); ?>
<body class="bg-gray">
<script src="<?php echo base_url('/assets/js/htyjs/general_navbar.js') ?>"></script>
<?php
$qa_list = $done['data_page'];
$qa_num = $done['count'];
$pages = $done['pagination'];
?>
<div class="wrapper">
    <?php $this->load->view('./templates/navbar'); ?>
    <div class="container container_to_top">
        <div class="row">
            <div class="col-sm-3 col-md-3 ">
                <?php $this->load->view('./user/user_sidebar'); ?>
            </div>
            <div class="col-sm-9 col-md-9 bg-white block-radius user_min_height">
                <div class="sub_nav">
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation"><a href="<?php echo base_url('index.php/modify_info/get_questions/web/undo'); ?>">未解决 </a>
                        </li>
                        <li role="presentation"  class="active"><a href="#qa_done" aria-controls="profile" role="tab" data-toggle="tab">已解决
                                <span class="badge theme-bg-color"><?php echo $qa_num ?></span></a>
                        </li>

                    </ul>

                    <div class="tab-content">
                        <!--已回答问题-->
                        <div role="tabpanel" class="tab-pane active" id="qa_done">
                            <?php foreach ($qa_list as $qa_item): ?>
                                <div class="q_a qu_margin">
                                    <article>
                                        <h4 class="q_a_question inline_block">
                                            <span class="q_a_span">问</span>
                                            <a href="#"><?php echo $qa_item['question']; ?> </a></h4>
                                        <span class="qu_time">【<?php echo $qa_item['question_time']; ?>】</span>

                                        <p class="q_a_answer"><span
                                                class="theme-color">答:</span>&nbsp;&nbsp;<?php echo $qa_item['answer']; ?>
                                        </p>
                                        <div class="q_a_footer">
                                            <span>回答时间：<?php echo $qa_item['answer_time']; ?></span>
                                            <span>回答者：<a href="#"
                                                         class="questioner"><?php echo $qa_item['answer_master']; ?></a></span>
                                        </div>
                                    </article>
                                </div>
                                <hr class="q_a_hr"/>
                            <?php endforeach; ?>
                            <div class="txt_center"><p class="pages"><?php echo $pages ?></p></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--.wrapper-->
<!--悬停go-top按钮-->
<?php $this->load->view('./templates/go-top'); ?>
<?php $this->load->view('./templates/footer'); ?>
</body>
</html>

