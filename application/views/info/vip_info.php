<!--VIP-->
<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="zh-cn">
<?php $this->load->view('./templates/head'); ?>
<body class="bg-blue">
<div class="wrapper">
    <?php $this->load->view('./templates/navbar'); ?>
    <div class="container">
        <div class="row">
            <h1 class="index-vip-title">VIP特权</h1>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="index-vip-box">
                    <img src="<?php echo base_url('assets/images/v1.png'); ?>"/>
                    <h3>丰厚奖金</h3>
                    <p>VIP用户可直接参与金榜挑战赛，快来这里大展身手吧~~~丰厚奖金等你来拿哦，赶快加入我们吧！ </p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="index-vip-box">
                    <img src="<?php echo base_url('assets/images/v2.png'); ?>"/>
                    <h3>无限提问</h3>
                    <p>VIP用户可登陆我们的论坛网站进行无限次提问，您的任何问题小坛主都会为您尽心尽力一一解答~~~ </p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="index-vip-box">
                    <img src="<?php echo base_url('assets/images/v3.png'); ?>"/>
                    <h3>理财特助</h3>
                    <p> VIP用户可以查看理财师观点，助您早日打入理财高手榜。更多VIP特权，请您敬请期待哦~~~~</p>
                </div>
            </div>

        </div>
    </div>
</div>
<?php $this->load->view('./templates/footer'); ?>
</body>
</html>


