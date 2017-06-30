<?php
/**
 * Created by PhpStorm.
 * User: Administrator:stimmer
 * Date: 2017/6/13
 * Time: 9:30
 */

function  show($status, $message,$data=array()) {
    $reuslt = array(
        'status' => $status,
        'message' => $message,
        'data' => $data,
    );

    exit(json_encode($reuslt));
}

function getMd5Password($password) {
    return md5($password . C('MD5_PRE'));
}

function status($status) {
    if($status == 0) {
        $str = '关闭';
    }elseif($status == 1) {
        $str = '正常';
    }elseif($status == -1) {
        $str = '删除';
    }
    return $str;
}

function ishotnew($status){
    if($status == 1){
        $str = "是";
    }else{
        $str = "否";
    }
    return $str;
}

function isreduce($status){
    if($status == -1){
        $str = "否";
    }else{
        $str = "是";
    }
    return $str;
}

function standTime($int){
    if($int == 0){
        return '';
    }
    return date('Y-m-d H:i:s',$int);
}

function isCarousel($carousel) {
    if($carousel) {
        return '<span style="color:red">有</span>';
    }
    return '无';
}

function showKind($status,$data) {
    header('Content-type:application/json;charset=UTF-8');
    if($status==0) {
        exit(json_encode(array('error'=>0,'url'=>$data)));
    }
    exit(json_encode(array('error'=>1,'message'=>'上传失败')));
}

function getLoginUsername() {
    return $_SESSION['adminUser']['adminname'] ? $_SESSION['adminUser']['adminname']: '';
}

function isnull($int){
    if(is_null($int)){
        $int = "未使用";
    }
    return $int;
}

function getUrl($data){
    return __ROOT__.$data;
}

function getSubStr($str){
    $len = strlen($str);
    if($len<=36){
        $newStr = substr($str,'-17');
    }else{
        $arr = explode(';',$str);
        $newStr = '';
        for($i = 0;$i < count($arr) - 1;$i ++){
            $newStr = substr($arr[$i],'-17') . '<br/>' . $newStr;
        }
    }
    return $newStr;
}

function strsub($str){
    if(strlen(trim($str)) > 40){
        $newStr = substr($str,0,40) . '....';
    }else{
        $newStr = $str;
    }
    return $newStr;
}