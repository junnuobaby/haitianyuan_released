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
$master_id = $info['host_id'];
?>
<div class="wrapper">
    <?php
    $data['info'] = $info;
    $data['is_fan'] = $is_fan;
    $this->load->view('./master/master_jumptron', $data); ?>
    <!--页面主要内容-->
    <div class="container master_homepage_container">
        <div class="col-md-8 col-sm-8 bg-white block-radius">
            <div class="sub_nav">
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#qa">问答哈哈哈哈</a></li>
                    <li role="presentation"><a href="<?php echo base_url('index.php/home/load_home/web/' . 'master' . '/' . $master_id . '/' . '2'); ?>">观点</a>
                    </li>
                    <li role="presentation"><a href="#">示范</a></li>
                    <li role="presentation"><a href="#">华山论剑</a></li>
                    <li role="presentation"><a href="#">论坛</a></li>
                </ul>
            </div>
            <div class="tab-content">
                <!--问答-->
                <div class="tab-pane active" id="qa">
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