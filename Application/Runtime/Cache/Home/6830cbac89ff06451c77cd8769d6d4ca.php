<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">
    <title>糖果屋</title>
    <meta name="keywords" content="糖果屋,玩具,坚果,糖果,饮料,进口食品,卤食,肉类制品,蜜饯果干">
    <meta name="description" content="糖果屋,您购物的一站式天堂">
    <link rel="stylesheet" href="/tangguowu/Public/Home/Css/index.css" type="text/css">
    <link rel="stylesheet" href="/tangguowu/Public/Css/bootstrap.min.css" type="text/css">
    <script src="/tangguowu/Public/Home/Js/index.js"></script>
</head>
<body>
    <div class="container scAll">
        <div class="row">
            <div class="col-xs-2 userPho"><img src="<?php echo (getUrl($user["userphoto"])); ?>" class="img-circle user"></div>
            <div class="col-xs-10"><?php echo ($user["nickname"]); ?></div>
        </div>
        <div class="row proSc">
            <div class="col-xs-2 userPho"><img src="/tangguowu/Public/Image/coll.png" class="user"></div>
            <div class="col-xs-10">我的收藏</div>
        </div>
    </div>
</body>
<script src="/tangguowu/Public/Js/jquery.min.js"></script>
<script src="/tangguowu/Public/Js/bootstrap.min.js"></script>
<script type="text/javascript">
    var height = $(".userPho").height() - 10;
    var user = $(".user");
    user.attr("height",height);
    user.attr("width",height);

    var height = $(".proSc").height() - 10;
    var user = $(".userSc");
    user.attr("height",height);
    user.attr("width",height);
</script>
</html>