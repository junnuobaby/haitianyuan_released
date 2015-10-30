<!--理财师的全部VIP会员-->
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="zh-cn">
<?php $this->load->view('./templates/head'); ?>
<body class="bg-gray">
<script src="<?php echo base_url('/assets/js/htyjs/general_navbar.js') ?>"></script>

<div class="wrapper">
    <?php $this->load->view('./templates/navbar'); ?>
    <div class="container container_to_top">
        <div class="row">
            <div class="col-sm-3 col-md-3 ">
                <?php $this->load->view('./master/master_sidebar'); ?>
            </div>
            <div class="col-sm-9 col-md-9 block-radius bg-white set_price mas_min_height">
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <h3 class="panel-title">我的会员</h3>
                    </div>
                    <div class="panel-body">
                        <?php if(count($user_info) < 1):?>
                        <h4 class="alert_info">
                            <img src="<?php echo base_url('/assets/images/zhuge1.png'); ?>"/>
                            亲，您暂无会员，不要灰心，请继续加油哦！</h4>
                        <?php else:?>
                        <?php foreach ($user_info as $user): ?>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="master_avatar_box"><img
                                            src="<?php echo base_url('/uploads/' . $user['face_pic']); ?>"
                                            class="img-responsive img-circle" alt="..."></div>
                                </div>
                                <div class="col-md-10">
                                    <h4><a href="#" class="theme-color"><?php echo $user['username']; ?></a></h4>

                                    <p><span>剩余服务期： <?php echo $user['expire_time']; ?>天</span> |
                                           <span><a class="hty_a" role="button" data-toggle="collapse"
                                                    href="#<?php echo 'collapse' . $user['user_id']; ?>"
                                                    aria-expanded="false"
                                                    aria-controls="collapseExample">
                                                   查看历史订单
                                               </a></span> |
                                        <span><a href="#records_modal" class="his_qa_btn hty_a"
                                                 data-id="<?php echo $user['user_id']; ?>"
                                                 data-toggle="modal">历史问答记录</a></span>
                                    </p>

                                    <div class="collapse" id="<?php echo 'collapse' . $user['user_id']; ?>">
                                        <div class="well">
                                            <p>很抱歉，暂无信息</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="qu_hr"/>
                        <?php endforeach; ?>
                        <?php endif;?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- 历史问答记录Modal -->
<div class="modal fade" id="records_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">历史问答</h4>
            </div>
            <div class="modal-body">
                <!--历史问题-->
                <div class="tab-pane qa_his_height" id="his_qa"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
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
        var counter = 1;
        $('.his_qa_btn').click(function () {
            counter = 1;
            $.ajax({
                url: '<?php echo base_url("index.php/modify_info/get_user_qa"); ?>' +'/' + 'web'+'/' + $(this).data('id'),
                data: {page: 1},
                method: 'get',
                success: show_his_qa,
                error:function(){
                    alert('亲，对不起，我们的服务器宝宝生病了');
                },
                dataType: "json"
            });
        });
        function show_his_qa(data){
            var content = "";
            var qa_list = data['qa_info']['data_page']; //获取历史问题记录内容
            var count = data['qa_info']['count']; //获取历史回答记录的数量
            var page_count = data['qa_info']['page_count']; //获取页面的数量
            for(var i= 0; i< qa_list.length; i++){
                content += '<div class="q_a qu_margin">' +
                    '<article>' +
                    '<h4 class="q_a_question inline_block">' +
                    '<span class="q_a_span">问</span>' +
                    '<a href="#">' + qa_list[i]['qu_content'] + '</a></h4>' +
                    '<span class="qu_time">【' + qa_list[i]['qu_timestamp'] + '】</span>' +
                    '<p class="q_a_answer"><span class="theme-color">答:</span>&nbsp;&nbsp;' + qa_list[i]['ans_content'] +
                    '</p>' +
                    '<div class="q_a_footer">' +
                    '<span>回答时间：' + qa_list[i]['ans_timestamp'] + '</span>' +
                    '</div>' +
                    '</article>' +
                    '</div>' +
                    '<hr class="q_a_hr"/>';
            }
            if(page_count > counter){
                content += '<a class="btn btn-success btn-show-more show_block center-block" >点击查看更多</a>';
            $('#his_qa').html(content);
        }

        //更查看更多添加事件
        $('#his_qa').delegate('a.btn-show-more','click', function(){
            counter += 1;
            $('a.btn-show-more').hide();
            $.ajax({
                url: '<?php echo base_url("index.php/modify_info/get_user_qa"); ?>' +'/' + 'web'+'/' + $(this).data('id'),
                data: {page: counter},
                method: 'get',
                success: show_more_qa,
                dataType: "json"
            });
        });
        function show_more_qa(data){
            var content = "";
            var qa_list = data['qa_info']['data_page']; //获取历史问题记录内容
            var count = data['qa_info']['count']; //获取历史回答记录的数量
            var page_count = data['qa_info']['page_count']; //获取页面的数量
            for(var i= 0; i< qa_list.length; i++){
                content += '<div class="q_a qu_margin">' +
                    '<article>' +
                    '<h4 class="q_a_question inline_block">' +
                    '<span class="q_a_span">问</span>' +
                    '<a href="#">' + qa_list[i]['qu_content'] + '</a></h4>' +
                    '<span class="qu_time">【' + qa_list[i]['qu_timestamp'] + '】</span>' +
                    '<p class="q_a_answer"><span class="theme-color">答:</span>&nbsp;&nbsp;' + qa_list[i]['ans_content'] +
                    '</p>' +
                    '<div class="q_a_footer">' +
                    '<span>回答时间：' + qa_list[i]['ans_timestamp'] + '</span>' +
                    '</div>' +
                    '</article>' +
                    '</div>' +
                    '<hr class="q_a_hr"/>';
            }
            if(page_count > counter){
                content += '<a class="btn btn-success btn-show-more show_block center-block">点击查看更多</a>'
            }
            $('#his_qa').append(content);
        }
    });
</script>
</html>

