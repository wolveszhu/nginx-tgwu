<?php
/**
 * Created by PhpStorm.
 * User: Administrator:stimmer
 * Date: 2017/6/14
 * Time: 11:02
 */

namespace Home\Model;
use Think\Model;

class WaresModel extends Model{
    private $_db = '';

    public function __construct(){
        $this -> _db = M('Wares');
    }

    public function getWares(){
        $data = [
            'wareSort' => 'desc',
        ];
        $where = [
            'isNew' => '1',
        ];
        return $this -> _db -> where($where) -> order($data) -> limit(0,6) -> select();
    }

    public function getWareById($id){
        return $this -> _db -> where('id = ' . $id) -> find();
    }

    public function getWaresKind($categoryId){
        $where = [
            'categoryId' => $categoryId,
            'status' => '1',
        ];

        $order = [
            'wareSort' => 'desc',
            'id' => 'desc'
        ];
        return $this -> _db -> where($where) -> order($order) -> select();
    }

    public function getWaresDis(){
        return $this -> _db -> query("SELECT * FROM `tgwu_wares` WHERE `status` = '1' AND (( `discount` != '0' ) or ( `cutPrice` != '0' )) ORDER BY `wareDesc` desc ");
    }

    public function getWareHot(){
        $where = [
            'status' => '1',
            'isHot' => '1'
        ];

        $order = [
            'wareSort' => 'desc'
        ];

        return $this -> _db -> where($where) -> order($order) -> select();
    }

    public function getWareNew(){
        $where = [
            'status' => '1',
            'isNew' => '1'
        ];

        $order = [
            'wareSort' => 'desc'
        ];

        return $this -> _db -> where($where) -> order($order) -> select();
    }

    public function collectNumPlus($id){
        return $this -> _db -> where('id = ' . $id) -> setInc('collTimes');
    }
}