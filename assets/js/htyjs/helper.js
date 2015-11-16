/**
 * Created by tch on 2015/11/16.
 * 辅助函数
 */

//给整数加三位一逗号间隔
function format_int(s){
    var str = s.toString();
    var new_str=str.replace(/\B(?=(?:\d{3})+\b)/g, ',');
    return new_str;
}
//给浮点数加三位一逗号间隔，浮点数保留两位小数点
function format_float(s){
    var str = parseFloat(s).toFixed(2).toString();
    var new_str=str.replace(/\B(?=(?:\d{3})+\b)/g, ',');
    return new_str;
}

//给数字三位一间隔
function format_num(s){
    if(s.toString().indexOf('.') == -1){
        format_int(s);
    }
    else{
        format_float(s);
    }
}