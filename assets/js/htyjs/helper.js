/**
 * Created by tch on 2015/11/16.
 * 辅助函数
 */

//给数字加三位一逗号间隔
function split_number(str){
    var new_str=str.split('').reverse().join('').replace(/(\d{3})/g,'$1,').replace(/\,$/,'').split('').reverse().join('');
    return new_str;
}
