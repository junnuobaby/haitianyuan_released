<!--理财师个人中心页面-->
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="zh-cn">
<?php $this->load->view('./templates/head'); ?>
<body class="bg-gray">
<script src="<?php echo base_url('/assets/js/htyjs/general_navbar.js') ?>"></script>
<?php
$view_list = $op;
?>
<div class="wrapper">
    <?php $this->load->view('./templates/navbar'); ?>
    <div class="container container_to_top">
        <div class="row">
            <div class="col-sm-3 col-md-3 ">
                <?php $this->load->view('./master/master_sidebar'); ?>
            </div>
            <div class="col-sm-9 col-md-9 block-radius">
                <div class="panel panel-success mas_min_height">
                    <div class="panel-heading"><h3><span class="glyphicon glyphicon-list"></span> 已发表观点</h3>
                    </div>
                    <?php if (count($view_list) < 1): ?>
                        <h4 class="alert_info">您还没有发布任何观点！</h4>
                    <?php else: ?>
                        <div class="panel-body">
                            <div class="opinion_category">
                                <label for="kword">提示: 点击带红色下划线的字可更改权限</label>
                            </div>
                        </div>
                        <!-- 已发表的观点列表 -->
                        <div class="opinion_list">
                            <?php foreach ($view_list as $view_item): ?>
                                <div class="master_view">
                                    <article>
                                        <header>
                                            <h4 class="inline_div"><a
                                                    href="#"
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
                                        <span>
                                            <a href="#" class="x-editable-access edit_view"
                                               data-value="<?php echo $view_item['op_auth']; ?>" data-type="select"
                                               data-pk="<?php echo $view_item['op_id']; ?>"
                                               data-title="更改权限"></a>
                                        </span>
                                        </section>
                                    </article>
                                </div>
                                <hr/>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
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

    $(document).ready(function () {
        //设置x-editable的权限
        $('a.x-editable-access').editable({
            name: 'change_auth',
            url: '<?php echo base_url("index.php/opinion/auth/"); ?>',
            source: [
                {value: 0, text: '仅VIP可见'},
                {value: 1, text: '免费'},
            ],
            success: function success(response, newValue) {
                if (response.status == 'error') {
                    return response.msg;
                }
            },
            error: function error(response, newValue) {
                return '服务器故障。';
            }
        });
    });
</script>
</html>

