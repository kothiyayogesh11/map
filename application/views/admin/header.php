<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Dashboard | ADMIN</title>
        <meta name="description" content="ADMIN">
        <meta name="keywords" content="ADMIN">
        <meta name="author" content="">
        
        <!-- Global stylesheets -->
        <!--        <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">-->
        <!--<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>-->
		<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <link href="<?php echo base_url('assets/admin/css/icons/icomoon/styles.css'); ?>" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url('assets/admin/css/minified/bootstrap.min.css'); ?>" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url('assets/admin/css/minified/core.min.css'); ?>" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url('assets/admin/css/minified/components.min.css'); ?>" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url('assets/admin/css/minified/colors.min.css'); ?>" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url('assets/admin/font-awesome/css/font-awesome.css'); ?>" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url('assets/admin/css/general.css'); ?>" rel="stylesheet" type="text/css">
        <!-- /global stylesheets -->
        <!-- Core JS files -->
        
        <script type="text/javascript">  
         var BASE_URL = '<?php echo base_url(); ?>admin/';
        </script>
        <script type="text/javascript" src="<?php echo base_url('assets/admin/js/plugins/loaders/pace.min.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/admin/js/core/libraries/jquery.min.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/admin/js/core/libraries/bootstrap.min.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/admin/js/plugins/loaders/blockui.min.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/admin/js/general.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/admin/js/plugins/shortcut.js'); ?>"></script>
        <!-- /core JS files -->
        
        <link href="<?php echo base_url('assets/admin/js/plugins/loader-waitMe/waitMe.min.css'); ?>" rel="stylesheet" type="text/css"/>
        <script src="<?php echo base_url('assets/admin/js/plugins/loader-waitMe/waitMe.min.js'); ?>" type="text/javascript"></script>
        
        
        <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
        <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
        
        <script type="text/javascript" src="<?php echo base_url('assets/admin/js/plugins/visualization/d3/d3.min.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/admin/js/plugins/visualization/d3/d3_tooltip.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/admin/js/plugins/forms/styling/switchery.min.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/admin/js/plugins/forms/styling/uniform.min.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/admin/js/plugins/forms/selects/bootstrap_multiselect.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/admin/js/plugins/ui/moment/moment.min.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/admin/js/plugins/pickers/daterangepicker.js'); ?>"></script>
        <?php if(isset($assets) && !empty($assets)){ echo $assets; } ?>
        <script type="text/javascript" src="<?php echo base_url('assets/admin/js/core/app.js'); ?>"></script>
        
		<style type="text/css">
			@media only screen and (max-width: 800px) {
			.footer {  position: relative; }
			}
        </style>
    </head>
<body>
    <div class="navbar navbar-inverse">
        <div class="navbar-header">
            <a class="navbar-brand" href="<?php echo base_url('admin/'); ?>"><span style="font-size: 24px; margin-top: 5px;">ADMIN</span></a>
            <ul class="nav navbar-nav visible-xs-block">
                <li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
                <li><a class="sidebar-mobile-main-toggle"><i class="icon-paragraph-justify3"></i></a></li>
            </ul>
        </div>
        <div class="navbar-collapse collapse" id="navbar-mobile">
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown dropdown-user">
                    <a class="dropdown-toggle" data-toggle="dropdown">
                        <span class="btn bg-success-400 btn-rounded btn-icon btn-xs"><span class="letter-icon">A</span></span>
                        <span> Admin</span><i class="caret"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-right">
                        <li><a href="#<?php //echo base_url('admin/dashboard/edit_profile/'.base64_encode($this->session->userdata('id')).'');?>"><i class="icon-user-plus"></i> My profile</a></li>
                        <li class="divider"></li>
                        <li><a href="<?php echo base_url('admin/login/logout"><i class="icon-switch2'); ?>"></i> Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
    <div class="page-container">
        <div class="page-content">