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
    <!-- 轮播（Carousel）指标 -->
    <ol class="carousel-indicators carouselInd">
        <li data-target="#myCarousel" data-slide-to="0" class="active carouselLi"></li>
        <?php if(is_array($cars)): $i = 0; $__LIST__ = $cars;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$car): $mod = ($i % 2 );++$i;?><li data-target="#myCarousel" data-slide-to="1" class="carouselLi"></li><?php endforeach; endif; else: echo "" ;endif; ?>
    </ol>
    <!-- 轮播（Carousel）项目 -->
    <div class="carousel-inner">
        <div class="item active">
            <?php if(is_array($carousels)): $i = 0; $__LIST__ = $carousels;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$carousel): $mod = ($i % 2 );++$i;?><img src="<?php echo (getUrl($carousel["carouselicon"])); ?>" class="carPto" alt="<?php echo ($carousel["carouseldesc"]); ?>"><?php endforeach; endif; else: echo "" ;endif; ?>
        </div>
        <?php if(is_array($cars)): $i = 0; $__LIST__ = $cars;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$car): $mod = ($i % 2 );++$i;?><div class="item">
                <img src="<?php echo (getUrl($car["carouselicon"])); ?>" class="carPto" alt="<?php echo ($car["carouseldesc"]); ?>">
            </div><?php endforeach; endif; else: echo "" ;endif; ?>
    </div>
    <!-- 轮播（Carousel）导航 -->
    <a class="carousel-control left" href="#myCarousel" data-slide="prev"></a>
    <a class="carousel-control right" href="#myCarousel" data-slide="next"></a>
</div>
<!--导航栏部分-->
<div class="container" id="container">
    <div class="row navbar">
        <?php if(is_array($categorys)): $i = 0; $__LIST__ = $categorys;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$category): $mod = ($i % 2 );++$i;?><div class="col-xs-3">
                <!-- TUDO a标签 图片居中 -->
                <div class="nav">
                    <a href="<?php echo U('Category/index',array('id'=>$category['id']));?>">
                        <img src="<?php echo (getUrl($category["categoryicon"])); ?>" class="cateImg" alt="<?php echo ($category["categoryname"]); ?>">
                    </a>
                </div>
                <div class="cdesc"><?php echo ($category["categoryname"]); ?></div>
            </div><?php endforeach; endif; else: echo "" ;endif; ?>
    </div>
</div>
<!--特价and爆款-->
<div class="bao_te">
    <div class="te"><a href="<?php echo U('Ware/discount');?>" class="newte"><img src="/Public/Image/tejia.png">&nbsp;特价促销</a></div>
    <div class="bao"><a href="<?php echo U('Ware/hotter');?>" class="newte"><img src="/Public/Image/baokuan.png">&nbsp;爆款推荐</a></div>
</div>
<!--新品上市-->
<div class="container" id="container1">
    <div class="row">
        <div class="col-xs-3"></div>
        <div class="col-xs-6 new"><img src="/Public/Image/hengxian.png">&nbsp;新品上架&nbsp;<img
                src="/Public/Image/hengxian.png"></div>
        <div class="col-xs-3 more"><a href="<?php echo U('Ware/more');?>" class="morePro">更多&nbsp;<img
                src="/Public/Image/more.png" class="gengduo"></a></div>
    </div>
    <div class="row">
        <?php if(is_array($wares)): $i = 0; $__LIST__ = $wares;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$ware): $mod = ($i % 2 );++$i;?><div class="col-xs-4 newpro">
                <a href="<?php echo U('Ware/index',array('id'=>$ware['id']));?>">
                    <img src="<?php echo (getUrl($ware["warecover"])); ?>" class="proImg" alt="<?php echo ($ware["waredesc"]); ?>">
                </a>
                <div class="desc"><?php echo ($ware["waredesc"]); ?></div>
                <div class="shoucang">
                    <div class="row">
                        <div class="col-xs-3"><img src="/Public/Image/shoucang.png" attr-id="<?php echo ($ware["id"]); ?>" class="scPto ware-detail"></div>
                        <div class="col-xs-9"><?php echo ($ware["colltimes"]); ?>人已收藏</div>
                    </div>
                </div>
            </div><?php endforeach; endif; else: echo "" ;endif; ?>
    </div>
</div>
<div class="bot">
    <div class="leftBot">
        <div class="leftTop"><img src="/Public/Image/amailogo.png" class="amai">阿麦科技</div>
        <div class="leftBottom">amailive.com</div>
    </div>
    <div class="centerBot"><img src="/Public/Image/fengexian.png" class="fenggexian"></div>
    <div class="rightBot">技术支持</div>
</div>
</body>
<script>
    var SCOPE = {
        'coll_url' : '<?php echo U("collect");?>',
        'root' : ''
    }
</script>
<script type="text/javascript">
//    var widthDev = document.documentElement.clientWidth;
    var widthDev = $(window).innerWidth();
    var heightDev = widthDev / 1.5;
    var carPto = $(".carPto");
    carPto.css({
        width:widthDev,
        height:heightDev
    });

    var navWH = $(".nav").width();

    var cateImgWH = $(".cateImg");
    cateImgWH.attr('width', navWH);
    cateImgWH.attr('height', navWH);

    var width = $(".newpro").width() * 0.9;
    var height = width * 1.5;
    var imgWH = $(".proImg");
    imgWH.attr('width', width);
    imgWH.attr('height', height);
    var desc = $(".desc");
    desc.attr('width', width);
</script>
</html>