<?php
/**
 * Created by PhpStorm.
 * User: Administrator:stimmer
 * Date: 2017/6/6
 * Time: 11:11
 */
namespace Home\Controller;

use Think\Controller;

class CategoryController extends Controller {
    public function index(){
        $id = intval($_GET['id']);
        $categoryName = D('Category') -> getCategoryById($id);
        $this -> assign('category',$categoryName);

        $wares = D('Wares') -> getWaresKind($id);
        $this -> assign('wares',$wares);
        $this -> display();
    }
}