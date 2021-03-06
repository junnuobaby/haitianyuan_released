<!--理财师主页，显示理财师的问答对-->
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="zh-cn">
<?php $this->load->view('./templates/head', array('title' => '主页')); ?>
<body class="bg-gray">
<?php $this->load->view('./templates/navbar'); ?>
<?php
$qa_list = $op_qa['data_page'];
$pages = $op_qa['pagination'];
$master_id = $info['host_id'];
?>
<div class="wrapper">
    <?php
    $data['info'] = $info;
    $data['is_fan'] = $is_fan;
    $this->load->view('./master/master_jumptron', $data); ?>
    <div class="container master_homepage_container">
        <div class="col-md-8 col-sm-8 bg-white block-radius mas_min_height">
            <?php $menu_view['master_id'] = $master_id; ?>
            <?php $this->load->view('./master/master_menu', $menu_view);?>
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
                                        <span><?php echo $qa_item['qu_timestamp'] ?></span>来自<a href="<?php echo base_url('index.php/home/load_home/web/' . 'user' . '/' . $qa_item['user_id'] . '/' . '1'); ?>" class="questioner"><?php echo $qa_item['questioner'] ?></a>
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
                        <div class="text-center"><p class="pages"><?php echo $pages ?></p></div>
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