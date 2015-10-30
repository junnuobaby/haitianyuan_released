<!--理财师个人中心，已回答问题页面-->
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
                <?php $this->load->view('./master/master_sidebar'); ?>
            </div>
            <div class="col-sm-9 col-md-9 bg-white block-radius mas_min_height">
                <div class="sub_nav">
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" id="answer_btn_li"><a
                                href="<?php echo base_url('modify_info/get_questions/web/undo'); ?>">待回答 </a>
                        </li>
                        <li role="presentation" class="active" id="answered_btn_li"><a href="#qa_done" id="answered_btn"
                                                                                       aria-controls="profile"
                                                                                       role="tab"
                                                                                       data-toggle="tab">已解决
                                <span
                                    class="badge green-bg-color"><?php echo $qa_num; ?></span></a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <!--已回答问题-->
                        <div role="tabpanel" class="tab-pane active" id="qa_done">
                            <?php if ($qa_num < 1): ?>
                                <h4 class="alert_info">您还没有回答任何问题</h4>
                            <?php else: ?>
                                <?php foreach ($qa_list as $qa_item): ?>
                                    <div class="q_a qu_margin">
                                        <article>
                                            <h4 class="q_a_question inline_block">
                                                <span class="q_a_span">问</span>
                                                <a href="#"><?php echo $qa_item['qu_content']; ?> </a></h4>
                                            <div class="qu_time">
                                                <span><?php echo $qa_item['qu_timestamp'] ?></span>来自
                                                <a href="#" class="questioner"><?php echo $qa_item['questioner'] ?></a>
                                                <span class="key_word"><?php if ($qa_item['kwords'] == '') {
                                                        echo '暂无标签';
                                                    } else {
                                                        echo $qa_item['kwords'];
                                                    } ?></span>
                                            </div>
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
                                <div class="txt_center"><p class="pages"><?php echo $pages ?></p></div>
                            <?php endif; ?>
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

