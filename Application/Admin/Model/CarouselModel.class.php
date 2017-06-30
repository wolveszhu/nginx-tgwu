<?php
/**
 * Created by PhpStorm.
 * User: Administrator:stimmer
 * Date: 2017/6/14
 * Time: 10:47
 */

namespace Admin\Model;
use Think\Model;

class CarouselModel extends Model{
    private $_db = '';

    public function __construct(){
        $this -> _db = M('carousel');
    }

    /**
     * @return mixed 返回轮播图所有的数据
     */
    public function getCarousels(){
        $data = [
            'carouselSort' => 'desc',
            'id' => 'desc',
        ];
        return $this -> _db -> order($data) -> select();
    }

    public function getCarouselsPage($page,$pageSize){
        $data = [
            'carouselSort' => 'desc',
        ];
        $page = $page == 0 ? 1 : $page;
        $offset = ($page - 1) * $pageSize;

        return $this -> _db -> order($data) -> limit($offset,$pageSize) -> select();
    }

    public function getCarouselCount(){
        return $this -> _db -> count('id');
    }

    /**
     * @param $id 轮播图的编号
     * @return mixed 根据ID返回具体的某个轮播图的信息
     */
    public function getCarouselById($id){
        return $this -> _db -> where('id='.$id) -> find();
    }

    /**
     * @param array $data 需要存入数据库的数据
     * @return int|mixed 如果数据异常，则返回int型的0，成功则返回资源句柄
     */
    public function insert($data = array()){
        if(!$data || !is_array($data)){
            return 0;
        }

        return $this -> _db -> add($data);
    }

    /**
     * @param $id   轮播图编号
     * @param $data 待更新的数据
     * @return bool 返回更新是否成功的标志
     */
    public function updateCarouselById($id,$data){
        if(!$id || !is_numeric($id)){
            E('ID不合法');
        }
        if(!$data || !is_array($data)){
            E('更新数据不合法');
        }

        return $this -> _db -> where('id=' . $id) -> save($data);
    }

    /**
     * @param $id   轮播图编号
     * @return mixed    是否删除成功的标志
     */
    public function deleteCarouselById($id){
        if(!$id || !is_numeric($id)){
            E('ID不合法');
        }

        return $this -> _db -> where('id=' . $id) -> delete();
    }

    /**
     * @param $id   轮播图编号
     * @param $data 待更新的数据
     * @return bool 返回是否更新成功的标志
     */
    public function updateCarouselStatusById($id,$data){
        if(!$id || !is_numeric($id)){
            E('ID不合法');
        }

        if(!$data || !is_array($data)){
            E('更新数据不合法');
        }

        return $this -> _db -> where('id='.$id) -> save($data);
    }

    /**
     * @param $id   轮播图编号
     * @param $carouselSort 轮播图自主排序的值（待更新）
     * @return bool 是否更新成功的标志
     */
    public function updateCarouselSortById($id,$carouselSort){
        if(!$id || !is_numeric($id)){
            E('ID不合法');
        }
        $data = array('carouselSort' => intval($carouselSort));

        return $this -> _db -> where('id=' . $id) -> save($data);
    }

    public function getCarouselstatus(){
        $data = [
            'id' => 'desc',
            'carouselSort' => 'desc'
        ];

        $where = [
            'status' => '1',
        ];

        return $this -> _db -> field('carouselIcon,carouselPath') -> where($where) -> order($data) -> select();
    }
}