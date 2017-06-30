<?php
/**
 * Created by PhpStorm.
 * User: Administrator:stimmer
 * Date: 2017/6/6
 * Time: 14:36
 */

namespace Home\Controller;
use Think\Controller;

class UserController extends Controller {
    public function index(){
        $id = 1;
        $user = D('User') -> getUserById($id);
        $this -> assign('user',$user);
        $this -> display();
    }
}