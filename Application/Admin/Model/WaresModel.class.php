<?php
/**
 * Created by PhpStorm.
 * User: Administrator:stimmer
 * Date: 2017/6/14
 * Time: 11:02
 */

namespace Admin\Model;
use Think\Model;

class WaresModel extends Model{
    private $_db = '';

    public function __construct(){
        $this -> _db = M('Wares');
    }

    public function getWaresPage($page,$pageSize){
        $data = [
            'wareSort' => 'desc',
        ];
        $offset = ($page - 1) * $pageSize;
        return $this -> _db -> order($data) -> limit($offset,$pageSize) -> select();
    }

    public function getWaresCount(){
        return $this -> _db -> count('id');
    }

    public function insert($data){
        if(!$data || !is_array($data)){
            return 0;
        }

        return $this -> _db -> add($data);
    }

    public function deleteWareById($id){
        if(!$id || !is_numeric($id)){
            E("ID不合法");
        }
        return $this -> _db -> where('id = ' .$id) -> delete();
    }

    public function getWareById($id){
        return $this -> _db -> where('id = ' . $id) -> find();
    }

    public function updateWareStatusById($id,$data){
        if(!$id || !is_numeric($id)){
            E('ID不合法');
        }

        if(!$data || !is_array($data)){
            E('更新数据不合法');
        }

        return $this -> _db -> where('id='.$id) -> save($data);
    }

    public function updateWarelById($id,$data){
        if(!$id || !is_numeric($id)){
            E('ID不合法');
        }
        if(!$data || !is_array($data)){
            E('更新数据不合法');
        }

        return $this -> _db -> where('id=' . $id) -> save($data);
    }

    public function updateWareSortById($id,$wareSort){
        if(!$id || !is_numeric($id)){
            E('ID不合法');
        }
        $data = array('wareSort' => intval($wareSort));

        return $this -> _db -> where('id=' . $id) -> save($data);
    }

    public function getMaxWaresBrowse(){
        return $this -> _db -> distinct(true) -> field('wareName') -> group('collTimes') -> order('collTimes desc') -> limit(1) -> select();
    }
}