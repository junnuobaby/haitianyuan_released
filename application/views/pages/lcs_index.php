<!--问答首页-->
<?php
function deal_num($num){
    $str_num = strval($num);
    $num_len = strlen($str_num);
    if($num_len < 4){
        for($i = $num_len; $i < 4; $i++){
            $str_num = '0'.$str_num;
        }
    }
    return $str_num;
}
?>
<?php
$self_name = $this->session->userdata('username');
$qa_num = deal_num($qa_num);
$master_num = deal_num($master_num);
$masters = $master_info;
?>
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="zh-cn">
<?php $this->load->view('./templates/head'); ?>
<body class="bg-gray">
<div class="wrapper">
    <?php $this->load->view('./templates/navbar'); ?>
    <div class="lcs_jmp">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <img class="img-responsive" src="<?php echo base_url('/assets/images/back/lcs_index.jpg'); ?>">
                </div>
            </div>
        </div>
    </div>
    <div class="lcs_index_cnt">
            <div class="container">
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="lcs_num_box">
                                <p>已入驻</p>
                                <p class="lcs_answer_num">
                                    <?php for($count = 0; $count < strlen($master_num); $count++):?>
                                        <span><?php echo substr($master_num, $count, 1);?></span>
                                    <?php endfor;?>
                                    个理财师
                                </p>
                                <p>你是理财达人吗？赶紧申请入驻吧！</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="lcs_num_box">
                                <p>已累计解决</p>
                                <p class="lcs_answer_num">
                                    <?php for($count = 0; $count < strlen($qa_num); $count++):?>
                                        <span><?php echo substr($qa_num, $count, 1);?></span>
                                    <?php endfor;?>
                                    个问题
                                </p>
                                <p>理财大师在线解答您的投资问题！</p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white mas_min_height master_lists_box">
                        <div class="master_lists">
                            <h4>全部理财师</h4>
                            <hr/>
                            <?php foreach ($masters as $vip): ?>
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="master_avatar_box">
                                            <a href="<?php echo base_url('index.php/home/load_home/web/' . 'master' . '/' . $vip['user_id'] . '/' . '1'); ?>">
                                                <img src="<?php echo base_url('/uploads/' . $vip['face_pic']); ?>" class="img-responsive img-circle" alt="...">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-md-10 master_intro_box">
                                        <h4><a href="<?php echo base_url('index.php/home/load_home/web/' . 'master' . '/' . $vip['user_id'] . '/' . '1'); ?>" target="_blank" class="theme-color"><?php echo $vip['username']; ?></a></h4>
                                        <p>关注 <?php echo $vip['concerns_count']; ?> |
                                            粉丝 <?php echo $vip['fans_count']; ?>
                                            | <?php if ($vip['online'] == true) {
                                                echo '在线';
                                            } else {
                                                echo "离线";
                                            } ?></p>

                                        <p>个性签名：<?php echo $vip['signature']; ?></p>
                                        <div class="action_box">
                                            <a class="btn bg-theme fan_btn" data-masterid = '<?php echo $vip['user_id'];?>' data-mastername = '<?php echo $vip['username'];?>'>
                                                <?php if ($vip['is_fan']) echo "已关注"; else echo "关注"; ?>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <hr class="qu_hr"/>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <?php $this->load->view('./templates/right-sidebar'); ?>
            </div>
    </div>
</div>
<?php $this->load->view('./templates/footer'); ?>
</body>
</html>
<script>
    //取消关注和加关注
    $(document).ready(function () {
        $('.fan_btn').click(function () {
            var username = '<?php echo $self_name?>';
            var master_id = $(this).data('masterid');
            var master_name = $(this).data('mastername');
            if(username == master_name){
                alert('不能关注自己');
            }
            else{
                var is_fan = $.trim($(this).html());
                if (is_fan == '已关注') {
                    $.ajax({
                        url: '<?php echo base_url("index.php/home/cancel_fan/web"); ?>' + '/' + master_id + '/',
                        method: 'get',
                        success: function (data) {
                            if (data.status == '0') {
                                $(this).html('关注');
                            } else {
                                alert(data.msg);
                            }
                        },
                    });
                } else {
                    $.ajax({
                        url: '<?php echo base_url("index.php/home/add_fan/web"); ?>' + '/' + master_id + '/'+ master_name,
                        method: 'get',
                        success: function (data) {
                            if (data.status == '0') {
                                $(this).html('已关注');
                            } else {
                                alert(data.msg);
                            }
                        },
                    });
                }
            }
        });
    });
</script>