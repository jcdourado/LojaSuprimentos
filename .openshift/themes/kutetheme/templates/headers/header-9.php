<?php
$kt_enable_header9_postion = kt_option('kt_enable_header9_postion','enable');
$header_class = array('header style9');

if( $kt_enable_header9_postion =="enable"){
	$header_class[] = 'postion';
}
?>
<div id="header" class="<?php echo esc_attr( implode(' ',$header_class) );?>">
    <div class="top">
        <div class="top-header">
            <div class="container">
                <div class="top-header-inner">
                    <?php kt_topbar_menu();?>
                </div>
            </div>
        </div>
        <!-- MAIN HEADER -->
        <div id="main-header">
            <div class="container">
            <div class="main-header">
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-3 logo">
                        <?php echo kt_get_logo(); ?>
                    </div>
                    <div id="main-menu" class="col-sm-12 col-md-12 col-lg-9">
                        <div class="inner">
                            <div class="header-control">
                                <div class="form-search-9">
                                    <span class="icon"><i class="fa fa-search"></i></span>
                                    <div class="form-search-inner">
                                        <?php kt_search_form();?>
                                    </div>
                                </div>
                                <?php if( kt_is_wc() ): ?>
                                <div class="block-mini-cart-9">
                                    <?php do_action('kt_mini_cart'); ?>
                                </div>
                                <?php endif;?>
                            </div>
                            <nav class="main-menu-wapper">
                                <?php kt_setting_mega_menu(); ?>
                                <a href="#" class="mobile-navigation"><?php _e('Main menu','kutetheme');?><i class="fa fa-bars"></i></a>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>