<!--普通用户购买的VIP-->
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="zh-cn">
<?php $this->load->view('./templates/head'); ?>
<?php
$vips = $master_info;
?>
<body class="bg-gray">
<script src="<?php echo base_url('/assets/js/htyjs/general_navbar.js') ?>"></script>
<div class="wrapper">
    <?php $this->load->view('./templates/navbar'); ?>
    <div class="container container_to_top">
        <div class="row">
            <div class="col-sm-3 col-md-3 ">
                <?php $this->load->view('./user/user_sidebar'); ?>
            </div>
            <div class="col-sm-9 col-md-9 bg-white block-radius set_price user_min_height">
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <h3 class="panel-title">我的理财师</h3>
                    </div>
                    <div class="panel-body">
                        <?php if (count($vips) < 1): ?>
                            <h4 class="alert_info">
                                亲，您还没有定制成为任何理财师的VIP用户哟！</h4>
                        <?php else: ?>
                            <?php foreach ($vips as $vip): ?>
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="master_avatar_box">
                                            <img
                                                src="<?php echo base_url('/uploads/' . $vip['face_pic']); ?>"
                                                class="img-responsive img-circle" alt="...">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <h4>
                                            <a href="<?php echo base_url('index.php/home/load_home/web/' . 'master' . '/' . $vip['master_id'] . '/' . '1'); ?>"
                                               target="_blank"
                                               class="theme-color"><?php echo $vip['master_name']; ?></a></h4>

                                        <p>关注 <?php echo $vip['concerns_count']; ?> |
                                            粉丝 <?php echo $vip['fans_count']; ?>
                                            | <?php if ($vip['online_state'] == true) {
                                                echo '在线';
                                            } else {
                                                echo "离线";
                                            } ?></p>

                                        <p>个性签名：<?php echo $vip['signature']; ?></p>
                                    </div>
                                    <div class="col-md-4">
                                        <a class="btn  bg-theme qu_btn_id" data-id="<?php echo $vip['master_id'];?>" data-name="<?php echo $vip['master_name'];?>">
                                            <span class="glyphicon glyphicon-question-sign"></span> 提问
                                        </a>
                                    </div>
                                </div>
                                <hr class="qu_hr"/>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--提问的模态框-->
<div class="modal fade" id="question_modal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="panel panel-success">
                    <div class="panel-heading">输入问题（不超过500字）</div>
                    <div class="panel-body">
                        <form>
                            <textarea class="ta" id="my_question" name="question" rows="5"
                                      placeholder="请尽可能准确地描述您的问题"></textarea>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                <button type="button" id="qa_btn" class="btn btn-success">确定</button>
            </div>
        </div>
    </div>
</div>
<!--悬停go-top按钮-->
<?php $this->load->view('./templates/go-top'); ?>
<?php $this->load->view('./templates/footer'); ?>
</body>
<script>
    $(document).ready(function () {
        /* 让提问的模态框居中 */
        function centerModals() {
            $('.modal').each(function (i) {
                var $clone = $(this).clone().css('display', 'block').appendTo('body');
                var top = Math.round(($clone.height() - $clone.find('.modal-content').height()) / 2);
                top = top > 0 ? top : 0;
                $clone.remove();
                $(this).find('.modal-content').css("margin-top", top);
            });
        }

        $('#question_modal').on('show.bs.modal', centerModals);
        $(window).on('resize', centerModals);
    });
    $(document).ready(function () {
        //点击提问按钮触发的事件
        $('.qu_btn_id').click(function () {
            var state;
            var master_id = $(this).data('id');
            var username = $(this).data('name');
            $.get('<?php echo base_url("index.php/qa/qu_state")?>' + '/' + master_id, function (data, status) {
                state = data;
                if (state == '0') {
                    var qa_btn = $('#qa_btn');
                    $('#question_modal').modal();
                    qa_btn.data('id',master_id);
                    qa_btn.data('name',username);
                } else if (state == '1') {
                    location.href = "<?php echo base_url('index.php/login')?>";
                } else if (state == '2') {
                    if (confirm("只有VIP才能提问，是否升级成为VIP？")) {
                        location.href = "<?php echo base_url('index.php/qa/index')?>" + '/' +master_id +'/' + username ;
                    }
                } else {
                    alert('不能向自己提问');
                }
            });
        });
        //编辑完问题后点击确定按钮触发的事件
        $('#qa_btn').click(function () {
            var content = $('#my_question').val();
            var master_id = $(this).data('id');
            var master_name = $(this).data('name');
            var data = {master_id: master_id, master_name: master_name, qu_content: content, kwords: null};
            $.post('<?php echo base_url("index.php/qa/add_qu")?>', data);
            $('#question_modal').modal('hide');
        });
    });
</script>
</html>

