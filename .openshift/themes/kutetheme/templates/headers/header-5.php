<!-- HEADER -->
<div id="header" class="header option5">
    <div class="top-header">
        <div class="container">
            <?php kt_topbar_menu();?>
        </div>
    </div>
    <!--/.top-header -->
    <!-- MAIN HEADER -->
    <div class="container main-header">
        <div class="row">
            <div class="col-xs-4 col-sm-12 col-md-4 col-lg-4 header-search-box">
                <?php kt_search_form();  ?>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4 logo">
                <?php echo kt_get_logo(); ?>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4 group-button-header">
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
            <?php do_action( 'kt_show_menu_option_5' ); ?>
            <!-- userinfo on top-->
            <div id="form-search-opntop">
            </div>
            <?php if( kt_is_wc() ):  ?>
            <!-- CART ICON ON MMENU -->
            <div id="shopping-cart-box-ontop">
                <i class="fa fa-shopping-cart"></i>
                <div class="shopping-cart-box-ontop-content"></div>
            </div>
            <?php endif;?>
        </div>
    </div>
</div>
<!-- end header -->