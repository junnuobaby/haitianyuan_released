<!--普通用户提出还未解决的问题-->
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="zh-cn">
<?php $this->load->view('./templates/head'); ?>
<body class="bg-gray">
<script src="<?php echo base_url('/assets/js/htyjs/general_navbar.js') ?>"></script>
<?php
$qu_undo_array = $undo['data_page'];
$qu_num = $undo['count'];
$pages = $undo['pagination'];
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
                        <li role="presentation" class="active"><a href="#qa_undo_list" role="tab"
                                                                  data-toggle="tab">未解决 <span
                                    class="badge green-color"><?php echo $qu_num ?></span></a>
                        </li>
                        <li role="presentation"><a href="<?php echo base_url('index.php/modify_info/get_questions/web/done'); ?>">已解决</a>
                        </li>

                    </ul>

                    <div class="tab-content">
                        <!--待回答问题-->
                        <div role="tabpanel" class="tab-pane active" id="qa_undo_list">
                            <?php foreach ($qu_undo_array as $qu_undo_item): ?>
                                <div class="qu_margin">
                                    <div class="qu_time">
                                        <span><?php echo $qu_undo_item['qu_timestamp'] ?></span> 您向<a href="#"
                                                                                                     class="questioner"><?php echo $qu_undo_item['answerer'] ?></a> 提问
                                    </div>
                                    <p><span class="q_a_span">问</span><?php echo $qu_undo_item['qu_content'] ?></p>
                                </div>
                                <hr class="qu_hr"/>
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

