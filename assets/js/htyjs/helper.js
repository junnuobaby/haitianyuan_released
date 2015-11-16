/**
 * Created by tch on 2015/11/16.
 * 辅助函数
 */

//给数字加三位一逗号间隔
function formatter_number(s){
    var str = s.toString();
    var new_str=str.replace(/\B(?=(?:\d{3})+\b)/g, ',');
    return new_str;
}
