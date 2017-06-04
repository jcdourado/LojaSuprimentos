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
<div class="option7">
<!-- HEADER -->
<div id="header" class="header style7">
    <div class="top-header">
        <div class="container">
            <?php 
            if( kt_is_wc() ): 
                do_action('kt_mini_cart');
            endif; 
            ?>
            <?php kt_topbar_menu();?>
        </div>
    </div>
    <!--/.top-header -->
    <!-- MAIN HEADER -->
    <div id="main-header">
        <div class="container main-header">
            <div class="row">
                <div class="col-xs-12 col-sm-3 logo">
                    <?php echo kt_get_logo(); ?>
                </div>
                <div id="main-menu" class="col-sm-12 col-md-9 main-menu">
                    <nav class="main-menu-style7 main-menu-wapper">
                        <?php kt_setting_mega_menu(); ?>
                        <a href="#" class="mobile-navigation"><?php _e('Main menu','kutetheme');?><i class="fa fa-bars"></i></a>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- END MANIN HEADER -->
    <?php 
    $args = array(
          'post_type'      => 'service',
          'orderby'        => 'date',
          'order'          => 'desc',
          'post_status'    => 'publish',
          'posts_per_page' => 4,
    );
    $taxonomy = kt_get_setting_service_category();
    if( $taxonomy ){
        $args['tax_query'] = 
            array(
        		array(
                    'taxonomy' => 'service_cat',
                    'field'    => 'id',
                    'terms'    => explode( ",", $taxonomy )
        	)
        );
    }
    $service_query = new WP_Query( $args );
    if( $service_query->have_posts() ) :
    ?>
    <div class="service-header">
        <div class="container">
            <div class="row">
                <?php while( $service_query->have_posts() ): $service_query->the_post(); ?>
                <div class="col-sm-6 col-md-3">
                    <div class="item">
                        <a href="<?php the_permalink() ?>">
                            <?php if(has_post_thumbnail()):?>
                                <?php the_post_thumbnail( 'full' );?>
                            <?php endif; ?>
                            <span><?php the_title() ?></span>
                        </a>
                    </div>
                </div>
                <?php endwhile; ?>
            </div>
        </div>
    </div>
    <?php endif; ?>
    <?php 
    wp_reset_postdata();
    wp_reset_query();
    ?>
    <div class="container">
        <?php do_action( 'kt_show_menu_option_7' ) ?>
    </div>
</div>
<!-- end header -->
</div>
   