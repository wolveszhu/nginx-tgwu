<?php
/**
 * Created by PhpStorm.
 * User: Administrator:stimmer
 * Date: 2017/6/13
 * Time: 9:36
 */

namespace Admin\Controller;
use Think\Controller;

class LoginController extends Controller{
    public function index(){
        if(session('adminUser')) {
            $this -> redirect('Index/index');
        }
        $this -> display();
    }

    public function check(){
        $username = $_POST['username'];
        $pwd = $_POST['password'];

        if(!trim($username)){
            return show(0,'管理员名不能为空');
        }

        if(!trim($pwd)){
            return show(0,'密码不能为空');
        }

        $res = D('Admin') -> getAdminByName($username);

        if(!$res){
            return show(0,'管理员不存在');
        }

        if($res['password'] != getMd5Password($pwd)){
            return show(0,'密码不正确');
        }

        session('adminUser',$res);
        return show(1,'登录成功!');
    }

    public function logout(){
        session('adminUser',null);
        $this -> redirect('Login/index');
    }
}