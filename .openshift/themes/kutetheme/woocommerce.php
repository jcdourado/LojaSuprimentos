<?php
/**
 * The Template for displaying all single products.
 *
 * Override this template by copying it to yourtheme/woocommerce/single-product.php
 *
 * @author      WooThemes
 * @package     WooCommerce/Templates
 * @version     1.6.4
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
get_header(); 

$kt_sidebar_are = kt_option( 'kt_woo_shop_sidebar_are', 'left' );
if(is_product()){
    $kt_sidebar_are = kt_option( 'kt_woo_single_sidebar_are', 'left' );
}

$sidebar_are_layout = 'sidebar-'.$kt_sidebar_are;

if( $kt_sidebar_are == "left" || $kt_sidebar_are == "right" ){
    $col_class = "main-content col-xs-12 col-sm-8 col-md-9"; 
}else{
    $col_class = "main-content col-xs-12 col-sm-12 col-md-12";
}
wp_reset_postdata();
?>

    <?php
        /**
         * woocommerce_before_main_content hook
         *
         * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
         * @hooked woocommerce_breadcrumb - 20
         */
        do_action( 'woocommerce_before_main_content' );
    ?>
    <div class="row <?php echo esc_attr( $sidebar_are_layout );?>">
        <div class="view-product-list <?php echo esc_attr( $col_class );?>">
            <?php
            /**
             * kt_before_list_product hook
             *
             * @hooked kt_category_slider 
             * @hooked kt_sub_category
             */
             if(is_product_category()){
                do_action( 'kt_before_list_product' );  
             }
            // Remover sale price
            remove_filter( 'woocommerce_sale_price_html','woocommerce_custom_sales_price', 10 , 2 ); 
            ?>
            <?php woocommerce_content(); ?>
        </div>
        <?php
        if( $kt_sidebar_are != 'full' ){
            ?>
            <div class="col-xs-12 col-sm-4 col-md-3">
                <div class="sidebar">
                    <?php get_sidebar('shop');?>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
    
    <?php
        /**
         * woocommerce_after_main_content hook
         *
         * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
         */
        do_action( 'woocommerce_after_main_content' );
    ?>
<?php get_footer(); ?>