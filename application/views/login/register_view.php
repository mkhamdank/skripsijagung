<!DOCTYPE html>
<html lang="en">
    
<head>
        <title>Pengelompokan Tanaman Jagung Jatim</title><meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="stylesheet" href="<?php echo base_url() ?>assets/template-admin/HTML/css/bootstrap.min.css" />
		<link rel="stylesheet" href="<?php echo base_url() ?>assets/template-admin/HTML/css/bootstrap-responsive.min.css" />
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/template-admin/HTML/css/maruti-login.css" />
    </head>
    <body>
        <div id="loginbox">
            <?php echo form_open('Login/register',array(
                      'class' => 'form-vertical'
                  )); ?>
				<div class="control-group normal_text">
					<h4>Pengelompokan Tanaman Jagung Jatim<br>Halaman Register</h4></div>
                <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on"><i class="icon-user"></i></span><input type="text" class="form-control" name="username" id="username" placeholder="Username" required>
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on"><i class="icon-lock"></i></span><input type="Password" class="form-control" name="password" id="password" placeholder="Password" required>
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on"><i class="icon-file"></i></span><input type="text" class="form-control" name="nama" id="nama" placeholder="Nama" required>
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on"><i class="icon-book"></i></span><input type="text" class="form-control" name="email" id="email" placeholder="Email" required>
                        </div>
                    </div>
                </div>
                <div class="form-actions">
                	<span class="pull-left"><a href="<?php echo site_url('Login') ?>" class="flip-link btn btn-inverse" id="to-recover">Login</a></span><a class="btn btn-info" href="<?php echo site_url('Home') ?>">Back to Home</a>
                    <span class="pull-right"><input type="submit" class="btn btn-success" value="Register" /></span>
                </div>
            <?php echo form_close(); ?>
        </div>
        
        <script src="<?php echo base_url() ?>assets/template-admin/HTML/js/jquery.min.js"></script>  
        <script src="<?php echo base_url() ?>assets/template-admin/HTML/js/maruti.login.js"></script> 
    </body>

</html>
