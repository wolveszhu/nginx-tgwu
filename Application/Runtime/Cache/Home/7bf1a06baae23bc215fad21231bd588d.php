<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">
    <title>糖果屋</title>
    <meta name="keywords" content="糖果屋,玩具,坚果,糖果,饮料,进口食品,卤食,肉类制品,蜜饯果干">
    <meta name="description" content="糖果屋,您购物的一站式天堂">
    <link rel="stylesheet" href="/Public/Css/bootstrap.min.css" type="text/css">
    <style>
        body {
            background-color: #fff4e2;
        }
        .container {
            background-color: #fff4e2;
            height: auto;
            padding-top: 50px;
        }
        .col-center-block {
            float: none;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }
        h3,h4{
            text-align: center;
        }
        h4{
            color: #FFD733;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row myCenter">
        <div class="col-xs-11 col-sm-6 col-md-4 col-center-block">
            <form class="form-signin" method="post" action="<?php echo U('Invicode/inputIni');?>">
                <h3 class="form-signin-heading">如果您是加盟商/直营店</h3><br/>
                <h4 class="form-signin-heading">请输入您的邀请码</h4>
                <br/><br/>
                <input type="text" id="invicode" name="invicode" class="form-control" placeholder="请输入邀请码" required autofocus><br/>
                <button class="btn btn-lg btn-primary btn-block btn-danger" type="submit">确定</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>