<?php
//热点新闻标题数组
$hot_topic_list = array(
    '获利盘出逃致A股回落 环保股将迎走强契机',
    '一支大牛股的启航，低吸点就在这个位置',
    '大盘直接低开 接下来怎么办',
    '多头仍存在较多回旋余地',
    '今日操作策略（补充美股收盘和个股）',
    '早盘消息面和技术面全面解读（老乐说股）',
    '丙烯PP和塑料今日有望继续反弹，逢低可参与多',
    '吴旺鑫:美国人昨日杀多头，今日杀空头',
    '一支大牛股的启航，低吸点就在这个位置',
    '大盘直接低开 接下来怎么办'
);
?>
<!-- 左侧边栏-->
<div class="col-md-4 col-sm-4 side-bar">
    <div class="widget">
        <a href="<?php echo base_url("index.php/index/authentication"); ?>">
            <img src="<?php echo base_url('/assets/images/img_sidebar.png'); ?>" class="img-responsive" alt="Logo加载中...">
        </a>
    </div>
    <div class="widget hot-topics">
        <!-- 显示当日推荐的热门观点-->
        <h4 class="title theme-color">热门观点</h4>
        <div class="content">
            <ul>
                <?php foreach ($hot_topic_list as $hot_topic): ?>
                    <li><a class="text-success" href="#"><?php echo $hot_topic ?></a></li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
    <div class="widget hot-topics">
        <!--显示当日推荐的热门问题-->
        <h4 class="title theme-color">热门问题</h4>
        <div class="content">
            <ul>
                <?php foreach ($hot_topic_list as $hot_topic): ?>
                    <li><a class="text-success" href="#"><?php echo $hot_topic ?></a></li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
    <div class="widget download">
        <h4 class="title theme-color">下载</h4>
        <div class="content">
            <a href="#" class="btn btn-block self-btn-danger btn-block btn-lg white-color">ios客户端下载</a>
        </div>
    </div>
</div>