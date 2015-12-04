<!--巨幕-->
<div class="main_jumptron ">
    <div class="main_jumptron_img">
        <div id="jumptron-carousel" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#jumptron-carousel" data-slide-to="0" class="active"></li>
                <li data-target="#jumptron-carousel" data-slide-to="1"></li>
                <li data-target="#jumptron-carousel" data-slide-to="2"></li>
            </ol>

            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">
                <div class="item active">
                    <img class="jumptron_img" src="<?php echo base_url('assets/images/back/index_jmp_1.png'); ?>" alt="...">

                    <div class="carousel-caption">
                    </div>
                </div>
                <div class="item">
                    <img class="jumptron_img" src="<?php echo base_url('assets/images/back/index_jmp_2.png'); ?>" alt="...">
                    <div class="carousel-caption">
                    </div>
                </div>
                <div class="item">
                    <img class="jumptron_img" src="<?php echo base_url('assets/images/back/index_jmp_3.png'); ?>" alt="...">
                    <div class="carousel-caption">
                    </div>
                </div>
            </div>

            <!-- Controls -->
            <a class="left carousel-control" href="#jumptron-carousel" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#jumptron-carousel" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>

    <div class="jumptron_logo">
        <div class="jinbang_num">
            <p id="jinbang_num" class="bang_num inline_block">
                <span>2</span>
                <span>0</span>
                <span>5</span>
                <span>5</span>
                人
            </p>
            <p>正在参与海天模拟炒股</p>
            <hr/>
        </div>
        <div class="join-contest">
            <p><span class="take_in_num">555</span>人正在角逐金榜,<span class="take_in_num">1500</span>人正在角逐银榜</p>
            <p>
                <a href="#" class="inline_block take_in">
                    <span class="glyphicon glyphicon-hand-right"></span> 马上参加
                </a>
            </p>
        </div>
    </div>
</div>

<script>
    function adjust_img() {
        $('.jumptron_img').each(function () {
            var jumptron_logo = $('div.jumptron_logo');
            jumptron_logo.css('right','20%');
            jumptron_logo.css('top','10%');
            jumptron_logo.show();
            $('div.jinbang_num').show();
            var cur = $(window).width();
            $(this).width(cur);
            if(cur > 1200){
                $(this).height(400);
            }
            else if(cur < 1200 && cur > 768){
                $(this).height(300);
                jumptron_logo.css('top','20%');
                jumptron_logo.css('right','20%');
                $('div.jinbang_num').hide();
            }
            else if(cur < 768){
                jumptron_logo.hide();
            }
        });
    }
    window.onload = function () {
        window.onresize = adjust_img;
        adjust_img();
    }
</script>





