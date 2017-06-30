<?php
namespace Admin\Controller;

class IndexController extends CommonController {
    public function index(){
        $waresCount = D('Wares') -> getWaresCount();
        $waresMaxBrowse = D('Wares') -> getMaxWaresBrowse();
        $this -> assign('waresCount',$waresCount);
        $this -> assign('maxBrowse',$waresMaxBrowse[0]['warename']);
        $this -> display();
    }

}