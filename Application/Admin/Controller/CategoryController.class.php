<?php
/**
 * Created by PhpStorm.
 * User: Administrator:stimmer
 * Date: 2017/6/14
 * Time: 10:54
 */

namespace Admin\Controller;

use Think\Exception;
use Think\Page;

class CategoryController extends CommonController {
    public function index(){
        $page = $_GET['p'] ? $_GET['p'] : 1;
        $pageSize = 5;
        $categorys = D('Category') -> getCategoryPage($page,$pageSize);
        $categorysCount = D('Category') -> getCategoryCount();
        $res = new Page($categorysCount,$pageSize);
        $pageRet = $res -> show();
        $this -> assign('categorys',$categorys);
        $this -> assign('page',$pageRet);
        $this -> display();
    }

    public function delete(){
        try{
            if($_POST){
                $categoryId = $_POST['id'];
                if(!$categoryId){
                    return show(0,'ID不存在');
                }
                $res = D('Category') -> deleteCategoryById($categoryId);
                if(!$res){
                    return show(0,'删除失败');
                }else{
                    return show(1,'删除成功');
                }
            }
            return show('0','没有提交任何内容');
        }catch (Exception $exception){
            return show(0,$exception -> getMessage());
        }
    }

    public function listorder(){
        $categorySort = $_POST['categorysort'];
        $jumpUrl = $_SERVER['HTTP_REFERER'];
        $errors = [];

        try{
            if($categorySort){
                foreach ($categorySort as $item => $value){
                    $id = D('Category') -> updateCategorySortById($item,$value);
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

    public function edit(){
        $categoryId = $_GET['id'];

        if(!$categoryId){
            $this -> redirect('index');
        }
        $category = D('category') -> getCategoryById($categoryId);

        if(!$category){
            $this -> redirect('index');
        }

        $this -> assign('category',$category);
        $this -> display();
    }

    public function add(){
        if($_POST){
            if(!isset($_POST['categoryName']) || !$_POST['categoryName']){
                return show(0,"名称不存在");
            }
            if(!isset($_POST['categoryIcon']) || !$_POST['categoryIcon']){
                return show(0,"缩图不存在");
            }

            if($_POST['id']){
                return $this -> save($_POST);
            }

            $categoryId = D('Category') -> insert($_POST);
            if($categoryId){
                return show(1,"新增成功");
            }else{
                return show(0,"新增失败");
            }
        }else{
            $this -> display();
        }
    }

    public function save($data){
        $categoryId = $data['id'];
        unset($data['id']);

        try{
            $categoryNewId = D('Category') -> updateCategoryById($categoryId,$data);
            if(!$categoryNewId){
                return show(0,"更新数据失败");
            }else{
                return show(1,"数据更新成功");
            }
            return show(0,"没有提交任何数据");
        }catch (Exception $exception){
            return show(0,$exception -> getMessage());
        }
    }

    public function setStatus(){
        try{
            if($_POST){
                $categoryId = $_POST['id'];
                unset($_POST['id']);

                if(!$categoryId){
                    return show(0,'ID不存在');
                }

                $res = D('Category') -> updateCategoryStatusById($categoryId,$_POST);
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
}