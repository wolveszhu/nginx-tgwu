<?php
/**
 * Created by PhpStorm.
 * User: Administrator:stimmer
 * Date: 2017/6/14
 * Time: 10:09
 */

namespace Admin\Model;
use Think\Model;

class AdminModel extends Model{
    private $_db = '';

    public function __construct(){
        $this -> _db = M('Admin');
    }

    public function getAdminByName($username){
        $res = $this -> _db -> where('adminName="' . $username .'"') -> find();
        return $res;
    }

    public function updateAdminById($id,$data){
        if(!$id || !is_numeric($id)){
            E("ID不合法");
        }
        if(!$data || !is_array($data)){
            E("提交数据不合法");
        }
        return $this -> _db -> where('id = ' . $id) -> save($data);
    }

    public function getPasswordById($id){
        if(!$id || !is_numeric($id)){
            return 0;
        }
        return $this -> _db -> where('id = ' . $id) -> getField('password');
    }
}