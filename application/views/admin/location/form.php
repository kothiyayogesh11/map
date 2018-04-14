<?php

$this->load->view('admin/header');

$this->load->view('admin/left');

?>

<style>

.phone-input{

	margin-bottom:8px;

}
#location_cate{
	display:block !important;	
}
.labl{color: #8e8e8e;

    padding-left: 5px;

    margin-bottom: 0;

    font-size: 12px;font-weight: 100;}

.inp{padding: 0 6px;

    border: none;

    height: 25px;

    border-radius: 0;

    border-bottom:2px solid #bfbfbf;}

	

#myform .form-group{margin-bottom:20px;}

.sec, .thierd{display:none;}

</style>

<?php if(isset($edit_location) && !empty($edit_location)) $edit_location = $edit_location[0];?>

<div class="content-wrapper">

    <div class="page-header page-header-xs">

        <div class="page-header-content">

        	<div class="page-title"><h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Location</span> - Form</h4></div>

        </div>

    </div>   

    <div class="content">

    <span><?php echo $this->session->flashdata('message'); ?></span>

	<form action="<?php echo base_url('admin/location/insert_location'); ?>" id="myform" class="ajaxform1" enctype="multipart/form-data" method="post" accept-charset="utf-8">

    <div class="panel panel-flat col-md-8">

    	<div class="panel-heading"><legend><i class="icon-pencil position-left"></i>Add New Location</legend></div>

        <div class="panel-body ">

            <fieldset class="text-semibold">

            	<div class="first location-slide-wrap"> 

			<div class="row">
				
				<?php $location_edit_id = isset($edit_location['location_category']) ? $edit_location['location_category']:'';?> 
                    <div class="form-group">

                        <label for="loc_cat_name" class="form-label labl">Location Category</label>

                        <?php if(isset($loc_cat))

				    	$dd_loc_cat = array('' => 'Select Location Category...');

						foreach($loc_cat as $cat)  $dd_loc_cat[$cat['id']] = ucwords($cat['name']);

						if(isset($edit_location['location_category']) && $edit_location['location_category'] != ''){

							echo form_dropdown('loc_cat_id',$dd_loc_cat,$edit_location['location_category'],array('class'=>'form-control inp required',"onchange"=>'get_category();',"id"=>'loc_cat_id'));

						}else{

							echo form_dropdown('loc_cat_id',$dd_loc_cat,set_value('name'),array('class'=>'form-control inp required',"onchange"=>'get_category();',"id"=>'loc_cat_id'));

						}

						  ?>           

                        <?php echo form_error('name'); ?>

                    </div>

                </div>

			
                    
                  
			
            	<div class="row">

                    <div class="form-group">

                        <label for="first_name" class="form-label labl">Name</label>   

                        <?php $name = isset($edit_location['name']) ? $edit_location['name']:set_value('name');?>                  

                        <input type="text" name="name" value="<?php echo $name; ?>" id="name" class="form-control inp required" placeholder="i.e doe">

                        <?php echo form_error('name'); ?>

                    </div>

                </div>

            	

                <div class="row">

                    <div class="form-group">

                        <label for="last_name" class="form-label labl">Address</label>  

                         <?php $address = isset($edit_location['address']) ? $edit_location['address']:set_value('address');?>

                        <textarea id="address" name="address" rows="1" class="form-control inp required" placeholder=" i.e street no - 1,london"><?php echo $address;?></textarea>

                        <?php echo form_error('address'); ?>

                    </div>

                </div>

                
			<div class="row">

					<?php $location_edit_id = isset($edit_location['id']) ? $edit_location['id']:'';?> 

                    <input type="hidden" name="location_id" id="location_id" value="<?php echo $location_edit_id; ?>">

                    <div class="form-group">

                        <label for="first_name" class="form-label labl">State</label>

                        <?php if(isset($state))

				    	$dd_state = array('' => 'Select State...');

						foreach($state as $rl)  $dd_state[$rl['state_id']] = ucwords($rl['state_name']);

						if(isset($edit_location['state_id']) && $edit_location['state_id'] != ''){

							echo form_dropdown('state_id',$dd_state,$edit_location['state_id'],array('class'=>'form-control inp required',"onchange"=>'get_city();',"id"=>'state'));

						}else{

							echo form_dropdown('state_id',$dd_state,set_value('state_name'),array('class'=>'form-control inp required',"onchange"=>'get_city();',"id"=>'state'));

						}

						  ?>           

                        <?php echo form_error('state_name'); ?>

                    </div>

                </div>
           		

                

                <div class="row">

                    <div class="form-group">

                        <label for="city_list" class="form-label labl">City</label>

                        <?php if(isset($edit_location['city_id']) && $edit_location['city_id'] != ''){

                        	if(isset($city))  $dd_city = array('' => 'Select City...');

                        	foreach($city as $rl)  $dd_city[$rl['city_id']] = ucwords($rl['city_name']);

                        	echo form_dropdown('city_id',$dd_city,$edit_location['city_id'],array('class'=>'form-control inp required'));

                        }else{?>                     

                        <?php	echo "<select id='city_list' name='city_list' class='form-control inp required'><option value=''>Select City...</option></select>";

						}?>

                        <?php echo form_error('city'); ?>

                    </div>

                </div>

            

           		<div class="row">

                    <div class="form-group">

                        <label for="first_name" class="form-label labl">Pincode</label>

                         <?php $pincode = isset($edit_location['pin_code']) ? $edit_location['pin_code']:set_value('pincode');?>                        <input type="text" name="pincode" value="<?php echo $pincode; ?>" id="pincode" class="form-control inp required" placeholder="i.e 123456" onkeypress="return isNumberKey(event)" maxlength="6">

                        <?php echo form_error('pincode'); ?>

                    </div>

                </div>

                

                <div class="row">

                    <div class="form-group">

                    	<div class="row">

                        <label class="control-label labl">Contact No.</label>

                        <div class="col-sm-12">

                            <div class="phone-list">

                            <?php 

                            if(!empty($mobile)){

                                foreach($mobile as $m){?>

                                <div class="input-group phone-input">

                                    <input type="text" name="phone[]" id="phone" onkeypress="return isNumberKey(event)"  class="form-control  required" value="<?php echo $m['mobile'];?>" />

                                    <span class="input-group-btn">

                                        <button class="btn btn-danger btn-remove-phone" type="button"><span class="glyphicon glyphicon-remove"></span></button>	

                                    </span> 

                                           

                                    <?php echo form_error('phone'); ?>

                                </div>

                            <?php 

                                }

                            }else{

                            ?>

                                <div style="width:100%" class="input-group phone-input">

                                    

                                    <input type="text" name="phone[]" id="phone" onkeypress="return isNumberKey(event)"  class="form-control  required" placeholder="+1 (999) 999 9999" />	

                               

                                <?php echo form_error('phone'); ?>

                                </div>

                    <?php }?>

                        </div>

                        <button type="button" class="btn btn-success btn-sm btn-add-phone"><span class="glyphicon glyphicon-plus"></span> Add Phone</button>

                    </div>

                </div>

                </div>

                </div>

                

                <input type="button" class="btn btn-primary btn-xs loction-slide" value="Next" data-type="sec" />

                

                

                </div>

                <div class="sec location-slide-wrap">

                

                <div class="row">

                    <div class="form-group">

                        <label for="latitude"  class="form-label labl">latitude</label>  

                         <?php $latitude = isset($edit_location['latitude']) ? $edit_location['latitude']:set_value('latitude');?>                        <input type="text" name="latitude" value="<?php echo $latitude; ?>" onkeypress="return isLatKey(event)" maxlength="10" id="latitude" class="form-control inp required" placeholder="i.e 23.232323">

                        <?php echo form_error('latitude'); ?>

                    </div>

                </div>
                

                <div class="row">

                    <div class="form-group">

                        <label for="first_name" class="form-label labl">longitude</label>  

                         <?php $longitude = isset($edit_location['longitude']) ? $edit_location['longitude']:set_value('longitude');?>                        <input type="text" name="longitude"  onkeypress="return isLatKey(event)" maxlength="10" value="<?php echo $longitude; ?>" id="location" class="form-control inp required" placeholder="i.e 23.232323">

                        <?php echo form_error('longitude'); ?>

                    </div>

                </div>

                <div class="col-md-6"><input type="button" class="btn btn-primary btn-xs loction-slide" value="Previous" data-type="first" />

                <input type="button" class="btn btn-primary btn-xs loction-slide" value="Next" id="second_page" data-type="thierd" />

                </div>
                 <div class="col-md-6 text-right" id="third_page">

                	<a href="javascript:history.go(-1)"><button type="button" class="btn btn-cons border-slate text-slate-800 btn-flat"><i class="icon-square-left position-right"></i> Back</button></a>

                	<button type="submit" name="second" class="btn btn-primary">Submit <i class="icon-square-right position-right"></i></button>

               </div>

                

                </div>

                <div class="thierd location-slide-wrap">

                <div class="row" id="location_cate">

                    <div class="form-group">

                        <label for="first_name" class="form-label labl">Select Category</label>

                        <?php if(isset($category))
				    $dd_cat = array('' => 'Select Category...');
							
						foreach($category as $rl)  $dd_cat[$rl['id']] = ucwords($rl['name']);
							if(isset($edit_location['category_id']) && $edit_location['category_id'] != ''){

								echo form_dropdown('category_id',$dd_cat,$edit_location['category_id'],array('class'=>'form-control inp required',"id"=>'category'));

							}

							else{

								echo form_dropdown('category_id',$dd_cat,set_value('category_id'),array('class'=>'form-control inp required',"id"=>'category'));

							}

						  ?>           

                        

                        <?php echo form_error('first_name'); ?>

                    </div>

                </div>

                

                <div class="col-md-6"><input type="button" class="btn btn-primary btn-xs loction-slide" value="Previous" data-type="sec" /></div>

                <div class="col-md-6 text-right ">

                	<a href="javascript:history.go(-1)"><button type="button" class="btn btn-cons border-slate text-slate-800 btn-flat"><i class="icon-square-left position-right"></i> Back</button></a>

                	<button type="submit" name="thired" class="btn btn-primary">Submit <i class="icon-square-right position-right"></i></button>

               </div>

                

                

                <!--<input type="button" class="btn btn-primary btn-xs loction-slide" value="Next" data-type="first" />-->

                

                </div>

            </fieldset>

        </div>

        <div class="panel-footer p-10">

            <div class="row">

                <!--<div class="col-md-12 text-right">

                	<a href="javascript:history.go(-1)"><button type="button" class="btn btn-cons border-slate text-slate-800 btn-flat"><i class="icon-square-left position-right"></i> Back</button></a>

                	<button type="submit" class="btn btn-primary">Submit <i class="icon-square-right position-right"></i></button>

                </div>-->

            </div>

        </div>

    </div>

</form>

</div>

</div>

<script>

$(document).ready(function() {
      if($('#loc_cat_id').val() == 2){
		$('#location_cate').show();
		$('#third_page').hide();
		$('#second_page').show();
	}
	else{
		$('#location_cate').hide();
		$('#second_page').hide();
		$('.thierd').hide();
		$('#third_page').show();
	}
});
function get_category(){
     if($('#loc_cat_id').val() == 2){
		$('#location_cate').show();
		$('#third_page').hide();
		$('#second_page').show();
	}
	else{
		$('#location_cate').hide();
		$('#second_page').hide();
		$('.thierd').hide();
		$('#third_page').show();
	}
}

/*$(document).ready(function(e) {
     if('#location_cate').hide();{
		
	}
});*/
$(document).on('click','button[type="submit"]',function(e){

	var err_label = true;

	$(this).parents('form').find('.required').each(function(index, element) {

        if($(element).val() == ''){
					console.log(insex,value);
				err_label = false;

				$(element).addClass('error');

		}else{

			if(element.name == 'phone' && !(/^([0-9]{7,15})$/.test($(element).val().replace(/[+ \[\]\(\)\-\.\,]/g,'')))){

				$(element).addClass('error');

				err_label = false;

			}else if(element.name == 'pincode' && !(/^\d{6}$/.test($(element).val().replace(/[+ \[\]\(\)\-\.\,]/g,'')))){

				$(element).addClass('error');

				err_label = false;

			}else{

				$(element).removeClass('error');

			}

		}

    });

	return err_label;

});

$(document).ready(function(e) {
	
	$('#location_cate').hide();
     var base_url = 'http://v2smap.ctbook.in/admin/';

	var get_state_id = $('#state').val();

	$.ajax({

		url:base_url+'location/get_city' ,

		type: 'POST',

		dataType:"json",

		

		data: { get_state_id:get_state_id} ,

		success: function (response) {

			console.log(response.city);

			if(response.error == 0){

				$('#city_list').html(response.city);	

			}

		},

		error: function () {

		}	

	});

});

function get_city(){

	var base_url = 'http://v2smap.ctbook.in/admin/';

	var get_state_id = $('#state').val();

	$.ajax({

		url:base_url+'location/get_city' ,

		type: 'POST',

		dataType:"json",

		data: { get_state_id:get_state_id} ,

		success: function (response) {

			if(response.error == 0){

				$('#city_list').html(response.city);	

			}

		},

		error: function () {

		}	

	});

}

	$(function(){

		

			$(document.body).on('click', '.changeType' ,function(){

				$(this).closest('.phone-input').find('.type-text').text($(this).text());

				$(this).closest('.phone-input').find('.type-input').val($(this).data('type-value'));

			});

			

			$(document.body).on('click', '.btn-remove-phone' ,function(){

				$(this).closest('.phone-input').remove();

			});

			

			

			$('.btn-add-phone').click(function(){

				var index = $('.phone-input').length + 1;

				

				$('.phone-list').append(''+

						'<div class="input-group phone-input">'+

							

							'<input type="text" name="phone[]" id="phone" class="form-control" onkeypress="return isNumberKey(event)" placeholder="+1 (999) 999 9999" />'+

							/*'<input type="hidden" name="phone['+index+'][type]" class="type-input" value="" />'+*/

							'<span class="input-group-btn">'+

								'<button class="btn btn-danger btn-remove-phone" type="button"><span class="glyphicon glyphicon-remove"></span></button>'+

							'</span>'+

						'</div>'

				);

			});

			

		});

function isNumberKey(evt){

	var charCode = (evt.which) ? evt.which : event.keyCode

	if (charCode > 31 && (charCode < 48 || charCode > 57))

		return false;

	return true;

}



function isLatKey(evt){ 

	var charCode = (evt.which) ? evt.which : event.keyCode

	if( charCode == 46) return true;

	if (charCode > 31 && (charCode < 48 || charCode > 57))

		return false;

	return true;

}

	  

$(document).on('click','.loction-slide',function(){

	var error_flag = false;

	$(this).parents('form').find('.required').each(function(index, element) {

        if($(element).val() == '' && $(element).is(':hidden') == false){

			$(element).addClass('error');

			error_flag = true;

		}else{

			$(element).removeClass('error');

		}

    });

	if(!error_flag){

	var class_name = $(this).attr('data-type');

	$('.location-slide-wrap').hide();

	$('.'+class_name).show(300);

	}

});

</script>

<?php $this->load->view('admin/footer'); ?>