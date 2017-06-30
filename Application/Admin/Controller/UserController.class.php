<?php
/**
 * Created by PhpStorm.
 * User: Administrator:stimmer
 * Date: 2017/6/13
 * Time: 16:00
 */

namespace Admin\Controller;

use Think\Page;

class UserController extends CommonController
{
    public function index()
    {
        $p = $_GET['p'] ? $_GET['p'] : 1;
        $pageSize = 5;
        $usersPage = D('User')->getUsersPage($p, $pageSize);
        $usersCount = D('User')->getUsersCount();
        $page = new Page($usersCount, $pageSize);
        $res = $page->show();
        $this->assign('users', $usersPage);
        $this->assign('page', $res);
        $this->display();
    }

    public function setStatus()
    {
        try {
            if ($_POST) {
                $userId = $_POST['id'];
                unset($_POST['id']);

                if (!$userId) {
                    return show(0, 'ID不存在');
                }

                $res = D('User')->updateUserStatusById($userId, $_POST);
                if (!$res) {
                    return show(0, '更新失败');
                } else {
                    return show(1, '更新成功');
                }
            }
            return show(0, '没有提交任何内容');
        } catch (Exception $exception) {
            return show(0, $exception->getMessage());
        }
    }

    public function delete()
    {
        try {
            if ($_POST) {
                $userId = $_POST['id'];
                if (!$userId) {
                    return show(0, "ID不存在");
                }
                $res = D('User')->deleteUserById($userId);
                if (!$res) {
                    return show(0, "删除失败");
                } else {
                    return show(1, "删除成功");
                }
            }
            return show(0, "没有提交任何内容");
        } catch (Exception $exception) {
            return show(0, $exception->getMessage());
        }
    }

    public function edit()
    {
        $userId = $_GET['id'];

        if (!$userId) {
            $this->redirect('index');
        }
        $user = D('User')->getUserById($userId);

        if (!$user) {
            $this->redirect('index');
        }

        $this->assign('user', $user);
        $this->display();
    }

    public function update()
    {
        if (!isset($_POST['id']) || !$_POST['id']) {
            return show(0, '没有选中用户');
        }
        if (!isset($_POST['nickName']) || !$_POST['nickName']) {
            return show(0, '昵称不存在');
        }
        if (!isset($_POST['userPhoto']) || !$_POST['userPhoto']) {
            return show(0, '用户头像不存在');
        }
        if (!isset($_POST['userCollNum']) || !$_POST['userCollNum']) {
            return show(0, '用户收藏数不存在');
        }
        if (!isset($_POST['status']) || !$_POST['status']) {
            return show(0, '状态不存在');
        }

        if ($_POST['id']) {
            $userId = $_POST['id'];
            unset($_POST['id']);
            try{
                if(trim($_POST['password']) != D('User') -> getPasswordById($userId)){
                    $_POST['password'] = getMd5Password($_POST['password']);
                }
                $userNewId = D('User') -> updateUserById($userId,$_POST);
                if($userNewId === false){
                    return show(0,'数据更新失败');
                }
                return show(1,'更新成功');
            }catch (Exception $exception){
                return show(0,$exception -> getMessage());
            }
        }else{
            return show(0,'ID不存在');
        }

    }
}