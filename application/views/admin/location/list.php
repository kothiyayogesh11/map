<?php

$data['assets'] = '<link rel="stylesheet" type="text/css" href="'.base_url('assets/admin/plugin/DataTables/datatables.min.css').'"/>

<script src="'.base_url('assets/admin/plugin/DataTables/datatables.min.js').'" type="text/javascript"></script>

<script type="text/javascript" src="' . base_url() . 'assets/admin/js/plugins/forms/selects/select2.min.js"></script>

<script type="text/javascript" src="' . base_url() . 'assets/admin/js/pages/datatables_responsive.js"></script>';

$this->load->view('admin/header',$data);

$this->load->view('admin/left');

?>

<div class="content-wrapper">

    <div class="page-header page-header-xs">

        <div class="page-header-content">

        	<div class="page-title"><h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Location</span> - List</h4></div>

            <div class="heading-elements">

            	<div class="heading-btn-group">

               		<a href="<?php echo base_url('admin/location/from'); ?>" class="btn bg-teal-400 "><i class="icon-diff-added position-left"></i> Add Location</a>

            	</div>

         	</div>

        </div>

    </div>   

    <div class="content">

    	<span><?php echo $this->session->flashdata('message'); ?></span>

        <div class="panel panel-flat border-top-success border-top-lg">

        <div class="row">

        	<div class="col-sm-12">

            	

            <table id="example" class="table table-xxs table-bordered table-striped  table-hover display">

            	<thead>

                	<tr>

                    	<td></td>

                       	<th>No.</th>

                        <th>Name</th>
                        
                        <th>Unique ID</th>

                        <th>Address</th>

                        <th>Category</th>

                        <th>City</th>

                        <th>State</th>

                        <th>Pincode</th>

                        <th>Mobile No.</th>

                        <th>Action</th>

                    </tr>

                </thead>

                <tbody>

                	<?php

					if(isset($location_list) && !empty($location_list)){

						$i = 0;

						foreach($location_list as $lval){

							$i++;

							echo '<tr id="'.$lval['locationid'].'">';

							echo '<td></td>';

							echo '<td>'.$i.'</td>';

							echo '<td>'.ucwords($lval['name']).'</td>';
							
							echo '<td>'.ucwords($lval['unique_code']).'</td>';

							echo '<td>'.ucwords($lval['address']).'</td>';

							if($lval['location_category'] == 1){
								echo '<td> - </td>';
							}
							else{
								echo '<td>'.ucwords($lval['cat_name']).'</td>';	
							}

							echo '<td>'.ucwords($lval['city_name']).'</td>';

							echo '<td>'.ucwords($lval['state_name']).'</td>';

							echo '<td>'.$lval['pin_code'].'</td>';

							echo '<td><a class="openModal view-mobile btn btn-primary btn-xs" data-toggle="modal" href="#myModal" data-id="'.$lval['locationid'].'">View</a></td>';

							echo '<td><a class="btn btn-warning btn-xs" href='.base_url('admin/location/edit_location/'.base64_encode($lval['locationid']).'').'>EDIT</a>';

							echo ' <a onclick=\'return confirm("Are you sure for delete?")\' href='.base_url('admin/location/delete_location/'.base64_encode($lval['locationid']).'').' class="btn btn-danger btn-xs">DELETE</a></td>';

							echo '</tr>';

						}

					}else{

						echo '<tr><td colspan="12">There is no location entered yet...</td></tr>';

					}

					?>

                </tbody>

            </table>

            </div>

        </div>

        </div>

    </div>

</div>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

<div class="modal-dialog modal-notify modal-warning" role="document">

 <div class="modal-content">

     <div class="modal-header">

         <p class="heading lead">Mobile Number Details</p>

         <button type="button" class="close" data-dismiss="modal" aria-label="Close">

             <span aria-hidden="true" class="white-text">&times;</span>

         </button>

     </div>

     <div class="modal-body" id="model_body">

     </div>

     <div class="modal-footer justify-content-center">

         <a type="button" class="btn btn-warning" style=" background-color: #ccc; border-color: #ccc; color: black;" data-dismiss="modal">No, thanks</a>

     </div>

 </div>

</div>

</div>

<script>

$(document).ready(function() {

    $('#example').DataTable();

});

$(document).on('click','.view-mobile',function(){

      var id = $(this).attr('data-id');

      $.ajax({

		 method:"POST",

		 url:BASE_URL+"location/view_mobile",

		 data:{id:id},

		 dataType:"json",

		 success:function(response){

			$('#model_body').html(response.model_view);

		 }

			

      });

  });

</script>

<?php $this->load->view('admin/footer'); ?>