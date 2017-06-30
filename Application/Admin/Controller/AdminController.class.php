<?php
/**
 * Created by PhpStorm.
 * User: Administrator:stimmer
 * Date: 2017/6/14
 * Time: 10:07
 */

namespace Admin\Controller;


use Think\Exception;

class AdminController extends CommonController {
    public function personal(){
        $res = $this -> getLoginUser();
        $admin = D('Admin') -> getAdminByName($res['adminname']);
        $this -> assign('admin',$admin);
        $this -> display();
    }

    public function save(){
        $id = $_POST['id'];
        unset($_POST['id']);

        try{
            if(trim($_POST['password']) != D('Admin') -> getPasswordById($id)){
                $_POST['password'] = getMd5Password($_POST['password']);
            }
            $res = D('Admin') -> updateAdminById($id,$_POST);
            if($res === false){
                return show(0,"更新数据失败");
            }
            return show(1,"更新数据成功");
        }catch (Exception $exception){
            return show(0,$exception -> getMessage());
        }
    }
}