<div class="header style14">
	<div class="container">
		<div class="main-header">
			<div class="row">
			  <div class="col-sm-12 text-center logo2">
			  		<?php echo kt_get_logo(); ?>
			  </div>
			  <div class="col-lg-4 col-md-7 col-sm-6 col-xs-12 main-menu-col">
			  		<nav class="main-menu-wapper">
	                    <?php kt_setting_mega_menu(); ?>
	                    <a href="#" class="mobile-navigation"><?php _e('Main menu','kutetheme');?><i class="fa fa-bars"></i></a>
		            </nav>
			  </div>
			  <div class="col-md-4 text-center logo1">
			  		<?php echo kt_get_logo(); ?>
			  </div>
			  <div class="col-lg-4 col-md-5 col-sm-6 col-xs-12 header-right">
	            	<div class="top-header-inner">
	            		<div class="form-search">
	            			<span class="icon fa fa-search"></span>
	            			<?php kt_search_form();?>
	            		</div>
	            		<?php if( kt_is_wc() ): ?>
	                    <div class="block-minicart14">
	                    	<?php do_action('kt_mini_cart'); ?>
	                    </div>
	                	<?php endif;?>
	                    <?php kt_topbar_menu();?>

	                </div>
	           </div>
			</div>
	    </div>
	</div>
</div>