<?php
/**
 * Created by PhpStorm.
 * User: Administrator:stimmer
 * Date: 2017/6/14
 * Time: 10:56
 */

namespace Home\Model;
use Think\Exception;
use Think\Model;

class CategoryModel extends Model {
    private $_db = '';

    public function __construct(){
        $this -> _db = M('Category');
    }

    public function getCategorys(){
        $data = [
            'categorysort' => 'desc',
            'id' => 'desc',
        ];

        $where = [
            'status' => '1',
        ];
        return $this -> _db -> where($where) -> order($data) -> limit(8) -> select();
    }

    public function getCategoryPage($page,$pageSize){
    $data = [
        'categorysort' => 'desc',
        'id' => 'desc',
    ];
    $page = $page == 0 ? 1 : $page;
    $offset = ($page - 1) * $pageSize;
    return $this -> _db -> order($data) -> limit($offset,$pageSize) -> select();
}

    public function getCategoryCount(){
        return $this -> _db -> count('id');
    }


    public function getCategoryById($id){
        return $this -> _db -> where('id = ' . $id) -> find();
    }
}