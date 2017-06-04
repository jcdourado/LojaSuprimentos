<?php
$hotline = kt_get_info_hotline();
$kt_enable_box_contact_info11 = kt_option('kt_enable_box_contact_info11','enable');
$kt_enable_hotline_contact_info11 = kt_option('kt_enable_hotline_contact_info11','enable');
$kt_enable_social_contact_info11 = kt_option('kt_enable_social_contact_info11','enable');
?>
<div class="header style11">
    <div class="top">
        <div class="top-header">
            <div class="container">
                <div class="top-header-inner">
                    <?php kt_topbar_menu();?>
                    <?php if( kt_is_wc() ): ?>
		            <div class="block-mini-cart">
		                <?php do_action('kt_mini_cart'); ?>
		            </div>
		            <?php endif;?>
                </div>
            </div>
        </div>
        <!-- MAIN HEADER -->
        <div id="main-header">
            <div class="container main-header">
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-3 logo">
                        <?php echo kt_get_logo(); ?>
                    </div>
                    <div id="main-menu" class="col-sm-12 col-md-12 col-lg-9">
                        <div class="inner-main-menu">
                        	<nav class="main-menu-style12 main-menu-wapper">
	                            <?php kt_setting_mega_menu(); ?>
	                            <a href="#" class="mobile-navigation"><?php _e('Main menu','kutetheme');?><i class="fa fa-bars"></i></a>
	                        </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="block-header-top12">
            <div class="inner">
            	<?php
	            global $kt_enable_vertical_menu;
	            $kt_click_open_vertical_menu = kt_option('kt_click_open_vertical_menu','disable');
	            $kt_vertical_item_visible = kt_option('kt_vertical_item_visible',11);

	            if( $kt_enable_vertical_menu == 'enable' ): 
	            ?>
	            <div class="block-vertical">
	                <div id="box-vertical-megamenus" class="vertical-wapper">
	                    <div data-items="<?php echo esc_attr( $kt_vertical_item_visible );?>" class="box-vertical-megamenus <?php if( $kt_click_open_vertical_menu =="enable") echo esc_attr( 'hiden_content' );?>">
	                        <h4 class="title">
	                            <span class="title-menu"><?php _e( 'Categories', 'kutetheme' ); ?></span>
	                            <span class="btn-open-mobile home-page"><i class="fa fa-angle-right"></i></span>
	                        </h4>
	                        <div class="vertical-menu-content">
	                            <?php kt_setting_vertical_menu(); ?>
	                            <div class="all-category"><span data-open_text="<?php _e( 'View more','kutetheme' );?>" data-close_text="<?php _e( 'Close','kutetheme' );?>" class="open-cate"><?php _e( 'View more', 'kutetheme' ) ?></span></div>
	                        </div>
	                    </div>
	                </div>
	            </div>
	            <?php endif; ?>
	            <div class="block-search">
	                <?php kt_search_form();?>
	            </div>
	            <?php if( ($kt_enable_box_contact_info11 =="enable") && ( $kt_enable_hotline_contact_info11 =="enable" || $kt_enable_social_contact_info11=="enable" ) ):?>
	            <div class="contact-info">
	            	<div class="inner">
	            		<?php if( $kt_enable_hotline_contact_info11 == 'enable'): ?>
	            		<span class="hotline"><i class="fa fa-phone"></i><?php echo esc_html( $hotline );?></span>
	            		<?php endif;?>
	            		<?php  
	            		if( $kt_enable_social_contact_info11=="enable"){
	            			kt_get_social_header();
	            		} 
	            		?>
	            	</div>
	            </div>
	        	<?php endif;?>
            </div>
        </div>
    </div>
</div>