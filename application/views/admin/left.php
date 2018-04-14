<div class="sidebar sidebar-main">

    <div class="sidebar-content">

        <div class="sidebar-category sidebar-category-visible">

            <div class="category-content no-padding">

                <ul class="navigation navigation-main navigation-accordion">

                    <li class=""><a href="<?php echo base_url('admin/dashboard'); ?>"><i class="icon-home4"></i> <span>Dashboard</span></a></li>
				
                    <li>
                    <?php if(!empty($this->session->userdata('role'))&& ($this->session->userdata('role') == '10')){?>
                        <a href="#"><i class="icon-user"></i> <span>Sub Admin</span></a>
                        <ul>
                            	<li class=""><a href="<?php echo base_url('admin/users'); ?>"> User List</a></li>
                            	<li class=""><a href="<?php echo base_url('admin/users/form'); ?>"> User Add</a></li>
                        </ul>   
				<?php }?>
                    </li> 
				
                     

                   <!-- <li>

                        <a href="#"><i class="icon-wrench"></i> <span>Setting</span></a>

                        <ul>

                            <li class=""><a href="<?php //echo base_url('admin/panel'); ?>"> Panel List</a></li>

                            <li class=""><a href="<?php //echo base_url('admin/panel/form'); ?>"> Add Panel</a></li>

                            <li class=""><a href="<?php //echo base_url('admin/pages'); ?>"> Page List</a></li>

                            <li class=""><a href="<?php //echo base_url('admin/pages/form'); ?>"> Add Page</a></li>

                            <li class=""><a href="<?php //echo base_url('admin/auth/profile'); ?>"> Edit Profile</a></li>

                            <li class=""><a href="<?php //echo base_url('admin/right'); ?>"> Assign User Rights</a></li>

                        </ul>   

                    </li> -->

                    

                    <li>

                        <a href="#"><i class="fa fa-crosshairs"></i> <span>Location</span></a>

                        <ul>

                            <li class=""><a href="<?php echo base_url('admin/location'); ?>">Location</a></li>

                            <li class=""><a href="<?php echo base_url('admin/location/from'); ?>">Add Location</a></li>

                        </ul>   

                    </li> 

                    

                    <li class=""><a href="<?php echo base_url('admin/login/logout'); ?>"><i class="icon-exit"></i> <span>Logout</span></a></li>

                </ul>

            </div>

        </div>

    </div>

</div>