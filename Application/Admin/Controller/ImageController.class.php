<?php
/**
 * Created by PhpStorm.
 * User: Administrator:stimmer
 * Date: 2017/6/15
 * Time: 15:55
 */

namespace Admin\Controller;
use Admin\Model\ImageUploadModel;
use Think\Controller;

class ImageController extends Controller{
    private $_uploadObj;
    public function __construct() {

    }
    public function ajaxuploadimage() {
        $upload = D("ImageUpload");
        $res = $upload->imageUpload();
        if($res===false) {
            return show(0,'上传失败','');
        }else{
            return show(1,'上传成功',$res);
        }

    }
    public function kindupload(){
        $upload = D("ImageUpload");
        $res = $upload->upload();
        if($res === false) {
            return showKind(1,'上传失败');
        }
        return showKind(0,$res);
    }
}