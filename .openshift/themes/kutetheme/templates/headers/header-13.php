<div id="header" class="header style13">
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
                        <div class="col-xs-12 col-sm-3 logo">
                            <?php echo kt_get_logo(); ?>
                        </div>
                        <?php if( kt_is_wc() ): ?>
                        <div class="col-xs-12 col-sm-8 col-md-6 col-lg-7">
                        <?php else:?>
                        <div class="col-xs-12 col-sm-7">
                        <?php endif;?>
                            <div class="header-search-inner">
                                <?php kt_search_form();?>
                            </div>
                        </div>
                        <?php if( kt_is_wc() ): ?>
                        <div class="col-xs-12 col-sm-4 col-md-3 col-lg-2">
                            <div class="mini-cart-13">
                                <?php do_action('kt_mini_cart'); ?>
                            </div>
                        </div>
                        <?php endif;?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="block-header-top13">
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
            <nav class="main-menu-wapper">
                <div class="main-menu-style13">
                    <?php kt_setting_mega_menu(); ?>
                    <a href="#" class="mobile-navigation"><?php _e('Main menu','kutetheme');?><i class="fa fa-bars"></i></a>
                </div>
            </nav>

        </div>
    </div>
</div>