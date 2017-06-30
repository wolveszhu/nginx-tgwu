<?php
/**
 * Created by PhpStorm.
 * User: Administrator:stimmer
 * Date: 2017/6/26
 * Time: 13:58
 */

namespace Home\Model;
use Think\Model;

class UserModel extends Model{
    private $_db = '';

    public function __construct(){
        $this -> _db = M('User');
    }

    public function getUserById($userId){
        return $this -> _db -> where('id = ' . $userId) -> find();
    }

    public function getUserInfo($openId){
        return $this -> _db -> field('id') -> where('openId = "' . $openId . '"') -> find();
    }

    public function insertUserInfo($data){
        $info = [
            'nickName' => $data -> nickname,
            'userPhoto' => $data -> headimgurl,
            'status' => '1'
        ];
        return $this -> _db -> add($info);
    }

    public function getIdByOpenId($openId){
        return $this -> _db -> field('id') -> where('openId = "' . $openId . '"') -> find();
    }

    public function getInfoByUserOpenId($userOpenId){
        return $this -> _db -> where('openId = "' . $userOpenId . '"') -> find();
    }

    public function updateUserInfo($data){
        $where = [
            'openId' => $data -> openid,
        ];
        $info = [
            'nickName' => $data -> nickname,
            'userPhoto' => $data -> headimgurl,
            'status' => '1'
        ];
        return $this -> _db -> where($where) -> save($info);
    }
}