<!--支付主页-->
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="zh-cn">
<?php $this->load->view('./templates/head'); ?>
<body class="vip_price_body">
<div class="container" id="vip_price">
    <div class="row">
        <div class="text-center">
            <h1 class="slogan">高手之路，即刻启程</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 text-center">
            <div class="box">
                <div class="vip_category">
                    <h3 class="self-font">月费会员</h3>
                </div>
                <div class="content">
                    <div class="price_box">
                        <div class="price">
                            <small>￥</small><?php echo "100" ?>
                        </div>
                        <div class="duration">30天</div>
                        <a class="pay btn btn-default self-font" href="<?php echo base_url('/index.php/qa/join_vip/month/'.$master_id.'/'.$master_name);?>">
                            立即购买
                        </a>
                    </div>
                    <div>
                        <ul class="features">
                            <li><i class="glyphicon glyphicon-ok"></i>享受一个月VIP权利</li>
                            <li><i class="glyphicon glyphicon-ok"></i>技术问答</li>
                            <li><i class="glyphicon glyphicon-ok"></i>开放全部观点</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 text-center">
            <div class="box">
                <div class="vip_category">
                    <h3 class="self-font">半年会员</h3>
                </div>
                <div class="content">
                    <div class="price_box">
                        <div class="price">
                            <small>￥</small><?php echo "580" ?>
                        </div>
                        <div class="duration">180天</div>
                        <a class="pay btn btn-default self-font" href="<?php echo base_url('/index.php/qa/join_vip/half_year/'.$master_id.'/'.$master_name) ?>">
                            立即购买
                        </a>
                    </div>
                    <ul class="features">
                        <li><i class="glyphicon glyphicon-ok"></i>享受半年VIP权利</li>
                        <li><i class="glyphicon glyphicon-ok"></i>技术问答</li>
                        <li><i class="glyphicon glyphicon-ok"></i>开放全部观点</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-4 text-center">
            <div class="box">
                <div class="vip_category">
                    <h3 class="self-font">年费会员</h3>
                </div>
                <div class="content">
                    <div class="price_box">
                        <div class="price">
                            <small>￥</small><?php echo "1000" ?>
                        </div>
                        <div class="duration">360天</div>
                        <a class="pay btn btn-default self-font" href="<?php echo base_url('/index.php/qa/join_vip/year/'.$master_id.'/'.$master_name) ?>">
                            立即购买
                        </a>
                    </div>
                    <ul class="features">
                        <li><i class="glyphicon glyphicon-ok"></i>享受一年VIP权利</li>
                        <li><i class="glyphicon glyphicon-ok"></i>技术问答</li>
                        <li><i class="glyphicon glyphicon-ok"></i>开放全部观点</li>
                    </ul>
                </div>
            </div>
        </div>


    </div>
</div>
</body>
</html>
<script>
    $(document).ready(function () {
            var vip_time_bg = 'url(' + '<?php echo base_url("assets/images/noise_price.jpg")?>' + ')';
            $('.price_box').css('background-image', vip_time_bg);
        }
    );
</script>