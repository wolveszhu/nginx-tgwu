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
<!--新品上市-->
<div class="container">
    <div class="row">
        <div class="col-xs-3 ret"><a href="<?php echo U('Index/index');?>" class="morePro"><img src="/Public/Image/ret.png" class="retIcon"></a></div>
        <div class="col-xs-6 new">新品上架</div>
        <div class="col-xs-3"></div>
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
</body>
<script>
    var SCOPE = {
        'coll_url' : '<?php echo U("Index/collect");?>',
    }
</script>
<script type="text/javascript">
    var width = $(".newpro").width() * 0.9;
    var height = width * 1.5;
    var imgWH = $(".proImg");
    imgWH.attr('width',width);
    imgWH.attr('height',height);
    var desc = $(".desc");
    desc.attr('width',width);
</script>
</html>