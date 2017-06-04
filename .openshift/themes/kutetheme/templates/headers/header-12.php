<div id="header" class="header style12">
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
            <div class="container main-header">
                <div class="row">
                    <div class="col-sm-12 col-md-3 logo">
                        <?php echo kt_get_logo(); ?>
                    </div>
                    <div id="main-menu" class="col-sm-12 col-md-9">
                        <nav class="main-menu-style12 main-menu-wapper">
                            <?php kt_setting_mega_menu(); ?>
                            <a href="#" class="mobile-navigation"><?php _e('Main menu','kutetheme');?><i class="fa fa-bars"></i></a>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="block-header-top12">
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
            <?php if( kt_is_wc() ): ?>
            <div class="block-mini-cart">
                <?php do_action('kt_mini_cart'); ?>
            </div>
            <?php endif;?>
        </div>
    </div>
</div>