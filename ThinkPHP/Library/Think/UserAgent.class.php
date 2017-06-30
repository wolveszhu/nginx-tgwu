<?php
namespace Think;
/**
 * Class UserAgent 客户端检测类
 * @package Think
 */
class UserAgent {
    private static $IS_MOBILE = false;
    private static $IS_WECHAT = false;

    public static function init() {
        $useragent = "";
        if(isset($_SERVER['HTTP_USER_AGENT'])){
            $useragent = $_SERVER['HTTP_USER_AGENT'];//$_SERVER['HTTP_USER_AGENT']?$_SERVER['HTTP_USER_AGENT']:""
        }

        UserAgent::$IS_MOBILE = preg_match("/iPhone|iPad|Android|Windows Phone/i", $useragent);

        UserAgent::$IS_WECHAT = preg_match("/MicroMessenger/i", $useragent);
    }

    public static function IS_MOBILE() {
        return UserAgent::$IS_MOBILE;
    }

    public static function IS_WECHAT() {
        return UserAgent::$IS_WECHAT;
    }
}