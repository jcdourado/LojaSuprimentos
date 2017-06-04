<?php
/**
 * The template for displaying product content within loops.
 *
 *
 * @author 		KuteTheme
 * @package 	Kute Theme
 * @version     KuteTheme 1.0
 */
 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product, $woocommerce_loop, $post;
$id = get_the_ID();

?>
<li>
    <?php
    $time = kt_get_max_date_sale( $id );
    $y = date( 'Y', $time );
    $m = date( 'm', $time );
    $d = date( 'd', $time );
    ?>
    <div class="count-down-time" data-y="<?php echo esc_attr( $y );?>" data-m="<?php echo esc_attr( $m );?>" data-d="<?php echo esc_attr( $d );?>" data-h="00" data-i="00" data-s="00" ></div>
    <div class="left-block">
        <a href="<?php echo esc_url( get_permalink() ) ; ?>">
            <?php
    			/**
    			 * kt_loop_product_thumbnail hook
    			 *
    			 * @hooked woocommerce_template_loop_product_thumbnail - 10
    			 */
    			do_action( 'kt_loop_product_thumbnail' );
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
        <h5 class="product-name">
            <a href="<?php echo esc_url( get_permalink() ); ?>"><?php echo esc_html( get_the_title() ) ; ?></a>
        </h5>
        <div class="content_price">
            <?php
    			/**
    			 * woocommerce_after_shop_loop_item_title hook
			     *
    			 * @hooked woocommerce_template_loop_price - 10
    			 */
    			do_action( 'kt_after_loop_item_title' );
    		?>
        </div>
    </div>
</li>