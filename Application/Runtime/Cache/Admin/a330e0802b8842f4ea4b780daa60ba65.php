<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>糖果屋后台管理平台</title>
    <!-- Bootstrap Core CSS -->
    <link href="/Public/Css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="/Public/Admin/Css/sb-admin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="/Public/Css/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="/Public/Css/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="/Public/Admin/Css/common.css" />
    <link rel="stylesheet" href="/Public/Css/bootstrap-switch.css" />
    <link rel="stylesheet" type="text/css" href="/Public/Css/uploadify/uploadify.css">

    <!-- jQuery -->
    <script src="/Public/Js/jquery.min.js"></script>
    <script src="/Public/Js/bootstrap.min.js"></script>
    <script src="/Public/Js/layer/layer.js"></script>
    <script src="/Public/Js/dialog.js"></script>
    <script type="text/javascript" src="/Public/Js/uploadify/jquery.uploadify.js"></script>

</head>

    



<body>

<div id="wrapper">

    <!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">

        <a class="navbar-brand">糖果屋内容管理平台</a>
    </div>
    <!-- Top Menu Items -->
    <ul class="nav navbar-right top-nav">


        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <b class="caret"></b></a>
            <ul class="dropdown-menu">
                <li>
                    <a href="<?php echo U('Admin/personal');?>"><i class="fa fa-fw fa-user"></i> 个人中心</a>
                </li>

                <li class="divider"></li>
                <li>
                    <a href="<?php echo U('Login/logout');?>"><i class="fa fa-fw fa-power-off"></i> 退出</a>
                </li>
            </ul>
        </li>
    </ul>
    <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
    <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav side-nav nav_list">
            <li>
                <a href="<?php echo U('Index/index');?>"><i class="fa fa-fw fa-dashboard"></i>  首页</a>
            </li>
            <li>
                <a href="<?php echo U('Carousel/index');?>"><i class="fa fa-fw fa-bar-chart-o"></i>  轮播图管理</a>
            </li>
            <li>
                <a href="<?php echo U('Invitation/index');?>"><i class="fa fa-fw fa-bar-chart-o"></i>  邀请码管理</a>
            </li>
            <li>
                <a href="<?php echo U('Category/index');?>"><i class="fa fa-fw fa-bar-chart-o"></i>  分类管理</a>
            </li>
            <li>
                <a href="<?php echo U('Wares/index');?>"><i class="fa fa-fw fa-bar-chart-o"></i>  商品管理</a>
            </li>
            <li>
                <a href="<?php echo U('User/index');?>"><i class="fa fa-fw fa-bar-chart-o"></i>  用户管理</a>
            </li>
        </ul>
    </div>
</nav>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">

                    <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-dashboard"></i> <a href="<?php echo U('Invitation/index');?>">邀请码管理</a>
                        </li>
                        <li class="active">
                            <i class="fa fa-table"></i>查看邀请码
                        </li>
                    </ol>
                </div>
            </div>
            <!-- /.row -->

            <div>
                <button id="button-add" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-plus"
                                                                         aria-hidden="true"></span>生成邀请码
                </button>
            </div>
            <div class="row">
                <form action="<?php echo U('Invitation/search');?>" method="post">
                    <div class="col-md-2">
                        <div class="input-group search">
                            <input class="form-control" name="invitationCode" id="code" type="text" value="" placeholder="邀请码"/>
                            <span class="input-group-btn">
                                <button id="singcms-search" class="btn btn-primary"><i class="glyphicon glyphicon-search"></i></button>
                            </span>
                        </div>
                    </div>
                </form>
                <form action="<?php echo U('Invitation/nameSearch');?>" method="post">
                    <div class="col-md-2">
                        <div class="input-group search">
                            <input class="form-control" name="invitationName" id="nameSearch" type="text" value="" placeholder="用户昵称"/>
                            <span class="input-group-btn">
                                <button id="name-search" class="btn btn-primary"><i class="glyphicon glyphicon-search"></i></button>
                            </span>
                        </div>
                    </div>
                </form>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <h3></h3>
                    <div class="table-responsive">
                        <form id="singcms-listorder">
                            <table class="table table-bordered table-hover singcms-table">
                                <thead>
                                <tr>
                                    <th>邀请码编号</th>
                                    <th>用户编号</th>
                                    <th>用户昵称</th>
                                    <th>邀请码</th>
                                    <th>邀请码使用时间</th>
                                    <th>邀请码创建时间</th>
                                    <th>邀请码到期时间</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if(is_array($invitations)): $i = 0; $__LIST__ = $invitations;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$invitation): $mod = ($i % 2 );++$i;?><tr>
                                        <td><?php echo ($invitation["id"]); ?></td>
                                        <td><?php echo (isnull($invitation["userid"])); ?></td>
                                        <td><?php echo (isnull($invitation["nickname"])); ?></td>
                                        <td><?php echo ($invitation["invitationcode"]); ?></td>
                                        <td><?php echo (standTime($invitation["invitationutime"])); ?></td>
                                        <td><?php echo (standTime($invitation["invitationctime"])); ?></td>
                                        <td><?php echo (standTime($invitation["invitationetime"])); ?></td>
                                        <td>
                                            <a href="javascript:void(0)" attr-id="<?php echo ($invitation["id"]); ?>" id="singcms-delete"
                                               attr-a="invitation" attr-message="删除"><span
                                                    class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span></a>
                                        </td>
                                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                                </tbody>
                            </table>
                        </form>
                        <nav class="pagination">
                            <ul>
                                <?php echo ($page); ?>
                            </ul>
                        </nav>
                    </div>
                </div>

            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->
<!-- Morris Charts JavaScript -->
<script>
    var SCOPE = {
        'add_url': '<?php echo U("add");?>',
        'delete_url': '<?php echo U("delete");?>',
        'search_url': '<?php echo U("search");?>',
        'namesearch_url' : '<?php echo U("nameSearch");?>',
    }
</script>

<script src="/Public/Admin/Js/common.js"></script>



</body>

</html>