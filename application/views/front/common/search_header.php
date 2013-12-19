<?php if( $this->user_type == 'business_basic' || $this->user_type == 'business_pro' ) {

		$use_record = $this->Fetch_data_model->fetch_user_data( $this->is_logged_in['user_id'] ); 	
	 ?>

<?php $display_name = ($this->is_logged_in['user_id'])?"Welcome ".strtoupper($use_record->display_name):'&nbsp;'; ?>

<div class="top_header">
        	<div class="container-fluid">
            	<div class="row-fluid">
                	<div class="span7 offset5">
                    	<span>Contact</span>
                        <span class="blue1">&nbsp;+1800-000-0000</span>
                        <span class="space">&nbsp;</span>
                        <span>Blog</span>
                        <span class="space">&nbsp;</span>
                        <span class="top_search">
                        	<input type="text" class="inputbox" placeholder="Search" >
                            <input type="button" value="" class="search_btn">
                        </span>
                        <span class="space">&nbsp;</span>
                        <span><a href="#">Pricing</a></span>
                        <span class="space">&nbsp;</span>
                        <span><?=$display_name;?></span>
                        <span class="space">&nbsp;</span>
                       <!--  <span><a href="#">Log Out</a></span> -->
                        <div class="clr"></div>
                    </div>
                </div>
            </div>
        </div>
   <?php } ?>
