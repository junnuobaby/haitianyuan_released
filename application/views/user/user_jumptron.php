<!--普通用户主页巨幕显示内容组件-->
<?php
$username = $info['username'];
$signature = $info['signature'];
$face_pic = $info['face_pic'];
?>
<div class="master_homepage_jumptron">
    <div class="container">
        <div><img class="img-responsive user_avatar_box img-circle" src="<?php echo base_url('/uploads/' . $face_pic); ?>" alt="用户头像"></div>
        <div class="user_homepage_name"><?php echo $username; ?></div>
        <p class="user_signature"><?php echo $signature; ?></p>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('.master_homepage_jumptron').css('background-image', 'url("<?php echo base_url('assets/images/back/homepage_jmp.jpg'); ?>")');
    });
</script>