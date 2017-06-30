<?php
/**
 * Created by PhpStorm.
 * User: Administrator:stimmer
 * Date: 2017/6/1
 * Time: 13:36
 */
namespace Home\Controller;

use Think\Controller;
use Think\Wechat;


class InvicodeController extends Controller
{
    const OAUTH2_STATE_SALT = "ITSOAUTH2SALT";

    public function index()
    {
        //检查用户是否登录（授权），获取用户信息
        $res = $this->check();
        //已登录
        if ($res) {
            //判断当前用户是否已经输过邀请码
            $userId = $this -> getId();
            $invi = $this->checkInviByUserId($userId['id']);
            if ($invi) {
                session('UserOpenId',$userId['openid']);
                $this->redirect('Index/index');
            } else {
                $this->display();
            }
        } else {
            $this -> signin();
        }
    }

    protected function getOAuth2State()
    {
        return md5(session_id() . self::OAUTH2_STATE_SALT);
    }

    public function signin()
    {
        $wechat = new Wechat();
        $state = $this->getOAuth2State();
//        $redirect_url 授权完成后跳转的页面
        $redirect_url = "http://wxmsg.amailive.com/index.php?c=Invicode&a=index";
        $redirect_uri = "http://wxmsg.amailive.com/index.php?c=Invicode&a=callback";

        $options = [
            'appid' => C('AppID'),
            'scope' => 'snsapi_base',
            'state' => $state,
            'redirect_uri' => $redirect_uri
        ];
        $codeObj = $wechat->getOAuth2CodeUrl((object)$options);
        session("REDIRECT_URL", $redirect_url);
        redirect($codeObj);
    }

    public function callback()
    {
        $code = $_GET['code'];
        $state = $_GET['state'];

        if (!$code) {
            echo "code missing";
            return false;
        }
        if (!$state) {
            echo "stats missing";
            return false;
        }

        $options = [
            'appid' => C('AppID'),
            'appsecret' => C('AppSecret'),
            'code' => $code
        ];
        $res = Wechat::getOAuth2AccessToken((object)$options);

        /*
         * $res 的值
        {"access_token":"OezXcEiiBSKSxW0eoylIeGXB4XcKc5GK2EqEc12CUz7EYL25vDAyG0i4Zl9XSRgJqPlOuAJOEl61xZyIwYnPK284qxI1DwN_It3tyoIqEKQNsou7UO7mOHnreJewSA8PLoSkqEKrbtTJ-Zj7LUe_Jg",
        "expires_in":7200,
        "refresh_token":"OezXcEiiBSKSxW0eoylIeGXB4XcKc5GK2EqEc12CUz7EYL25vDAyG0i4Zl9XSRgJauIPsuDJ6RHizWJ1gnRHz3BAQW_FVHyZiY2T-FmtYp0eF13a_pNKo5ZP3HIQJ70fVtNtu3w0sKBFPvMMqhANlw",
        "openid":"oPhMiuDIggVuZNqbMdVRJlUzyqjM",
        "scope":"snsapi_base",
        "unionid":"o-PCHt2i1c7hJlKNm4fSPu8wp0es"}
        */

        if (empty($res)) {
            echo "get access_token returns null";
            return false;
        }

        $data = json_decode($res);
        session('UserOpenId',$data -> openid);

        if (property_exists($data, 'errcode')) {
            echo "getOAuth2AccessToken : " . $res;
            return false;
        }

        $access_token = $data->access_token;
        $openid = $data->openid;
        $scope = $data->scope;
        $opts = [
            'access_token' => $access_token,
            'openid' => $openid
        ];
        $raw = Wechat::getUserInfo((object)$opts);

        if (empty($raw)) {
            echo "get user infomation returns null";
        } else {
            $raw = json_decode($raw);
            if (property_exists($raw, 'errcode')) {
                //48001 在用户没有授权过时，使用snsapi_base获取的access_token无法操作userinfo，需要发起授权
                if (($raw->errcode == 48001) && ($scope == "snsapi_base")) {

                    $this->redirectSnsApiUserInfo();
                    return;
                } else {
                    echo "wechat::callback getUserInfso => " . json_encode($raw);
                }
                return false;
            }

            $result = D('User') -> getUserInfo($raw -> openid);
            if($result){
                $res = D('User') -> updateUserInfo($raw);
                if($res){
                    return $this -> error("cuowu1");
                }
                $redirect_url = session("REDIRECT_URL");
                redirect($redirect_url);
            }else{
                $userInfo = D('User')->insertUserInfo($raw);
                if(!$userInfo){
                    return $this->error('cuowu2');
                }
                $redirect_url = session("REDIRECT_URL");
                redirect($redirect_url);
            }

        }
    }

    public function check()
    {
        if (session('UserOpenId')) {
            return true;
        } else {
            return false;
        }
    }

    public function checkInviByUserId($userId)
    {
        $res = D('Invitation')->getInvicodeById($userId);
        if ($res) {
            return true;
        } else {
            return false;
        }
    }

    public function getId()
    {
        $userOpenId = session('UserOpenId');
        $res = D('User')->getInfoByUserOpenId($userOpenId);
        if ($res) {
            return $res;
        } else {
            return false;
        }
    }

    protected function redirectSnsApiUserInfo() {
        $wxapp = $this->config->wechat->oauth2;
        $state = $this->getOAuth2State();
        $redirect_uri = "http://wxmsg.amailive.com/index.php?c=Invicode&a=callback";

        $url = Wechat::getOAuth2CodeUrl((object)array(
            'appid'         => C('AppID'),
            'scope'         => 'snsapi_userinfo',
            'state'         => $state,
            'redirect_uri'  => $redirect_uri,
        ));

        redirect($url);
    }

    public function inputIni(){
        $userOpenId = session('UserOpenId');
        $invicode = strtoupper(trim($_POST['invicode']));

        $userId = D('User') -> getInfoByUserOpenId($userOpenId);
        $id = D('Invitation') -> getOneByInvicode($invicode);
        if(!empty($id['userid'])){
            return show(0,"邀请码已被使用");
        }
        if($userId){
            $res = D('Invitation') -> updateInvicode($userId,$invicode);
            if($res){
                return show(1,'邀请码输入正确',array('url' => '{:U("Index/index")}'));
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
}