<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">
    <title>登录---糖果屋后台管理系统</title>
    <meta name="keywords" content="糖果屋,玩具,坚果,糖果,饮料,进口食品,卤食,肉类制品,蜜饯果干">
    <meta name="description" content="糖果屋,您购物的一站式天堂">
    <link rel="stylesheet" href="/Public/Css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="/Public/Admin/Css/login.css" type="text/css">
    <script src="/Public/Js/jquery.min.js"></script>
    <script src="/Public/Js/layer/layer.js"></script>
    <script src="/Public/Js/dialog.js"></script>
    <script src="/Public/Admin/Js/login.js"></script>
    <script src="/Public/Js/bootstrap.min.js"></script>
    <script type="text/javascript">
        $(function () {
            $(window).resize();
        });
    </script>
</head>
<body>
    <div class="login">
        <div class="main">
            <div class="headerMain">欢迎登录糖果屋后台管理系统</div>
            <form method="post" enctype="multipart/form-data">
                <div class="topMain">
                    <label>用户名:</label>
                    <input type="text" name="username" placeholder="请输入管理员名" class="name">
                </div>
                <div class="middleMain">
                    <label>密&nbsp;&nbsp;&nbsp;码:</label>
                    <input type="password" name="password" placeholder="请输入密码" class="pwd">
                </div>
                <div class="bottomMain">
                    <input type="button" value="登录" onclick="login.check()" class="loginBtn">
                </div>
            </form>
        </div>
    </div>
</body>
</html>