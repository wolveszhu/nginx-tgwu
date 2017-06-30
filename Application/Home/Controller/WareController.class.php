<?php
/**
 * Created by PhpStorm.
 * User: Administrator:stimmer
 * Date: 2017/6/6
 * Time: 13:00
 */
namespace Home\Controller;
use Think\Controller;

class WareController extends Controller {
    public function index(){
        $id = intval($_GET['id']);
        $ware = D('Wares') -> getWareById($id);
        $this -> assign('ware',$ware);
        $this -> display();
    }

    public function discount(){
        $wares = D('Wares') -> getWaresDis();
        $this -> assign('wares',$wares);
        $this -> display();
    }

    public function hotter(){
        $wares = D('Wares') -> getWareHot();
        $this -> assign('wares',$wares);
        $this -> display();
    }

    public function more(){
        $wares = D('Wares') -> getWareNew();
        $this -> assign('wares',$wares);
        $this -> display();
    }
}