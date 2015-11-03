<ul class="fixed-bar">
    <li class="feedback">
        <a class="fixed-bar-icon"><i class="glyphicon glyphicon-question-sign hz-icon"></i></a>
        <a class="fixed-bar-text">问题反馈</a>
    </li>
    <li class="go-top">
        <a class="fixed-bar-icon"><i class="glyphicon glyphicon-chevron-up hz-icon"></i></a>
        <a href="#" class="fixed-bar-text">回到顶部</a>
    </li>
</ul>

<script>
    $(document).ready(function(){
        $('ul.fixed-bar li').hover(function(){
            $(this).children(':eq(0)').hide();
            $(this).css('background-color', '#f4645f').children(':eq(1)').show().css('display', 'block');
        }, function () {
            $(this).children(':eq(1)').hide();
            $(this).css('background-color', '#fff').children(':eq(0)').show().css('display', 'block');
        });
    });
</script>