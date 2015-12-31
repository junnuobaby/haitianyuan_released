<!--理财师主页-->
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="zh-cn">
<?php $this->load->view('./templates/head'); ?>
<body class="bg-gray">
<?php $this->load->view('./templates/navbar'); ?>
<?php
$qa_list = $op_qa['data_page'];
$pages = $op_qa['pagination'];
$user_id = $info['host_id'];
?>
<div class="wrapper">
    <?php
    $data['info'] = $info;
    $this->load->view('./user/user_jumptron', $data);
    ?>
    <div class="container master_homepage_container">
        <div class="col-md-8 col-sm-8 bg-white block-radius user_min_height">
            <?php $menu_view['user_id'] = $user_id; ?>
            <?php $this->load->view('./user/user_menu', $menu_view); ?>
            <div class="tab-content">
                <div class="tab-pane active" id="qa">
                    <div class="bg-white q_a_container">
                        <?php foreach ($qa_list as $qa_item): ?>
                            <div class="q_a">
                                <article>
                                    <h4 class="q_a_question inline_block"><span class="q_a_span">问</span><a href="#"><?php echo $qa_item['question']; ?> </a></h4>
                                    <span>【<?php echo $qa_item['question_time']; ?>】</span>
                                    <p class="q_a_answer"><span class="theme-color">答:</span>&nbsp;&nbsp;<?php echo $qa_item['answer']; ?></p>
                                    <div class="q_a_footer">
                                        <span>满意度：<?php echo $qa_item['star']; ?></span>
                                        <span>回答时间：<?php echo $qa_item['answer_time']; ?></span>
                                    </div>
                                </article>
                            </div>
                            <hr class="q_a_hr"/>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
        <?php $this->load->view('./templates/right-sidebar'); ?>
    </div>
    <?php $this->load->view('./templates/go-top'); ?>
</div>
<?php $this->load->view('./templates/footer'); ?>
</body>
</html>