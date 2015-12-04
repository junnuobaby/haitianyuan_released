/**
 * Created by tch on 2015/11/16.
 * 辅助函数
 */


/**给数字三位一间隔
 * @param s 需要格式化的字符串
 * @returns 格式化的字符串
 */
function format_num(s){
    var str = s.toString();
    var result;
    if(s.toString().indexOf('.') == -1){
        result = str.replace(/\B(?=(?:\d{3})+\b)/g, ',');
    } else{
        result = parseFloat(s).toFixed(2).toString().replace(/\B(?=(?:\d{3})+\b)/g, ',');
    }
    return result;
}

/**
 * 给带小数点的数格式化为小数点后保留两位
 * @param s 需要格式化的小数
 */
function decimal(s){
    var result = parseFloat(s).toFixed(2);
    return result;
}
