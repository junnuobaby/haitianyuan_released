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
$view_list = $op_qa['data_page'];
$pages = $op_qa['pagination'];
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
                    <li role="presentation" ><a href="<?php echo base_url('index.php/home/load_home/web/' .'master'. '/' . $master_id.'/'.'1');?>" >问答</a></li>
                    <li role="presentation" class="active"><a href="#">观点</a></li>
                    <li role="presentation"><a href="#">示范</a></li>
                    <li role="presentation"><a href="#" >华山论剑</a></li>
                    <li role="presentation"><a href="#" >论坛</a></li>
                </ul>
            </div>
            <div class="tab-content">
                <!--观点-->
                <div  class="tab-pane active" id="viewpoint">
                    <div class="bg-white q_a_container">
                        <?php foreach ($view_list as $view_item): ?>
                            <div class="master_view">
                                <article>
                                    <header>
                                        <h4 class="inline_div"><a href="#"
                                                                  target="_blank"> <?php echo $view_item['op_title']; ?></a></h4>
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
                        <p class="pagination"><?php echo $pages ?></p>
                    </div>
                </div>
            </div>
        </div>
        <?php $this->load->view('./templates/right-sidebar'); ?>
    </div>
    <!--悬停go-top按钮-->
    <?php $this->load->view('./templates/go-top'); ?>
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
                            <textarea class="ta" id="my_question" name="question" rows="5" placeholder="请尽可能准确地描述您的问题"></textarea>
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
<?php $this->load->view('./templates/footer'); ?>
</body>
<script>
    $(document).ready(function () {
        $('.master_homepage_jumptron').css('background-image', 'url("<?php echo base_url('assets/images/jumptron_background.jpg'); ?>")');
        /* 让模态框居中 */
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
    $(document).ready(function(){
        $('#qa_btn').click(function () {
            var content = $('#my_question').val();
            var master_id = "<?php echo $master_id;?>";
            var master_name = "<?php echo $username;?>";
            var data = { master_id : master_id, master_name : master_name, qu_content : content , kwords : null};
            $.post('<?php echo base_url("index.php/qa/add_qu")?>',data);
            $('#question_modal').modal('hide');
        });
        $('#qu_btn').click(function(){
            var state;
            $.get('<?php echo base_url("index.php/qa/qu_state/".$master_id)?>',function(data, status){
                state = data;
                if(state == '0'){
                    $('#question_modal').modal();
                }else if(state == '1'){
                    location.href = "<?php echo base_url('index.php/login')?>";
                }else{
                    location.href = "<?php echo base_url('index.php/qa/index/'.$master_id)?>";
                }
            });

        });
    });
</script>
</html>