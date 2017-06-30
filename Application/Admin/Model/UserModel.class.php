<?php
/**
 * Created by PhpStorm.
 * User: Administrator:stimmer
 * Date: 2017/6/13
 * Time: 10:38
 */

namespace Common\Model;
use Think\Model;

class UserModel extends Model{
    private $_db = '';

    public function __construct(){
        $this -> _db = M('user');
    }

    public function getDetailByNickName($nickName){
        $res = $this -> _db -> where('nickName="'.$nickName.'"') -> find();
        return $res;
    }

    public function getUsersPage($page,$pageSize){
        $data = [
            'id' => 'desc',
        ];
        $offset = ($page - 1) * $pageSize;
        return $this -> _db -> order($data) -> limit($offset,$pageSize) -> select();
    }

    public function getUsersCount(){
        return $this -> _db -> count('id');
    }

    public function updateUserStatusById($id,$data){
        if(!$id || !is_numeric($id)){
            E('ID不合法');
        }

        if(!$data || !is_array($data)){
            E('更新数据不合法');
        }

        return $this -> _db -> where('id = ' . $id) -> save($data);
    }

    public function deleteUserById($id){
        if(!$id || !is_numeric($id)){
            E("ID不合法");
        }
        return $this -> _db -> where('id = ' .$id) -> delete();
    }

    public function getUserById($id){
        return $this -> _db -> where('id = ' . $id) -> find();
    }

    public function getPasswordById($id){
        if(!$id || !is_numeric($id)){
            E("ID不合法");
        }
        return $this -> _db -> where('id = ' . $id) -> getField('password');
    }

    public function updateUserById($id,$data){
        if(!$id || !is_numeric($id)){
            E('ID不合法');
        }
        if(!$data || !is_array($data)){
            E('更新数据不合法');
        }

        return $this -> _db -> where('id=' . $id) -> save($data);
    }
}