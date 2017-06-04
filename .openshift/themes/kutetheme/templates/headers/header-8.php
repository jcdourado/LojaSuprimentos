<div class="header style8">
	<div class="top-header">
        <div class="container">
            <div class="form-search">
                <?php kt_search_form();  ?>
                <span class="icon fa fa-search"></span>
            </div>
            <?php kt_topbar_menu();?>
        </div>
    </div>
    <!-- MAIN HEADER -->
    <div id="main-header">
        <div class="container main-header">
            <div class="row">
                <div class="col-xs-12 col-sm-3 logo">
                    <?php echo kt_get_logo(); ?>
                </div>
                <div id="main-menu" class="col-xs-12 col-sm-10 col-md-7 col-lg-8 main-menu">
                    <nav class="main-menu-style8 main-menu-wapper">
                        <?php kt_setting_mega_menu(); ?>
                        <a href="#" class="mobile-navigation"><?php _e('Main menu','kutetheme');?><i class="fa fa-bars"></i></a>
                    </nav>
                    
                </div>
                <div class="col-xs-12 col-sm-2 col-md-2 col-lg-1">
                    <div class="mini-cart">
                        <?php 
                        if( kt_is_wc() ): 
                            do_action('kt_mini_cart');
                        endif; 
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END MANIN HEADER -->
</div>