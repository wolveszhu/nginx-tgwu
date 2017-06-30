<?php
/**
 * Created by PhpStorm.
 * User: Administrator:stimmer
 * Date: 2017/6/28
 * Time: 18:38
 */
namespace Home\Model;
use Think\Model;

class UsercollModel extends Model{
    private $_db = '';

    public function __construct(){
        $this -> _db = M('Usercoll');
    }

    public function insert($userId,$wareId){
        $data = [
            'userId' => $userId,
            'wareId' => $wareId
        ];
        return $this -> _db -> add($data);
    }
}