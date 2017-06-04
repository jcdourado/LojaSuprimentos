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
<div class="product-thumb">
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
</div>
<div class="product-info">
    <h4 class="product-name">
        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
    </h4>
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
<div class="group-button-control">
        <?php kt_get_tool_wishlish ();?>
	    <?php kt_get_tool_compare();?>
	    <?php kt_get_tool_quickview();?>
</div>
<?php
	/**
	 * woocommerce_after_shop_loop_item hook
	 *
	 * @hooked woocommerce_template_loop_add_to_cart - 10
	 */
	do_action( 'woocommerce_after_shop_loop_item' );

?>