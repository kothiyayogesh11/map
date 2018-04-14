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
        	<div class="page-title"><h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">User </span> - List</h4></div>
            <div class="heading-elements">
            	<div class="heading-btn-group">
					<?php if(!empty($this->session->userdata('role'))&& ($this->session->userdata('role') == '10')){?>
               			<a href="<?php echo base_url('admin/users/form'); ?>" class="btn bg-teal-400 "><i class="icon-diff-added position-left"></i> Add User</a>
					<?php }?>
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
                        <th></th>
                        <th>No.</th>
                        <th>Name</th>
                        <th>Role</th>
                        <th>Image</th>
                        <th>Mobile</th>
                        <th>Pincode</th>
                        <th>View</th>
                        <th>ACT</th>
                    </tr>
                </thead>
                <tbody>
                	<?php
					if(isset($list) && !empty($list)){
						$i = 0;
						foreach($list as $sval){
							$i++;
							echo '<tr id="'.$sval['uid'].'">';
							echo '<td></td>';
							echo '<td>'.$i.'</td>';
							echo '<td>'.ucwords($sval['uname']).'</td>';
							echo '<td>'.ucwords($sval['urname']).'</td>';
							$img = file_exists($sval['upic']) ? '<img style="width:80px; height:80px; object-fit:cover;" src="'.base_url($sval['upic']).'" /img>' : '';
							echo '<td>'.$img.'</td>';
							echo '<td>'.$sval['umobile'].'</td>';
							echo '<td>'.$sval['pincode'].'</td>';
							echo '<td><a class="openModal user-details-view btn btn-primary btn-xs" data-toggle="modal" href="#myModal" data-id="'.$sval['uid'].'">DETAILS</a></td>';
							echo '<td><a class="btn btn-warning btn-xs" href='.base_url('admin/users/edit_admin/'.base64_encode($sval['uid']).'').'>EDIT</a>  | ';
							echo ' <a class="btn btn-danger btn-xs" onclick=\'return confirm("Are you sure for delete?")\' href='.base_url('admin/users/delete_admin/'.base64_encode($sval['uid']).'').'>DELETE</a></td>';
							echo '</tr>';
						}
					}else{
						echo '<tr><td colspan="4">There is no shift entered yet...</td></tr>';
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
         <p class="heading lead">Sub Admin Details</p>
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
<div class="modal fade" id="MobileModel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel_new" aria-hidden="true">
<div class="modal-dialog modal-notify modal-warning" role="document">
 <div class="modal-content">
     <div class="modal-header">
         <p class="heading lead">Mobile Number List</p>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true" class="white-text">&times;</span>
         </button>
     </div>
     <div class="modal-body" id="model_body_mobile">
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
$('.user-details-view').click(function(){
  var id = $(this).attr('data-id');
 var base_url = 'http://v2smap.ctbook.in/admin/';
  $.ajax({
	 method:"POST",
	 url:base_url+"users/view_admin_details",
	 data:{id:id},
	 dataType:"json",
	 success:function(response){
		$('#model_body').html(response.model_view);
	 }
		
  });
});
  
  function new_mobile(){
      var id = $('.openModal_new').attr('data-id');
	 
	 var base_url = 'http://v2smap.ctbook.in/admin/';
      $.ajax({
		 method:"POST",
		 url:base_url+"users/view_model_mobile",
		 data:{id:id},
		 dataType:"json",
		 success:function(response){
			$('#model_body_mobile').html(response.model_new_data);
		 }
			
      });
  }	
</script>
<?php $this->load->view('admin/footer'); ?>