<!-- HEADER -->
<?php
$kt_header_message = kt_option('kt_header_message','');
?>
<div id="header" class="header option3">
    <div class="top-header">
        <div class="container">
            <?php kt_topbar_menu();?>
        </div>
    </div>
    <!--/.top-header -->
    <!-- MAIN HEADER -->
    <div class="container main-header">
        <div class="row top-main-header">
            <div class="col-sm-12 col-md-12 col-lg-3"></div>
            <div class="col-sm-7 col-md-6">
                <?php
                    wp_nav_menu( array(
                        'menu'              => 'custom_header_menu',
                        'theme_location'    => 'custom_header_menu',
                        'depth'             => 1,
                        'container'         => '',
                        'container_class'   => '',
                        'container_id'      => '',
                        'menu_class'        => 'main-header-top-link',
                        'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
                        'walker'            => new wp_bootstrap_navwalker())
                    );
                ?>
            </div>
            <?php if( $kt_header_message ):?>
            <div class="col-sm-5 col-md-6 col-lg-3">
                <div class="header-text">
                    <i class="fa fa-info-circle"></i> <?php echo kt_get_html( $kt_header_message );?> 
                </div>
            </div>
            <?php endif;?>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-3 logo">
                <?php echo kt_get_logo(); ?>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 header-search-box">
                <?php kt_search_form();  ?>
            </div>
            <?php 
                if( kt_is_wc() ): 
                    do_action('kt_mini_cart');
                 endif; 
             ?>
        </div>
        
    </div>
    <!-- END MANIN HEADER -->
    <div id="nav-top-menu" class="nav-top-menu">
        <div class="container">
            <?php do_action( 'kt_show_menu_option_3' ); ?>
            <!-- userinfo on top-->
            <div id="form-search-opntop">
            </div>
            <!-- CART ICON ON MMENU -->
            <div id="shopping-cart-box-ontop">
                <i class="fa fa-shopping-cart"></i>
                <div class="shopping-cart-box-ontop-content"></div>
            </div>
        </div>
    </div>
</div>
<!-- end header -->