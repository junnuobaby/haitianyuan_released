/**
 * Created by tangchaohong on 2015/8/25.
 * 用jquery动态设置顶部导航栏的样式
 */
$(document).ready(function(){
    $("#navbar").css('background-color', '#f4645f');
    $("#navbar").find('a').css("color","white");

    $("#navbar").find('a').hover(function () {
        $(this).css('color','black');
    }, function(){
        $(this).css('color','white');
    });

    $("#navbar").find('li.dropdown').find('ul').find('a').css("color","black");

    $("#navbar").find('li.dropdown').find('ul').find('a').hover(function () {
        $(this).css('color','#f4645f');
    }, function(){
        $(this).css('color','black');
    });

    $("#navbar-username").parent().on('shown.bs.dropdown',function () {
        $("#navbar-username").css('background-color', '#f4645f');
    });

    $("#navbar-menu").parent().on('shown.bs.dropdown',function () {
        $("#navbar-menu").css('background-color', '#f4645f');
    });
});