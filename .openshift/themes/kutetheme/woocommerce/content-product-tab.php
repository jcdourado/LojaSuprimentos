<?php
/**
 * The template for displaying product content within loops.
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
<li>
    <div class="left-block">
        <a href="<?php the_permalink(); ?>">
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
        <div class="group-price">
            <?php 
            /**
    			 * kt_loop_product_function hook
    			 * @hooked kt_show_product_loop_new_flash - 5
    			 * @hooked woocommerce_show_product_loop_sale_flash - 10
    			 */
    			do_action( 'kt_loop_product_label' );
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
        // // echo  strlen($product_name);
        
        // // if( strlen($product_name) > 25 ){
        // //     echo $product_name = substr( $product_name, 0, 25 );
        // //     $product_name = trim( $product_name ) . "...";
        // // }
        ?>
        <h5 class="product-name">
            <a title="<?php echo esc_attr( get_the_title() );?>" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </h5>
        <div class="content_price">
        <?php
			/**
			 * woocommerce_after_shop_loop_item_title hook
             * 
			 * @hooked woocommerce_template_loop_price - 5
			 * @hooked woocommerce_template_loop_rating - 10
			 */
			do_action( 'kt_after_shop_loop_item_title' );
		?>
        </div>
    </div>
</li>