<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="zh-cn">
<?php $this->load->view('./templates/head', array('title' => '主页')); ?>
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
                                    <h4 class="q_a_question ">
                                        <span class="q_a_span">问</span>
                                        <a href="#"><?php echo $qa_item['qu_content']; ?> </a></h4>
                                    <div class="qu_time">
                                        <span><?php echo $qa_item['qu_timestamp'] ?></span>向<a href="<?php echo base_url('index.php/home/load_home/web/' . 'master' . '/' . $qa_item['master_id'] . '/' . '1'); ?>" class="questioner"><?php echo $qa_item['answerer'];?></a> 提问
                                    <span class="key_word"><?php if ($qa_item['kwords'] == '') {
                                            echo '暂无标签';
                                        } else {
                                            echo $qa_item['kwords'];
                                        } ?></span>
                                    </div>
                                    <p class="q_a_answer"><span class="theme-color">答:</span>&nbsp;&nbsp;<?php echo $qa_item['ans_content']; ?></p>
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
            </div>
        </div>
        <?php $this->load->view('./templates/right-sidebar'); ?>
    </div>
    <?php $this->load->view('./templates/go-top'); ?>
</div>
<?php $this->load->view('./templates/footer'); ?>
</body>
</html>