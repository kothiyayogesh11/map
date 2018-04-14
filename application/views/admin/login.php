<!DOCTYPE html>

<html lang="en">

    <head>

    	<meta charset="utf-8">

        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Welcome <?php echo PROJECTNAME; ?></title>

        <link href="<?php echo base_url() ?>assets/admin/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">

        <link href="<?php echo base_url() ?>assets/admin/css/minified/bootstrap.min.css" rel="stylesheet" type="text/css">

        <link href="<?php echo base_url() ?>assets/admin/css/minified/core.min.css" rel="stylesheet" type="text/css">

        <link href="<?php echo base_url() ?>assets/admin/css/minified/components.min.css" rel="stylesheet" type="text/css">

        <link href="<?php echo base_url() ?>assets/admin/css/minified/colors.min.css" rel="stylesheet" type="text/css">

        <link href="<?php echo base_url() ?>assets/admin/css/extras/animate.min.css" rel="stylesheet" type="text/css">

        <script type="text/javascript" src="<?php echo base_url() ?>assets/admin/js/plugins/loaders/pace.min.js"></script>

        <script type="text/javascript" src="<?php echo base_url() ?>assets/admin/js/core/libraries/jquery.min.js"></script>

        <script type="text/javascript" src="<?php echo base_url() ?>assets/admin/js/core/libraries/bootstrap.min.js"></script>

        <script type="text/javascript" src="<?php echo base_url() ?>assets/admin/js/plugins/loaders/blockui.min.js"></script>

        <script type="text/javascript" src="<?php echo base_url() ?>assets/admin/js/core/app.js"></script>        

    </head>

    <body>

        <div class="navbar navbar-inverse">

            <div class="navbar-header"><a class="navbar-brand" href="index.html" style="font-size: 25px;"><?php echo PROJECTNAME ?></a></div>

        </div>

        <div class="page-container login-container">

            <div class="page-content">

                <div class="content-wrapper">

                    <div class="content">

                        <ul class="nav nav-tabs">

                          <li class="active"><a data-toggle="tab" href="#admin-login">Admin Login</a></li>

                          <li><a data-toggle="tab" href="#party-login">Sub Admin Login</a></li>

                        </ul>

                        <div class="tab-content">

                        	<div id="admin-login" class="tab-pane fade in active">

                            <form  action="<?php echo base_url('admin/login/admin_process'); ?>" method="POST">

                            	<div class="panel panel-body login-form animated bounceInDown" >

                                    <div class="text-center">

                                        <div class="icon-object border-slate-300 text-slate-300"><i class="icon-user"></i></div>

                                        <h5 class="content-group">Login to your account <small class="display-block">Enter your credentials below</small></h5>

                                    </div>

                                    <div><?php echo $this->session->flashdata('message'); ?></div>

                                    <div class="form-group has-feedback has-feedback-left">

                                        <input name="Email" type="text" class="form-control" placeholder="Username" value="" required autofocus>

                                        <div class="form-control-feedback"><i class="icon-user text-muted"></i></div>

                                    </div>

                                    <div class="form-group has-feedback has-feedback-left">

                                        <input name="Password" type="password" class="form-control" value="" placeholder="Password" required>

                                        <div class="form-control-feedback"><i class="icon-lock2 text-muted"></i></div>

                                    </div>

                                    <div class="form-group">

                                        <button type="submit" class="btn bg-teal btn-block ">Sign in <i class="icon-circle-right2 position-right"></i></button>

                                    </div>

                                    <div class="text-center"><a href="login_password_recover.html">Forgot password?</a></div>

                                </div>

                            </form>

                          	</div>

                            <div id="party-login" class="tab-pane fade ">

                          	<form action="<?php echo base_url('admin/login/sub_admin_process'); ?>" method="POST">

                                <div class="panel panel-body login-form animated bounceInDown" >

                                    <div class="text-center">

                                        <div class="icon-object border-slate-300 text-slate-300"><i class="icon-user"></i></div>

                                        <h5 class="content-group">Login to your account <small class="display-block">Enter your credentials below</small></h5>

                                    </div>

                                    <div><?php echo $this->session->flashdata('message'); ?></div>

                                    <div class="form-group has-feedback has-feedback-left">

                                        <input name="Email" type="text" class="form-control" placeholder="Party Code OR Mobile" value="" required>

                                        <div class="form-control-feedback"><i class="icon-user text-muted"></i></div>

                                    </div>

                                    <div class="form-group has-feedback has-feedback-left">

                                        <input name="Password" type="password" class="form-control" value="" placeholder="Password" required>

                                        <div class="form-control-feedback"><i class="icon-lock2 text-muted"></i></div>

                                    </div>

                                    <div class="form-group">

                                        <button type="submit" class="btn bg-teal btn-block ">Sign in <i class="icon-circle-right2 position-right"></i></button>

                                    </div>

                                    <div class="text-center"><a href="login_password_recover.html">Forgot password?</a></div>

                                </div>

                            </form>

                        </div>

                        <div class="footer text-muted">&copy; 2018. <a href="#"><?php echo PROJECTNAME ?></a></div>

                    </div>

                </div>

            </div>

        </div>

    </body>

</html>