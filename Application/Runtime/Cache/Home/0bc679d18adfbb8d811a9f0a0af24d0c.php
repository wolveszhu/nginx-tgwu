<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">
    <title>糖果屋</title>
    <meta name="keywords" content="糖果屋,玩具,坚果,糖果,饮料,进口食品,卤食,肉类制品,蜜饯果干">
    <meta name="description" content="糖果屋,您购物的一站式天堂">
    <link rel="stylesheet" href="/Public/Home/Css/index.css" type="text/css">
    <link rel="stylesheet" href="/Public/Css/bootstrap.min.css" type="text/css">
    <script src="/Public/Js/jquery.min.js"></script>
    <script src="/Public/Js/bootstrap.min.js"></script>
    <script src="/Public/Home/Js/index.js"></script>
    <script src="/Public/Js/layer/layer.js"></script>
    <script src="/Public/Js/dialog.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#myCarousel').carousel({interval: 5000});
        });
    </script>
</head>
<body id="body">
<!--轮播图部分-->
<div id="myCarousel" class="carousel slide">
    <!-- 轮播（Carousel）项目 -->
    <div class="carousel-inner tgDet">
        <div class="item active">
            <img src="<?php echo (getUrl($ware["warecover"])); ?>" class="tangguo" alt="juhuasuan">
        </div>
        <div class="item">
            <img src="/Public/Home/Image/tangguoDet.png" class="tangguo" alt="zhui">
        </div>
    </div>
    <!-- 轮播（Carousel）导航 -->
    <a class="carousel-control left" href="#myCarousel" data-slide="prev"></a>
    <a class="carousel-control right" href="#myCarousel" data-slide="next"></a>
</div>
<div class="desDet">
    <div class="det"><?php echo ($ware["waredesc"]); ?></div>
    <div class="lable1"><?php echo ($ware["warecode"]); ?></div>
</div>
</body>
<script type="text/javascript">
    var width = $(window).innerWidth();
    var height = width / 1.5;
    var tangguo = $(".tangguo");
    tangguo.css({
        width:width,
        height:height
    });
</script>
</html>