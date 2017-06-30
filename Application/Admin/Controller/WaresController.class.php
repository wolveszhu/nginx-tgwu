<?php
/**
 * Created by PhpStorm.
 * User: Administrator:stimmer
 * Date: 2017/6/14
 * Time: 11:01
 */

namespace Admin\Controller;

use Think\Exception;
use Think\Page;

class WaresController extends CommonController {
    public function index(){
        $p = $_GET['p'] ? $_GET['p'] : 1;
        $pageSize = 5;
        $waresPage = D('Wares') -> getWaresPage($p,$pageSize);
        $waresCount = D('Wares') -> getWaresCount();
        $page = new Page($waresCount,$pageSize);
        $res = $page -> show();
        $this -> assign('wares',$waresPage);
        $this -> assign('page',$res);
        $this -> display();
    }

    public function add(){
        if($_POST){
            if(!isset($_POST['wareName']) || !$_POST['wareName']){
                return show(0,'名称不存在');
            }
            if(!isset($_POST['categoryId']) || !$_POST['categoryId']){
                return show(0,'分类不存在');
            }
            if(!isset($_POST['wareCover']) || !$_POST['wareCover']){
                return show(0,'封面图不存在');
            }
            if(!isset($_POST['wareMstChart']) || !$_POST['wareMstChart']){
                return show(0,'主题图不存在');
            }
            if(!isset($_POST['wareDesc']) || !$_POST['wareDesc']){
                return show(0,'描述不存在');
            }
            if(!isset($_POST['warePrice']) || !$_POST['warePrice']){
                return show(0,'价格不存在');
            }
            if(!isset($_POST['status']) || !$_POST['status']){
                return show(0,'状态不存在');
            }
            if(!isset($_POST['wareCode']) || !$_POST['wareCode']){
                return show(0,'货号不存在');
            }
            if(!isset($_POST['inventory']) || !$_POST['inventory']){
                return show(0,'库存数不存在');
            }

            if($_POST['id']){
                return $this -> save($_POST);
            }

            $carouselId = D('Wares') -> insert($_POST);

            if($carouselId){
                return show(1,'新增成功');
            }else{
                return show(0,'新增失败');
            }
        } else {
            $categorys = D('Category') -> getCategorysName();
            $this -> assign('categorys',$categorys);
            $this -> display();
        }
    }

    public function edit(){
        $wareId = $_GET['id'];

        if(!$wareId){
            $this -> redirect('index');
        }
        $ware = D('Wares') -> getWareById($wareId);

        if(!$ware){
            $this -> redirect('index');
        }
        $categorys = D('Category') -> getCategorysName();
        $this -> assign('categorys',$categorys);
        $this -> assign('ware',$ware);
        $this -> display();
    }

    public function save($data){
        $wareId = $data['id'];
        unset($data['id']);

        try{
            $wareNewId = D('Wares') -> updateWarelById($wareId,$data);
            if($wareNewId === false){
                return show(0,'数据更新失败');
            }
            return show(1,'更新成功');
        }catch (Exception $exception){
            return show(0,$exception -> getMessage());
        }
    }
    public function delete(){
        try{
            if($_POST){
                $wareId = $_POST['id'];
                if(!$wareId){
                    return show(0,"ID不存在");
                }
                $res = D('Wares') -> deleteWareById($wareId);
                if(!$res){
                    return show(0,"删除失败");
                }else{
                    return show(1,"删除成功");
                }
            }
            return show(0,"没有提交任何内容");
        }catch (Exception $exception){
            return show(0,$exception -> getMessage());
        }
    }

    public function setStatus(){
        try{
            if($_POST){
                $wareId = $_POST['id'];
                unset($_POST['id']);

                if(!$wareId){
                    return show(0,'ID不存在');
                }

                $res = D('Wares') -> updateWareStatusById($wareId,$_POST);
                if(!$res){
                    return show(0,'更新失败');
                }else{
                    return show(1,'更新成功');
                }
            }
            return show(0,'没有提交任何内容');
        }catch (Exception $exception){
            return show(0,$exception -> getMessage());
        }
    }

    public function listorder(){
        $wareSort = $_POST['waresort'];
        $jumpUrl = $_SERVER['HTTP_REFERER'];
        $errors = [];

        try{
            if($wareSort){
                foreach ($wareSort as $item => $value){
                    $id = D('Wares') -> updateWareSortById($item,$value);
                    if($id === false){
                        $errors[] = $item;
                    }
                }
                if($errors){
                    return show(0,'排序失败',array('jump_url' => $jumpUrl));
                }
                return show(1,'排序成功',array('jump_url' => $jumpUrl));
            }
        }catch (Exception $exception){
            return show(0,$exception -> getMessage());
        }
        return show(0,'数据排序失败',array('jump_url' => $jumpUrl));
    }
}























