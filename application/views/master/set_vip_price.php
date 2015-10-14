<!--理财师设置VIP会员价格-->
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="zh-cn">
<?php $this->load->view('./templates/head'); ?>
<body class="bg-gray">
<script src="<?php echo base_url('/assets/js/htyjs/general_navbar.js') ?>"></script>
<?php
$price = $this->session->userdata('price');
$month_price = $price['month'];
$half_year_price = $price['half_year'];
$year_price = $price['year'];

?>
<div class="wrapper">
    <?php $this->load->view('./templates/navbar'); ?>
    <div class="container container_to_top">
        <div class="row">
            <div class="col-sm-3 col-md-3 ">
                <?php $this->load->view('./master/master_sidebar'); ?>
            </div>
            <div class="col-sm-9 col-md-9 block-radius bg-white set_price">
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <h3 class="panel-title">设置VIP会员价格</h3>
                    </div>
                    <div class="panel-body">
                        注意事项：
                        <h6 class="theme-color"><i class="glyphicon glyphicon-triangle-right"></i> 设置的VIP价格不得脱离实际。</h6>
                        <h6 class="theme-color"><i class="glyphicon glyphicon-triangle-right"></i> 过高或者过低的价格将直接影响您的客户，修改之前请慎重考虑。</h6>
                        <h6 class="theme-color"><i class="glyphicon glyphicon-triangle-right"></i> 您设置的价格将经过网站的官方审核。</h6>
                        <h6 class="theme-color"><i class="glyphicon glyphicon-triangle-right"></i> 点击价格可进行修改。</h6>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered ">
                            <thead>
                            <tr>
                                <th>VIP时限</th>
                                <th>权限</th>
                                <th>价格</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>一个月（30天）</td>
                                <td>
                                    <p><i class="glyphicon glyphicon-ok"></i> 享受一个月VIP权利</p>
                                    <p><i class="glyphicon glyphicon-ok"></i> 技术问答</p>
                                    <p><i class="glyphicon glyphicon-ok"></i> 开放全部观点</p>
                                </td>
                                <td>
                                    <a href="#" id="monthly_vip" data-type="text" data-pk="1" class="theme-color" ><?php echo $month_price;?></a>
                                </td>
                            </tr>
                            <tr>
                                <td>半年（180天）</td>
                                <td>
                                    <p><i class="glyphicon glyphicon-ok"></i> 享受半年VIP权利</p>
                                    <p><i class="glyphicon glyphicon-ok"></i> 技术问答</p>
                                    <p><i class="glyphicon glyphicon-ok"></i> 开放全部观点</p>
                                </td>
                                <td>
                                    <a href="#" id="half_year_vip" data-type="text" data-pk="2"  class="theme-color"><?php echo $half_year_price;?></a>
                                </td>
                            </tr>
                            <tr>
                                <td>一年（360天）</td>
                                <td>
                                    <p<i class="glyphicon glyphicon-ok"></i> 享受一年VIP权利</p>
                                    <p><i class="glyphicon glyphicon-ok"></i> 技术问答</p>
                                    <p><i class="glyphicon glyphicon-ok"></i> 开放全部观点</p>
                                </td>
                                <td >
                                    <a href="#" id="year_vip" data-type="text" data-pk="3" class="theme-color"><?php echo $year_price;?></a>
                                </td>
                            </tr>
                            </tbody>
                        </table>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<!--.wrapper-->
<!--悬停go-top按钮-->
<?php $this->load->view('./templates/go-top'); ?>
<?php $this->load->view('./templates/footer'); ?>
</body>
<script>
    $(function(){
        $('#monthly_vip').editable({
            url:  '<?php echo base_url("index.php/modify_info/modify_vip_price/web"); ?>',
            title: '修改月会员价格',
            name: 'month'
        });
        $('#half_year_vip').editable({
            url:  '<?php echo base_url("index.php/modify_info/modify_vip_price/web"); ?>',
            title: '修改半年制会员价格',
            name: 'half_year'
        });
        $('#year_vip').editable({
            url:  '<?php echo base_url("index.php/modify_info/modify_vip_price/web"); ?>',
            title: '修改年会员价格',
            name: 'year'
        });
    });
</script>
</html>

