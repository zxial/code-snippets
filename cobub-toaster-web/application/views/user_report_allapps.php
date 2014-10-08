<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Cobub Toaster Web Console version: <?php echo $this->config->item('console_version');?></title>

    <!-- Core CSS - Include with every page -->
    <link href="<?php echo $this->config->item('base_url');?>/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo $this->config->item('base_url');?>/assets/font-awesome/css/font-awesome.css" rel="stylesheet">

    <!-- Page-Level Plugin CSS - Morris -->
    <link href="<?php echo $this->config->item('base_url');?>/assets/css/plugins/morris/morris-0.4.3.min.css" rel="stylesheet">
    

    <!-- SB Admin CSS - Include with every page -->
    <link href="<?php echo $this->config->item('base_url');?>/assets/css/sb-admin.css" rel="stylesheet">
    <link rel="shortcut icon" href="<?php echo $this->config->item('base_url');?>/assets/img/favicon.ico">
    <script src="<?php echo $this->config->item('base_url');?>/assets/js/jquery-1.10.2.js"></script>
    <script src="<?php echo $this->config->item('base_url');?>/assets/js/plugins/morris/raphael-2.1.0.min.js"></script>
    <script src="<?php echo $this->config->item('base_url');?>/assets/js/plugins/morris/morris.js"></script>
     
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
                    <h1 class="page-header">全部应用报表</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div id="morris-chart"></div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <script type="text/javascript">
                $(function() {

                    Morris.Line({
                        element: 'morris-chart',
                        data: <?php echo json_encode($app_report_data->result());?>,
                        xkey: 'rtime',
                        ykeys: ['onlinev', 'allv'],
                        labels: ['在线人数', '总人数'],
                        resize: true
                    });

                });

                </script>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            点击链接选择其他应用的报表
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div>
                            	<table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>应用名称</th>
                                            <th>应用报表</th>
                                            <th>时间段报表</th>
                                        </tr>
                                    </thead>
                                    <tbody>
 	                        <?php 
 	                        	$i = 1;
	                        	foreach ($apps->result() as $row)
	                            {
	                                	echo '<tr><td>'.$i++.'</td>';
	                                	echo '<td>'.$row->appname.'</td>';
	                                	
	                            		echo '<td><a href="reports/app?appid='.$row->appkey.'">应用报表</a></td>';
	                                    echo '<td><a type="button" class="btn btn-info" href="reports/timephase?appid='.$row->appkey.'">时间段报表</a></td>';
	                                    echo '</tr>';
	                            }
	                                    
	                        ?>
                                    </tbody>
                                </table>
	                        
                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Core Scripts - Include with every page -->
    <script src="<?php echo $this->config->item('base_url');?>/assets/js/bootstrap.min.js"></script>
    <script src="<?php echo $this->config->item('base_url');?>/assets/js/plugins/metisMenu/jquery.metisMenu.js"></script>

    <!-- Page-Level Plugin Scripts - Blank -->
   
    <!-- SB Admin Scripts - Include with every page -->
    <script src="<?php echo $this->config->item('base_url');?>/assets/js/sb-admin.js"></script>

    <!-- Page-Level Demo Scripts - Blank - Use for reference -->
    
    <!-- script src="<?php echo $this->config->item('base_url');?>/assets/js/demo/morris-demo.js"></script-->
    
</body>

</html>
