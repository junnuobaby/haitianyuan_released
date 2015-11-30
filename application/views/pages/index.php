<!--首页-->
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="zh-cn">
<?php $this->load->view('./templates/head'); ?>
<?php
$user = array('pos' => '1', 'name' => 'baby', 'fund' => '1100000', 'profit' => '10%');
$jinbang = array($user, $user, $user, $user, $user, $user, $user, $user, $user, $user);
?>
<body class="bg-gray">
<div class="wrapper">
    <div class="page_min_height">
        <?php $this->load->view('./templates/navbar'); ?>
        <?php $this->load->view('./templates/jumptron'); ?>
        <section class="web-info-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <a href="#" class="index-info-box">
                            <h3>什么是海天理财师？</h3>
                            <img width="300px" src="<?php echo base_url('assets/images/logo/logo_2.png'); ?>"/>

                            <div class="info-box-img info-box-img-1">
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="#" class="index-info-box">
                            <h3>如何参加金榜争夺赛？</h3>
                            <span>1.购买VIP入场券，直接参与金榜争夺赛</span>
                            <span>2.参加银榜比赛，优胜者免费进入金榜</span>

                            <div class="info-box-img info-box-img-2">
                                <img height="120px" src="<?php echo base_url('assets/images/logo/logo_3.png'); ?>"/>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="#" class="index-info-box">
                            <h3>VIP用户有哪些特权？</h3>
                            <span>无限次提问，查看理财师观点</span>

                            <div class="info-box-img info-box-img-3">
                                <img width="160px" src="<?php echo base_url('assets/images/logo/logo_4.png'); ?>"/>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </section>
        <section class="index-section index-rmd-master">
            <div class="container bg-white mas_min_height">
                <div class="index-section-header txt_center">
                    <div class="header-div">
                        <span>推荐理财师</span>

                        <div class="help-line"></div>
                        <p>解答理财疑问，投资咨询，走势分析</p>
                    </div>
                </div>
                <div class="index-section-content index-section-1">
                    <div class="row">
                        <div id="carousel-rmd-master" class="carousel slide" data-ride="carousel">
                            <!-- Wrapper for slides -->
                            <div class="carousel-inner" role="listbox">
                                <?php for ($external_count = 0; $external_count < 3; $external_count++): ?>
                                    <div class="item <?php if ($external_count == 0) {
                                        echo "active";
                                    } ?>">
                                        <div class="col-md-10 col-md-offset-1">
                                            <div class="row">
                                                <?php foreach ($master_info as $master): ?>
                                                    <div class="col-md-2">
                                                        <a href="<?php echo base_url('index.php/home/load_home/web/' . 'master' . '/' . $master['user_id'] . '/' . '1'); ?>"
                                                           class="thumbnail">
                                                            <img class="img-responsive avatar-radius"
                                                                 src="<?php echo base_url('/uploads/' . $master['face_pic']); ?>"
                                                                 alt="...">

                                                            <div class="text-center">
                                                                <h4 class="orange-color"><?php echo $master['username']; ?></h4>
                                                            </div>
                                                        </a>
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php endfor; ?>
                            </div>
                            <!-- Controls -->
                            <a class="left carousel-control" href="#carousel-rmd-master" role="button"
                               data-slide="prev">
                                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="right carousel-control" href="#carousel-rmd-master" role="button"
                               data-slide="next">
                                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="index-section-header txt_center">
                    <div class="header-div">
                        <span>英雄榜</span>

                        <div class="help-line"></div>
                        <p>模拟投资金榜排名优胜者，可获取巨额奖金，赶紧来加入群雄争霸赛吧！</p>

                        <p>所以用户均可免费参加海天银榜排名，银榜优胜者可直接角逐金榜排名。</p>

                        <p>只需购买一张金榜入场券，即可跳过银榜争夺赛，直接进入金榜排名赛赢取奖金。</p>
                    </div>
                </div>
                <div class="index-section-content">
                    <div class="row">
                        <div class="col-md-4 col-md-offset-1">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover table-condensed">
                                    <caption class="caption-jinbang">海天金榜</caption>
                                    <thead>
                                    <tr>
                                        <th>排名</th>
                                        <th>用户名</th>
                                        <th>总资产</th>
                                        <th>总收益率</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($jinbang as $item): ?>
                                        <tr>
                                            <td><?php echo $item['pos']; ?></td>
                                            <td><?php echo $item['name']; ?></td>
                                            <td><?php echo $item['fund']; ?></td>
                                            <td><?php echo $item['profit']; ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div style="margin-top: 100px;margin-left: 25px;">
                                <img src="<?php echo base_url('assets/images/logo/logo_6.png'); ?>"/>

                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover table-condensed">
                                    <caption class="caption-yinbang">海天银榜</caption>
                                    <thead>
                                    <tr>
                                        <th>排名</th>
                                        <th>用户名</th>
                                        <th>总资产</th>
                                        <th>总收益率</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($jinbang as $item): ?>
                                        <tr>
                                            <td><?php echo $item['pos']; ?></td>
                                            <td><?php echo $item['name']; ?></td>
                                            <td><?php echo $item['fund']; ?></td>
                                            <td><?php echo $item['profit']; ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
<?php $this->load->view('./templates/footer'); ?>
</body>
</html>