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
                    <h1 class="page-header">应用列表</h1>
                </div>
                
                <!-- /.col-lg-12 -->
            </div>
            
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            您当前共有 <?php echo $applist->num_rows();?> 个应用
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>APP名称 </th>
                                            <th>操作系统</th>
                                            <th>描述</th>
                                            <th>Key</th>

                                        </tr>
                                    </thead>
                                    <tbody>
	                                    <?php 
	                                    foreach ($applist->result() as $row)
	                                    {
	                                    	echo '<tr class="gradeX">';
	                                    	echo '<td>'.$row->appname.'</td>';
	                                    	echo '<td>'.$row->ostype.'</td>';
	                                    	echo '<td>'.$row->description.'</td>';
	                                    	echo '<td>'.$row->appkey.'</td>';
	                                    	echo '</tr>';
	                                    }
	                                    
	                                    ?>
                                        

                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->

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
