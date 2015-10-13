<!--理财师主页巨幕显示内容组件-->
<?php
$master_id = $info['host_id'];
$online_state = $info['online_state'];   //是否在线，在线为true
$username = $info['username'];
$concerns_count = $info['concerns_count'];
$fans_count = $info['fans_count'];
$vips_count = $info['vips_count'];
$questions_count = $info['questions_count'];
$satisfication_rate = $info['satisfication_rate'];
$response_time = $info['response_time'];
$signature = $info['signature'];
$face_pic = $info['face_pic'];
?>
<div class="container-fluid master_homepage_jumptron">
    <div class="container">
        <div class="col-md-2 col-sm-4">
            <div class="master_homepage_jumptron_div">
                <div class="avatar_box">
                    <img class="img-responsive" src="<?php echo base_url('/uploads/' . $face_pic); ?>"
                         alt="理财师头像">
                </div>
                <!--根据是否在线显示不同的状态，当前默认为在线-->
                <div class="online_status">
                    <?php if ($online_state == false): ?>
                        <img class="img-responsive" src="<?php echo base_url('/assets/images/offline.png'); ?>">
                    <?php else: ?>
                        <img class="img-responsive" src="<?php echo base_url('/assets/images/online.png'); ?>">
                    <?php endif; ?>
                </div>
                <div>
                    <a class="btn" id="fan_btn"><?php if ($is_fan): ?>已关注
                        <?php else: ?>未关注
                        <?php endif; ?>
                    </a>
                    <a class="btn" id="qu_btn"><span
                            class="glyphicon glyphicon-question-sign"></span> 提问
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-3">
            <div class="master_homepage_jumptron_div">
                <h3><?php echo $username; ?></h3>
                <hr/>
                <p class="self-font signature"><span>简介：</span><?php echo $signature; ?></p>
            </div>
        </div>
        <div class="col-md-4 col-md-offset-1 col-sm-4">
            <div class="master_homepage_jumptron_div">
                <div class="row">
                    <table class="table table-responsive text-center master_info">
                        <tr>
                            <td><h5>回答问题数</h5> <h4><?php echo $questions_count; ?></h4></td>
                            <td><h5>满意率</h5><h4><?php echo $satisfication_rate; ?></h4>
                            </td>
                            <td><h5>响应时间</h5><h4><?php echo $response_time; ?>小时</h4>
                            </td>
                        </tr>
                        <tr>
                            <td><h5>VIP用户</h5><h4><?php echo $vips_count; ?></h4>
                            </td>
                            <td><h5>粉丝</h5><h4><?php echo $fans_count; ?></h4></td>
                            <td><h5>关注</h5><h4><?php echo $concerns_count; ?></h4>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="row text-center">
                    <a href="<?php echo base_url("index.php/qa/index/" . $master_id); ?>"
                       class="btn btn-default vip-link"
                       target="_blank"><span>体验VIP会员</span></a>
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
    $(document).ready(function () {
        $('#qa_btn').click(function () {
            var content = $('#my_question').val();
            var master_id = "<?php echo $master_id;?>";
            var master_name = "<?php echo $username;?>";
            var data = {master_id: master_id, master_name: master_name, qu_content: content, kwords: null};
            $.post('<?php echo base_url("index.php/qa/add_qu")?>', data);
            $('#question_modal').modal('hide');
        });
        $('#qu_btn').click(function () {
            var state;
            $.get('<?php echo base_url("index.php/qa/qu_state/".$master_id)?>', function (data, status) {
                state = data;
                if (state == '0') {
                    $('#question_modal').modal();
                } else if (state == '1') {
                    location.href = "<?php echo base_url('index.php/login')?>";
                } else {
                    location.href = "<?php echo base_url('index.php/qa/index/'.$master_id)?>";
                }
            });

        });
    });

    //取消关注和加关注
    $(document).ready(function () {
        $('#fan_btn').click(function () {
            var is_fan = $('#fan_btn').html();
            alert(is_fan == '已关注');
            if (is_fan == '已关注') {
                $.ajax({
                    url: '<?php echo base_url("index.php/home/cancel_fan/web"); ?>' + '/' + '<?php echo $master_id?>' + '/',
                    method: 'get',
//                    data: {master_id: '<?php //echo $master_id?>//'},
                    success: function (data) {
                        var response = JSON.parse(data);
                        alert(response);
                        if (response.status == '0') {
                            alert('已取消关注');
                            $('#fan_btn').html('加关注');
                        } else {
                            alert(response.msg);
                        }
                    }
                });
            } else {
                $.ajax({
                    url: '<?php echo base_url("index.php/home/add_fan/web"); ?>' + '/' + '<?php echo $master_id?>' + '/'+'<?php echo $username?>',
                    method: 'get',
//                    data: {master_id: '<?php //echo $master_id?>//', username: '<?php //echo $username?>//'},
                    success: function (data) {
                        var response = JSON.parse(data);
                        if (response.status == '0') {
                            alert('关注成功');
                            $('#fan_btn').html('已关注');
                        } else {
                            alert(response.msg);
                        }
                    }
                });
            }
        });
    });

</script>
