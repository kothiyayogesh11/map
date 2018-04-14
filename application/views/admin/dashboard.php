<?php

$this->load->view('admin/header');

$this->load->view('admin/left');

?>

<div class="content-wrapper">

    <div class="page-header page-header-xs">

        <div class="page-header-content">

        	<div class="page-title"><h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Home</span> - Dashboard</h4></div>

        </div>

    </div>   

    <div class="content">

        <div class="row">

		<?php if(!empty($this->session->userdata('role'))&& ($this->session->userdata('role') == '10')){?>
            <div class="col-lg-4">

                <div class="panel bg-teal-400">

                        <div class="panel-body">

                        	<div class="heading-elements"><span class="heading-text badge bg-teal-800"></span></div>

                        	<h2 class="no-margin">Total User</h2>

                        	<div class="text-muted text-size-large" style="font-size: 24px;"><?php echo str_pad(count($total_user),2,'0',STR_PAD_LEFT); ?></div>

                        </div>

                </div>

            </div>
            <?php }?>

            <div class="col-lg-4">

                <div class="panel bg-pink-400">

                    <div class="panel-body">

                        <div class="heading-elements"><span class="heading-text badge bg-pink-800"></span></div>

                        <h2 class="no-margin">Total Location</h2>

                        <div class="text-muted text-size-large" style="font-size: 24px;"><?php echo str_pad(count($total_location),2,'0',STR_PAD_LEFT); ?></div>

                    </div>

                </div>

            </div>

            

        </div>

    </div>

</div>

<?php

$this->load->view('admin/footer');

?>