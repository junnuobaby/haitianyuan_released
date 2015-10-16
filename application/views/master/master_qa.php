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
//$qu_num = count($undo);
//$qu_answered_num = count($done);
//$qa_list = $done;
$qu_undo_array = $undo['data_page'];
$qu_num = $undo['count'];
$pages = $undo['pagination'];
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
                        <li role="presentation" class="active" id="answer_btn_li"><a href="#qa_undo_list" role="tab"
                                                                                     data-toggle="tab">待回答 <span
                                    class="badge green-color"><?php echo $qu_num ?></span></a>
                        </li>
                        <li role="presentation" id="answered_btn_li"><a href="#qa_done" id="answered_btn"
                                                                        aria-controls="profile" role="tab"
                                                                        data-toggle="tab">已解决
                                <span class="badge theme-bg-color" id="answered_num"></span></a>
                        </li>

                    </ul>

                    <div class="tab-content">
                        <!--待回答问题-->
                        <div role="tabpanel" class="tab-pane active" id="qa_undo_list">
                            <?php if (count($qu_undo_array) < 1): ?>
                                <h4 class="alert_info">没有问题需要回答！</h4>
                            <?php else: ?>
                                <?php foreach ($qu_undo_array as $qu_undo_item): ?>
                                    <div class="qu_margin">
                                        <div class="qu_time">
                                            <span><?php echo $qu_undo_item['qu_timestamp'] ?></span>来自<a href="#"
                                                                                                         class="questioner"><?php echo $qu_undo_item['questioner'] ?></a>
                                        </div>
                                        <p><span class="q_a_span">问</span><?php echo $qu_undo_item['qu_content'] ?></p>

                                        <div class="qu_line_height">
                                            <span class="key_word"><?php if($qu_undo_item['kwords'] == ''){echo '暂无标签';}else{echo $qu_undo_item['kwords'];} ?></span>
                                            <button class="btn qu_btn"
                                                    id="<?php echo 'qu_btn_' . $qu_undo_item['qu_id']; ?>" type="button"
                                                    data-toggle="collapse"
                                                    data-target="<?php echo '#edit_answer_' . $qu_undo_item['qu_id']; ?>"
                                                    aria-expanded="false"
                                                    aria-controls="collapseExample">回答

                                            </button>
                                            <div class="collapse"
                                                 id="<?php echo 'edit_answer_' . $qu_undo_item['qu_id']; ?>">
                                                <div class="well">
                                                <textarea class="ta"
                                                          id="<?php echo 'answer_' . $qu_undo_item['qu_id']; ?>">
                                                    </textarea>
                                                    <button class="btn btn-default btn_cancel"
                                                            onclick="btn_cancel('<?php echo $qu_undo_item['qu_id'] ?>')">
                                                        取消
                                                    </button>
                                                    <button class="btn btn- default"
                                                            onclick="send_answer('<?php echo $qu_undo_item['qu_id'] ?>')">
                                                        确定
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr class="qu_hr"/>
                                <?php endforeach; ?>
                                <div class="txt_center"><p class="pages"><?php echo $pages ?></p></div>
                            <?php endif; ?>
                        </div>

                        <!--已回答问题-->
                        <div role="tabpanel" class="tab-pane" id="qa_done">
                            <h4 class="alert_info warning_msg"></h4>
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
<script>
    //    点击确定按钮，通过ajax将回答发送至后台
    function send_answer(id) {
        var answer_div = 'answer_' + id;
        var answer = document.getElementById(answer_div).value;
        var ans_collapse = document.getElementById('edit_answer_' + id);
        var ans_btn = document.getElementById('qu_btn_' + id);
        $.post("<?php echo base_url('/index.php/qa/add_ans') ?>", {qu_id: id, ans_content: answer});
        $(ans_collapse).collapse('hide');
        //动态变化
        ans_btn.innerHTML = '已回答';
    }
    //设置取消按钮事件
    function btn_cancel(id) {
        var ans_collapse = document.getElementById('edit_answer_' + id);
        $(ans_collapse).collapse('hide');
    }
    $(document).ready(function () {
        $('#answered_btn').click(
            function () {
                $.ajax(
                    {
                        url: "<?php echo base_url('modify_info/get_questions/web/done');?>",
                        method: 'get',
                        dataType: "json",
                        success: function (data) {
                            alert(data);
                            var qa_response = data["done"];
                            var qa_done = qa_response['data_page'];
                            var len = qa_done.length;
                            var pages = qa_response['pagination'];
                            if (qa_response['count'] == 0) {
                                $('.warning_msg').html('您还没有回答任何问题!');
                            }
                            else {
                                for (var i = 0; i < len; i++) {
                                    content += '<div class="q_a qu_margin">' +
                                        '<article>' +
                                        '<h4 class="q_a_question inline_block">' +
                                        '<span class="q_a_span">问</span>' +
                                        '<a href="#">' + qa_done[i]['qu_content'] + '</a></h4>' +
                                        '<span class="qu_time">【' + qa_done[i]['qu_timestamp'] + '】</span>' +
                                        '<p class="q_a_answer"><span class="theme-color">答:</span>&nbsp;&nbsp;' +
                                        qa_done[i]['ans_content'] + '</p>' +
                                        '<div class="q_a_footer">' +
                                        '<span>提问者：' + qa_done[i]['questioner'] + '</span>' +
                                        '<span>回答时间：' + qa_done[i]['ans_timestamp'] + '</span>' +
                                        '</div>' +
                                        '</article>' +
                                        '</div>' + '<hr class="q_a_hr"/>';
                                }
                                content += '<div class="txt_center">' + '<p class="pages">' + pages + '</p></div>';
                            }
                            $('#qa_done').html(content);
                        },
                    });
            });
    });

</script>
</body>
</html>

