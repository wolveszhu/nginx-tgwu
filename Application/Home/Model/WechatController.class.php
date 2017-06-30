<?php
/**
 * Created by PhpStorm.
 * User: Administrator:stimmer
 * Date: 2017/6/6
 * Time: 11:11
 */
namespace Home\Controller;

use Think\Controller;
use Think\UserAgent;
use Think\Wechat;

class WechatController extends Controller{
    public function auth(){
        $nonce = $_GET['nonce'];
        $token = 'tangguowu';
        $timestamp = $_GET['timestamp'];
        $echostr = $_GET['echostr'];
        $signature = $_GET['signature'];

        $arr = array();
        $arr = array($nonce,$timestamp,$token);
        sort($arr);
        $str = sha1(implode($arr));
        if($str == $signature && $echostr){
            echo $echostr;
            exit;
        }
    }
}


