<?php

$this->load->view('admin/header');

$this->load->view('admin/left');

?>

<?php if(isset($edit_user) && !empty($edit_user)) $edit_user = $edit_user[0];?>

<div class="content-wrapper">

    <div class="page-header page-header-xs">

        <div class="page-header-content">

        	<div class="page-title"><h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">User</span> - Form</h4></div>

        </div>

    </div>   

    <div class="content">

    <span><?php echo $this->session->flashdata('message'); ?></span>

	<form action="<?php echo base_url('admin/users/process'); ?>" id="myform" class="ajaxform1" enctype="multipart/form-data" method="post" accept-charset="utf-8">

    <div class="panel panel-flat col-md-8">

    	<div class="panel-heading"><legend><i class="icon-pencil position-left"></i> User details</legend></div>

        <div class="panel-body ">

            <fieldset class="text-semibold">

            <?php $admin_edit_id = isset($edit_user['uid']) ? $edit_user['uid']:'';?> 

            <input type="hidden" id="admin_id" name="admin_id" value="<?php echo $admin_edit_id;?>">

                <div class="row">

                    <div class="form-group">

                        <label for="first_name" calss="form-label">First Name</label> 

                         <?php $firstname = isset($edit_user['firstname']) ? $edit_user['firstname']:set_value('first_name');?>                        <input type="text" name="first_name" value="<?php echo $firstname; ?>" id="first_name" class="form-control required" placeholder="i.e John">

                        <?php echo form_error('first_name'); ?>

                    </div>

                </div>

                <div class="row">

                    <div class="form-group">

                        <label for="last_name" calss="form-label">Last Name</label> 

                         <?php $lastname = isset($edit_user['lastname']) ? $edit_user['lastname']:set_value('last_name');?>                        <input type="text" name="last_name" value="<?php echo $lastname; ?>" id="last_name" class="form-control required" placeholder="i.e doe">

                        <?php echo form_error('last_name'); ?>

                    </div>

                </div>

                <div class="row">

                    <div class="form-group">

                        <label for="user_image" calss="form-label">Profile</label>

                        <?php if(isset($edit_user['upic']) && $edit_user['upic'] != ''){?> 

				    <?php $img = file_exists($edit_user['upic']) ? '<img style="width:80px; height:80px;margin-top: 1%; object-fit:cover;" src="'.base_url($edit_user['upic']).'" /img>' : '';}?>

                        <input type="file" accept="image/*" name="user_image" value="" id="user_image" class="form-control">

                        <?php if(isset($edit_user['upic']) && $edit_user['upic'] != '') echo $img;?>

                    </div>

                </div>

                <div class="row">

                    <div class="form-group">

                        <label for="email" calss="form-label">Email</label> 

                        <?php $email = isset($edit_user['uemail']) ? $edit_user['uemail']:set_value('email');?>                        <input type="text" name="email" value="<?php echo $email; ?>" id="email" class="form-control required" placeholder="i.e abc@domain.com">

                        <?php echo form_error('email'); ?>

                    </div>

                </div>
				
                  <div class="row">

                    <div class="form-group">

                        <label for="password" calss="form-label">Password</label> 

                        <?php //echo $password = isset($edit_user['password']) ? '':set_value('password');?>
                       
                        <?php if(isset($edit_user['password']) ){?>
					    <input type="password" name="pass" value="" id="pass" class="form-control" >
					 <?php  }else {?>                        
                        <input type="password" name="password" value="" id="password" class="form-control required" >
                        <?php } ?>

                        <?php echo form_error('email'); ?>

                    </div>

                </div>
                	

                <div class="row">

                    <div class="form-group">

                        <label for="mobile" calss="form-label">Mobile</label> 

                         <?php $mobile = isset($edit_user['umobile']) ? $edit_user['umobile']:set_value('mobile');?>                        <input type="text" name="mobile" value="<?php echo $mobile; ?>" id="mobile" class="form-control required" placeholder="i.e 9999999999">

                        <?php echo form_error('mobile'); ?>

                    </div>

                </div>

                 <div class="row">

                    <div class="form-group">

                        <label for="mobile" calss="form-label">Pincode</label> 

                         <?php $pincode = isset($edit_user['pincode']) ? $edit_user['pincode']:set_value('pincode');?>                        <input type="text" name="pincode" value="<?php echo $pincode; ?>" id="pincode" class="form-control required" placeholder="i.e 123456" onkeypress="return isNumberKey(event)" maxlength="6">

                        <?php echo form_error('mobile'); ?>

                    </div>

                </div>

                <div class="row">

                    <div class="form-group">

                        <label for="shift_name" calss="form-label">Role</label>                     

                        <?php

				   if(isset($role)) 

				   $dd[''] = '-- Role --';

				   foreach($role as $rl) $dd[$rl['role']] = ucwords($rl['name']);

					   if(isset($edit_user['unrole']) && $edit_user['unrole'] != ''){

						echo form_dropdown('role',$dd,$edit_user['unrole'],array('class'=>'form-control required'));

					   }

					   else{

						  echo form_dropdown('role',$dd,set_value('role'),array('class'=>'form-control required')); 

					   }	

							

						?>

                        <?php echo form_error('role'); ?>

                    </div>

                </div>

                

            </fieldset>

        </div>

        <div class="panel-footer p-10">

            <div class="row">

                <div class="col-md-12 text-right">

                	<a href="javascript:history.go(-1)"><button type="button" class="btn btn-cons border-slate text-slate-800 btn-flat"><i class="icon-square-left position-right"></i> Back</button></a>

                	<button type="submit" class="btn btn-primary">Submit <i class="icon-square-right position-right"></i></button>

                </div>

            </div>

        </div>

    </div>

</form>

</div>

</div>

<script>

$(document).on('click','button[type="submit"]',function(e){

	var err_label = true;

	$(this).parents('form').find('.required').each(function(index, element) {

        if($(element).val() == ''){

			if(element.name == 'pass' && $('input[name="uid"]').val() != ''){

				$(element).removeClass('error');

			}else{

				err_label = false;

				$(element).addClass('error');

			}

		}else{

			if(element.name == 'email' && !(/^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/.test($(element).val()))){

				$(element).addClass('error');

				err_label = false;

			}else if(element.name == 'mobile' && !(/^([0-9]{7,15})$/.test($(element).val().replace(/[+ \[\]\(\)\-\.\,]/g,'')))){

				$(element).addClass('error');

				err_label = false;

			}else if(element.name == 'pincode' && !(/^\d{6}$/.test($(element).val().replace(/[+ \[\]\(\)\-\.\,]/g,'')))){

				$(element).addClass('error');

				err_label = false;

			}else if(element.name == 'password' && $('#password').val().length < 8){

				$(element).addClass('error');

				err_label = false;

			}else{

				$(element).removeClass('error');

			}

		}

    });

	return err_label;

});

function isNumberKey(evt)

      {

         var charCode = (evt.which) ? evt.which : event.keyCode

         if (charCode > 31 && (charCode < 48 || charCode > 57))

            return false;



         return true;

      }

</script>

<?php $this->load->view('admin/footer'); ?>