<?php
/**
 * Created by PhpStorm.
 * User: Administrator:stimmer
 * Date: 2017/6/14
 * Time: 10:49
 */

namespace Admin\Controller;

use Think\Exception;
use Think\Page;

class InvitationController extends CommonController
{
    public function index()
    {
        $p = $_GET['p'] ? $_GET['p'] : 1;
        $pageSize = 5;
        $invitations = D('Invitation')->getInvitationPage($p, $pageSize);
        $invCount = D('Invitation')->getInvitationCount();
        $res = new Page($invCount, $pageSize);
        $resPage = $res->show();
        $this->assign('page', $resPage);
        $this->assign('invitations', $invitations);
        $this->display();
    }

    public function add()
    {
        $this->display();
    }

    public function search()
    {
        $code = trim($_POST['invitationCode']);
        if (!$code) {
            $this->redirect('index');
        }
        $res = D('Invitation')->getInvitationByCode($code);
        if (!$res) {
            $this->redirect('index');
        } else {
            $this->assign('invitation', $res);
            $this->display();
        }
    }

    public function delete()
    {
        try {
            if ($_POST) {
                $invitationId = $_POST['id'];
                if (!$invitationId) {
                    return show(0, "ID不存在");
                }

                $res = D('Invitation')->deleteInvitationById($invitationId);
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

    public function nameSearch()
    {
        $name = trim($_POST['invitationName']);
        if (!$name) {
            $this->redirect('index');
        }
        $res = D('Invitation')->getInvitationByName($name);
        if (!$res) {
            $this->redirect('index');
        } else {
            $this->assign('invitations', $res);
            $this->display();
        }
    }

    public function save()
    {
        $num = $_POST['inviNum'];
        $termOfValidity = $_POST['termOfValidity'];
        if (!$num) {
            return show(0, "生成数量没有填入");
        }
        if (!$termOfValidity) {
            return show(0, "有效期没有选择");
        }
        $inviCodes = $this->getInviCodes($num,$termOfValidity);
        $arrcount = count($inviCodes);
        for($i = 0;$i < $arrcount;$i ++){
            $res = D('Invitation') -> insert($inviCodes[$i]);
            if(!$res){
                $errors[] = true;
            }
        }
        if($errors){
            return show(0,"生成错误");
        }else{
            return show(1,"生成成功");
        }

    }

    /**
     * @param int $num 生成邀请码的数量
     * @return array $codes 返回生成的邀请码和创建时间的二维数组
     */
    public function getInviCodes($num,$termOfValidity)
    {
        $data = array();
        for($i = 0;$i < $num;$i ++){
            $data[$i] = $this -> getInviCode($termOfValidity);
        }
        return $data;
    }

    public function getInviCode($termOfValidity){
        $data = [];
        $code = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $rand = $code[rand(0, 25)]
            . strtoupper(dechex(date('m')))
            . date('d') . substr(time(), -5)
            . substr(microtime(), 2, 5)
            . sprintf('%02d', rand(0, 99));
        for (
            $a = md5($rand, true),
            $s = '0123456789ABCDEFGHIJKLMNOPQRSTUV',
            $d = '',
            $f = 0;
            $f < 6;
            $g = ord($a[$f]),
            $d .= $s[($g ^ ord($a[$f + 8])) - $g & 0x1F],
            $f++
        ) ;
        $time = time();
        if($termOfValidity == -1){
            $etime = '-1';
        }else{
            $etime = $time + $termOfValidity*30*24*60*60;
        }
        $data = [
            'invitationCode' => $d,
            'invitationCtime' => $time,
            'invitationEtime' => $etime
        ];
        return $data;
    }
}