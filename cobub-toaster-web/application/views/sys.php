<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Start Bootstrap - SB Admin Version 2.0 Demo</title>

    <!-- Core CSS - Include with every page -->
    <link href="<?php echo $this->config->item('base_url');?>/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo $this->config->item('base_url');?>/assets/font-awesome/css/font-awesome.css" rel="stylesheet">

    <!-- Page-Level Plugin CSS - Tables -->
    <link href="<?php echo $this->config->item('base_url');?>/assets/css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">

    <!-- SB Admin CSS - Include with every page -->
    <link href="<?php echo $this->config->item('base_url');?>/assets/css/sb-admin.css" rel="stylesheet">

</head>

<body>

    <div id="wrapper">
		        <nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php"><img alt="Cobub Toaster Web Console" src="<?php echo $this->config->item('base_url');?>/assets/img/cobub_logo.png" style="width: 30px;height: 30px;"> Cobub Toaster Web Console V1.0</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">

                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="<?php echo $this->config->item('base_url');?>/index.php/profile"><i class="fa fa-user fa-fw"></i> 我的资料</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="<?php echo $this->config->item('base_url');?>/index.php/dashboard/logout"><i class="fa fa-sign-out fa-fw"></i> 登出</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default navbar-static-side" role="navigation">
                <div class="sidebar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                            <a href="<?php echo $this->config->item('base_url');?>"><i class="fa fa-dashboard fa-fw"></i> 控制面板</a>
                        </li>
                        <li>
                            <a href="<?php echo $this->config->item('base_url');?>/index.php/push"><i class="fa fa-sitemap fa-fw"></i> 新建推送任务</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> 报表<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo $this->config->item('base_url');?>/index.php/reports">全部应用</a>
                                </li>
                                <li>
                                    <a href="<?php echo $this->config->item('base_url');?>/index.php/reports/app">单个应用报表</a>
                                </li>
                                <li>
                                    <a href="<?php echo $this->config->item('base_url');?>/index.php/reports/timephase">时间段报表</a>
                                </li>
                                <li>
                                    <a href="<?php echo $this->config->item('base_url');?>/index.php/reports/tasks">推送任务报表</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-wrench fa-fw"></i> 应用管理<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo $this->config->item('base_url');?>/index.php/appman">应用列表</a>
                                </li>
                                <li>
                                    <a href="<?php echo $this->config->item('base_url');?>/index.php/appman/addapp">新建应用</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="<?php echo $this->config->item('base_url');?>/index.php/sys"><i class="fa fa-gear"></i> PNS配置</a>
                        </li>
                    </ul>
                    <!-- /#side-menu -->
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>
        <div id="page-wrapper">
			<div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">PNS配置</h1>
                </div>
                
                <!-- /.col-lg-12 -->
            </div>
            
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            请在此处配置PNS服务器
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form role="form" method="POST" action="<?php echo $this->config->item('base_url');?>/index.php/sys">
                                        <div class="form-group">
                                            <label>PNS服务器地址</label>
                                            <input class="form-control" name="server_add" placeholder="输入PNS的服务器地址，域名或者IP" value="<?php echo $pns->server_add;?>">
                                            <br/>
                                            <label>PNS服务器端口</label>
                                            <input class="form-control" name="server_port" placeholder="PNS的服务器的HTTP服务端口" value="<?php echo $pns->server_port;?>">
                                            <br/>
                                            <button type="submit" class="btn btn-primary btn-lg">保存</button>
                                        </div>
                                        <div class="form-group">
                                            <label>当前PNS服务器状态：</label>
                                            <p class="form-control-static">正常或错误<?php echo $status;?></p>
                                            <label>当前PNS服务器版本：</label>
                                            <p class="form-control-static">正常或错误</p>
                                            
                                        </div>
                                    </form>
                                </div>
                                <!-- /.col-lg-6 (nested) -->

                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Core Scripts - Include with every page -->
    <script src="<?php echo $this->config->item('base_url');?>/assets/js/jquery-1.10.2.js"></script>
    <script src="<?php echo $this->config->item('base_url');?>/assets/js/bootstrap.min.js"></script>
    <script src="<?php echo $this->config->item('base_url');?>/assets/js/plugins/metisMenu/jquery.metisMenu.js"></script>

    <!-- Page-Level Plugin Scripts - Tables -->
    <script src="<?php echo $this->config->item('base_url');?>/assets/js/plugins/dataTables/jquery.dataTables.js"></script>
    <script src="<?php echo $this->config->item('base_url');?>/assets/js/plugins/dataTables/dataTables.bootstrap.js"></script>

    <!-- SB Admin Scripts - Include with every page -->
    <script src="<?php echo $this->config->item('base_url');?>/assets/js/sb-admin.js"></script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#dataTables-example').dataTable();
    });
    </script>

</body>

</html>
