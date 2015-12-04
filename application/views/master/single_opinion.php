<!--单个观点内容页面-->
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="zh-cn">
<?php $this->load->view('./templates/head'); ?>
<body class="bg-gray">
<div class="wrapper">
    <?php $this->load->view('./templates/navbar'); ?>
    <div class="sop_header theme-bg-color">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <h1 class="">海天理财，定制你的专属理财师</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="sop_article">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2">
                    <article class="bg-white mas_min_height">
                        <header class="text-center">
                            <h2><?php echo $opinion['op_title']; ?></h2>
                            <section class="sop-meta">
                                <span class="sop-author">作者 ： <?php echo $opinion['master_name']; ?></span>•
                                <time><?php echo $opinion['op_timestamp']; ?></time>
                            </section>
                        </header>
                        <section class="sop-content">
                            <p>
                                <?php echo $opinion['op_content']; ?>
                            </p>
                        </section>
                        <footer>
                            <span class="key_word"><?php echo $opinion['op_kwords']; ?></span>
                            <span class="key_word"><?php if($opinion['op_auth'] == 0){
                                    echo '仅vip可见';
                                }else{
                                    echo '免费';
                                }; ?></span>
                            <button class="btn btn-success glyphicon glyphicon-thumbs-down"> <?php echo '0';?> 太水了</button>
                            <button class="btn btn-danger theme-bg-color glyphicon glyphicon-thumbs-up"> <?php echo '0';?> 赞一个</button>
                        </footer>
                    </article>
                </div>

            </div>
        </div>
    </div>

</div>
<!--悬停go-top按钮-->
<?php $this->load->view('./templates/go-top'); ?>
<?php $this->load->view('./templates/footer'); ?>
</body>
<script>

</script>
</html>
