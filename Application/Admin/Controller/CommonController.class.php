<?php
/**
 * Created by PhpStorm.
 * User: Administrator:stimmer
 * Date: 2017/6/13
 * Time: 16:32
 */

namespace Admin\Controller;
use Think\Controller;

class CommonController extends Controller{
    public function __construct(){
        parent::__construct();
        $this -> _init();
    }

    private function _init(){
        $isLogin = $this -> isLogin();

        if(!$isLogin){
            $this -> redirect('Login/logout');
        }
    }

    public function getLoginUser(){
        return session('adminUser');
    }

    public function isLogin(){
        $user = $this -> getLoginUser();

        if($user && is_array($user)){
            return true;
        }

        return false;
    }
}