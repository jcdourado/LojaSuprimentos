<?php
/**
 * The template for displaying product content within loops.
 *
 * Override this template by copying it to kutetheme/woocommerce/content-product.php
 *
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.6.2
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product, $woocommerce_loop;

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) ) {
	$woocommerce_loop['loop'] = 0;
}

// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) ) {
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );
}

// Ensure visibility
if ( ! $product || ! $product->is_visible() ) {
	return;
}

// Increase loop count
$woocommerce_loop['loop']++;

// Extra post classes
$classes = array();
if ( 0 == ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] || 1 == $woocommerce_loop['columns'] ) {
	$classes[] = 'first';
}
if ( 0 == $woocommerce_loop['loop'] % $woocommerce_loop['columns'] ) {
	$classes[] = 'last';
}


// Bootstrap Column
$kt_woo_grid_column = kt_option('kt_woo_grid_column',3);
$kt_woo_grid_column_tablet = kt_option('kt_woo_grid_column_tablet',2);
$kt_woo_grid_column_mobile = kt_option('kt_woo_grid_column_mobile',1);

// $bootstrapColumn = round( 12 / $woocommerce_loop['columns'] );
// $classes[] = 'col-xs-12 col-md-' . $bootstrapColumn;

$kt_woo_shop_sidebar_are = kt_option('kt_woo_shop_sidebar_are','left');

$classes[] ='product-item';

// Set columns
$boostrap_columns_destop = round( 12 / $kt_woo_grid_column );

$classes[] = 'col-md-'.$boostrap_columns_destop;

$kt_woo_ipad_grid_column = round( 12 / $kt_woo_grid_column_tablet );
$classes[] = 'col-sm-'.$kt_woo_ipad_grid_column;

$kt_woo_mobile_grid_column = round( 12 / $kt_woo_grid_column_mobile );

$classes[] = 'col-xs-'.$kt_woo_mobile_grid_column;

// if( $kt_woo_shop_sidebar_are =="full"){
//     $classes[] = 'col-sm-4';
// }else{
//     $classes[] = 'col-sm-6';
// }

?>
<li <?php post_class( $classes ); ?>>
    <div class="product-container">
	<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>
    	<div class="left-block">
            <?php
            woocommerce_show_product_loop_sale_flash();
            ?>
            <a href="<?php echo esc_url( get_permalink() ) ; ?>">
                <?php
        			
        			echo woocommerce_get_product_thumbnail();
        		?>
            </a>
            <div class="quick-view">
                <?php
        			/**
        			 * kt_loop_product_function hook
        			 *
        			 * @hooked kt_get_tool_wishlish - 1
                     * @hooked kt_get_tool_compare - 5
                     * @hooked kt_get_tool_quickview - 10
        			 */
        			do_action( 'kt_loop_product_function' );
        		?>
            </div>
            <?php
                /**
                 * woocommerce_after_shop_loop_item hook
                 *
                 * @hooked woocommerce_template_loop_add_to_cart - 10
                 */
                do_action( 'woocommerce_after_shop_loop_item' );
            ?>
        </div>
        <div class="right-block">
            <?php
            // $product_name = get_the_title();
            // if( strlen( $product_name ) > 25 ) {
            //     $product_name = substr( $product_name, 0, 25);
            //     $product_name = trim( $product_name ) ."...";
            // }
            ?>
            <h5 class="product-name"><a title="<?php echo esc_attr( get_the_title() );?>" href="<?php the_permalink(); ?>"><?php the_title( ); ?></a></h5>
            <div class="content_price">
                <?php
        			/**
        			 * woocommerce_after_shop_loop_item_title hook
    			     *
        			 * @hooked woocommerce_template_loop_price - 10
        			 */
        			do_action( 'kt_after_shop_loop_item_title' );
        		?>
            </div>
            <div class="info-orther">
                <p class="availability"><?php _e( 'Availability', 'kutetheme' );?>: <span class="instock"><?php _e( 'In stock', 'kutetheme' );?></span><span class="outofstock"><?php _e( 'Out of stock', 'kutetheme' );?></span></p>
                <div class="product-desc"><?php echo apply_filters( 'woocommerce_short_description', $post->post_excerpt ) ?></div>
            </div>
        </div>
    </div>
</li>
