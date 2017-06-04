<?php
/**
 * The template Header
 *
 *
 * @author 		KuteTheme
 * @package 	THEME/WooCommerce
 * @version     KuteTheme 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>
<!-- HEADER -->
<div id="header" class="header option6">
    <div class="top-header">
        <div class="container">
            <?php kt_topbar_menu();?>
        </div>
    </div>
    <!--/.top-header -->
    <!-- MAIN HEADER -->
    <div class="main-header">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-3 logo">
                   <?php echo kt_get_logo(); ?>
                </div>
                <div class="header-search-box <?php echo kt_is_wc() ? 'col-xs-7 col-sm-7' : 'col-xs-9'; ?>">
                    <?php kt_search_form();  ?>
                    <?php kt_get_hot_product_tags(3);?>
                </div>
                <?php 
                    if( kt_is_wc() ): 
                        do_action('kt_mini_cart');
                     endif; 
                 ?>
            </div>
        </div>
    </div>
    <!-- END MANIN HEADER -->
    <div id="nav-top-menu" class="nav-top-menu">
        <div class="container">
            <?php do_action( 'kt_show_menu_option_6' ) ?>
            <!-- userinfo on top-->
            <div id="form-search-opntop">
            </div>
            <?php if( kt_is_wc() ):  ?>
            <!-- CART ICON ON MMENU -->
            <div id="shopping-cart-box-ontop">
                <i class="fa fa-shopping-cart"></i>
                <div class="shopping-cart-box-ontop-content">
                </div>
            </div>
            <?php endif;?>
        </div>
    </div>
</div>
<!-- end header -->