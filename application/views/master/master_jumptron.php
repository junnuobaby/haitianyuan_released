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
$current_user = $this->session->userdata('username');
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
                    <a class="btn" id="fan_btn"><?php if ($is_fan) echo "已关注"; else echo "关注"; ?></a>
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
                    <a href="<?php echo base_url("index.php/qa/index/" . $master_id.'/'.$username); ?>"
                       class="btn btn-default vip-link" id = "buy_vip"
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
                <div class="question_label ">
                    <label for="kword">标签</label>
                    <select id="kword" name="op_kwords">
                        <option>A股</option>
                        <option>债券</option>
                        <option>期货</option>
                        <option>黄金外汇</option>
                        <option>美股</option>
                        <option>其他</option>
                    </select>
                </div>
                <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                <button type="button" id="qa_btn" class="btn btn-success">确定</button>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('.master_homepage_jumptron').css('background-image', 'url("<?php echo base_url('assets/images/back/2.jpg'); ?>")');
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
//        点击购买VIP购买按钮触发的事件，如果是理财师自己点击，则不跳转
        $('#buy_vip').click(function (e) {
            var username = '<?php echo $username?>';
            var current_user = '<?php echo $current_user?>';
            if(username == current_user){
                e.preventDefault();
            }
        });
//        在编辑完提出的问题后点击确定按钮触发的事件
        $('#qa_btn').click(function (event) {
            var content = $('#my_question').val();
            var master_id = "<?php echo $master_id;?>";
            var master_name = "<?php echo $username;?>";
            var key_words = $('#kword').find('option:selected').text();
            var data = {master_id: master_id, master_name: master_name, qu_content: content, kwords: key_words};
            if (content == "") {
                alert("问题内容不能为空");
                event.preventDefault();     //阻止提交按钮的默认行为（提交表单）
            }else{
                $.post('<?php echo base_url("index.php/qa/add_qu")?>', data);
                $('#question_modal').modal('hide');
            }
        });
//        点击提问按钮触发的事件
        $('#qu_btn').click(function () {
            var state;
            $.get('<?php echo base_url("index.php/qa/qu_state/".$master_id)?>', function (data, status) {
                state = data;
                if (state == '0') {
                    $('#question_modal').modal();
                } else if (state == '1') {
                    location.href = "<?php echo base_url('index.php/login')?>";
                } else if (state == '2') {
                    if(confirm("只有VIP才能提问，是否升级成为VIP？")){
                        location.href = "<?php echo base_url('index.php/qa/index/'.$master_id.'/'.$username)?>";
                    }
                }else{
                    alert('不能向自己提问');
                }
            });

        });
    });

    //取消关注和加关注
    $(document).ready(function () {
        $('#fan_btn').click(function () {
            var username = '<?php echo $username?>';
            var current_user = '<?php echo $current_user?>';
            if(username == current_user){
                alert('不能关注自己');
            }
            else{
                var is_fan = $('#fan_btn').html();
                if (is_fan == '已关注') {
                    $.ajax({
                        url: '<?php echo base_url("index.php/home/cancel_fan/web"); ?>' + '/' + '<?php echo $master_id?>' + '/',
                        method: 'get',
                        success: function (data) {
                            if (data.status == '0') {
                                $('#fan_btn').html('关注');
                            } else {
                                alert(data.msg);
                            }
                        },
                        dataType: "json"
                    });
                } else {
                    $.ajax({
                        url: '<?php echo base_url("index.php/home/add_fan/web"); ?>' + '/' + '<?php echo $master_id?>' + '/'+'<?php echo $username?>',
                        method: 'get',
                        success: function (data) {
                            if (data.status == '0') {
                                $('#fan_btn').html('已关注');
                            } else {
                                alert(data.msg);
                            }
                        },
                        dataType: "json"
                    });
                }
            }
        });
    });
</script>
