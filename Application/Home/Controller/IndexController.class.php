<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        $carousels = D('Carousel') -> getCarouselstatusOne();
        $this -> assign('carousels',$carousels);

        $cars = D('Carousel') -> getCarouselstatus();
        $this -> assign('cars',$cars);

        $categorys = D('Category') -> getCategorys();
        $this -> assign('categorys',$categorys);
        $userId = session('UserOpenId');
        $this -> assign('userIds',$userId);
        $wares = D('Wares') -> getWares();
        $this -> assign('wares',$wares);
        $this -> display();
    }

    public function collect(){
        $id = intval($_POST['id']);
//        $openId = session('UserOpenId');
//        $userId = D('User') -> getIdByOpenId($openId);
//        $input = D('Usercoll') -> insert($userId,$id);
        $res = D('Wares') -> collectNumPlus($id);
        if(!$res){
            return show(0,"收藏失败");
        }else{
            return show(1,"收藏成功");
        }
    }
}