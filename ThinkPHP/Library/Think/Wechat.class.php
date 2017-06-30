<?php
namespace Think;
/**
 * Class Wechat 微信接口类
 * @package Think
 */
class Wechat {

    //https://open.weixin.qq.com/connect/oauth2/authorize?appid=APPID&redirect_uri=REDIRECT_URI&response_type=code&scope=SCOPE&state=STATE#wechat_redirect

    public static function getOAuth2CodeUrl($options) {
        $APPID = $options->appid;
        $SCOPE = $options->scope;
        $STATE = $options->state;
        $REDIRECT_URI = urlencode($options->redirect_uri);

        $url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=".$APPID."&redirect_uri=".$REDIRECT_URI."&response_type=code&scope=".$SCOPE."&state=".$STATE."#wechat_redirect";
        return $url;
    }

    /**
     * @param $options 数组 包含APPID，APPSECRET，CODE
     * @return bool|string 返回微信公众号的AccessToken
     */
    public static function getOAuth2AccessToken($options) {
        $APPID = $options->appid;
        $SECRET = $options->appsecret;
        $CODE = $options->code;
        $url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=".$APPID."&secret=".$SECRET."&code=".$CODE."&grant_type=authorization_code";


        $raw = file_get_contents($url);

        return $raw;
    }

    //网页授权获取用户基本信息
    public static function getUserInfo($options) {
        $ACCESS_TOKEN = $options->access_token;
        $OPENID = $options->openid;
        $url = "https://api.weixin.qq.com/sns/userinfo?access_token=".$ACCESS_TOKEN."&openid=".$OPENID."&lang=zh_CN";

        $raw = file_get_contents($url);

        return $raw;
    }

    //获取用户基本信息（包括UnionID机制）
    public function getBasicUserInfo($options){
        $ACCESS_TOKEN = $options->access_token;
        $OPENID = $options->openid;
        $url = "https://api.weixin.qq.com/cgi-bin/user/info?access_token=".$ACCESS_TOKEN."&openid=".$OPENID."&lang=zh_CN";

        $raw = file_get_contents($url);

        return $raw;
    }
}