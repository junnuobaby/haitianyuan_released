<!--模拟炒股，已成交的订单-->
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="zh-cn">
<?php $this->load->view('./templates/head'); ?>
<?php

?>
<body class="bg-gray">
<div class="wrapper">
    <?php $this->load->view('./stocks/bonds_navbar'); ?>
    <div class="container">
        <div class="row">
            <div class="col-md-2">
                <?php $this->load->view('./stocks/heros_rank_sidebar'); ?>
            </div>
            <div class="col-md-10 col-sm-10">
                <div class="bg-white stocks_min_h  block-radius">

                </div>
            </div>
        </div>
    </div>

    <!--悬停go-top按钮-->
    <?php $this->load->view('./templates/go-top'); ?>
</div>
<?php $this->load->view('./templates/footer'); ?>
</body>
<script>
    $(document).ready(function () {
        $('.main_jumptron').css('margin-bottom', '0px');
        $('.formatted').each(function(){
            var value = format_num($(this).html());
            $(this).html(value);
        });
        $('.decimal').each(function () {
            var value = decimal($(this).html());
            $(this).html(value);
        });
    });
</script>
</html>