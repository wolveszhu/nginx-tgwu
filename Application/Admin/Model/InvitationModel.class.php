<?php
/**
 * Created by PhpStorm.
 * User: Administrator:stimmer
 * Date: 2017/6/14
 * Time: 10:51
 */

namespace Admin\Model;
use Think\Model;

class InvitationModel extends Model {
    private $_db = '';
    public function __construct(){
        $this -> _db = M('invitation');
    }

    public function getInvitations(){
        $data = [
            'id' => 'desc',
        ];

        return $this -> _db -> order($data) -> select();
    }

    public function getInvitationPage($page,$pageSize){
        $data = [
            'id' => 'desc',
        ];

        $page = $page == 0 ? 1 : $page;
        $offset = ($page - 1) * $pageSize;

        return $this -> _db -> order($data) -> limit($offset,$pageSize) -> select();
    }

    public function getInvitationCount(){
        return $this -> _db -> count('id');
    }

    public function deleteInvitationById($id){
        if(!$id || !is_numeric($id)){
            E("ID不合法");
        }
        return $this -> _db -> where('id= ' . $id) -> delete();
    }

    public function getInvitationByCode($code){
//        $data['invitationCode'] = array('like',"%{$code}%");
        return $this -> _db -> where('invitationCode = "' . $code . '"') -> find();
//        return $this -> _db -> where($data) -> select();
    }

    public function getInvitationByName($name){
        $data['nickName'] = array('like',"%{$name}%");
        return $this -> _db -> where($data) -> select();
    }

    public function insert($data){
        if(!$data || !is_array($data)){
            return 0;
        }
        return $this -> _db -> add($data);
    }
}