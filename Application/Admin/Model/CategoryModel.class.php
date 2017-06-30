<?php
/**
 * Created by PhpStorm.
 * User: Administrator:stimmer
 * Date: 2017/6/14
 * Time: 10:56
 */

namespace Admin\Model;
use Think\Exception;
use Think\Model;

class CategoryModel extends Model {
    private $_db = '';

    public function __construct(){
        $this -> _db = M('Category');
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

    public function deleteCategoryById($id){
        if(!$id || !is_numeric($id)){
            E('ID不合法');
        }

        return $this -> _db -> where('id = ' . $id) -> delete();
    }

    public function updateCategorySortById($id,$categorySort){
        if(!$id || !is_numeric($id)){
            E('ID不合法');
        }
        $data = array('categorySort' => intval($categorySort));

        return $this -> _db -> where('id='.$id) -> save($data);
    }

    public function getCategoryById($id){
        return $this -> _db -> where('id = ' . $id) -> find();
    }

    public function insert($data = array()){
        if(!$data || !is_array($data)){
            return 0;
        }
        return $this -> _db -> add($data);
    }

    public function updateCategoryById($id,$data){
        if(!$id || !is_numeric($id)){
            E("ID不合法");
        }
        if(!$data || !is_array($data)){
            E("更新的数据不合法");
        }
        return $this -> _db -> where('id = ' . $id) -> save($data);
    }

    public function updateCategoryStatusById($id,$data){
        if(!$id || !is_numeric($id)){
            E("ID不合法");
        }
        if(!$data || is_numeric($data)){
            E("更新的数据不合法");
        }
        return $this -> _db -> where('id = ' . $id) -> save($data);
    }

    public function getCategorysName(){
        return $this -> _db -> field('id,categoryName') -> select();
    }
}