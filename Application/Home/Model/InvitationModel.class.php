<?php
/**
 * Created by PhpStorm.
 * User: Administrator:stimmer
 * Date: 2017/6/28
 * Time: 11:21
 */
namespace Home\Model;
use Think\Model;

class InvitationModel extends Model{
    private $_db = '';

    public function __construct(){
        $this -> _db = M('Invitation');
    }

    public function getInvicodeById($userId){
        return $this -> _db -> where('userId = ' . $userId) -> find();
    }

    public function updateInvicode($data,$invicode){
        $info['userId'] = $data['id'];
        $info['nickName'] = $data['nickname'];
        $info['invitationUtime'] = time();

        return $this -> _db -> where('invitationCode = "' . $invicode . '"') -> save($info);
    }

    public function getOneByInvicode($invicode){
        $where = [
            'invitationCode' => $invicode,
        ];

        return $this -> _db -> field('userId') -> where($where) -> find();
    }
}