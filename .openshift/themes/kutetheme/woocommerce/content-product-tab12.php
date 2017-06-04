<?php
/**
 * The template for displaying product content within loops.
 *
 * Override this template by copying it to kutetheme/woocommerce/content-product.php
 *
 * @author 		KuteTheme
 * @package 	THEME/WooCommerce
 * @version     KuteTheme 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}?>
<div class="product-info">
    <h4 class="product-name"><a title="<?php echo esc_attr( get_the_title() );?>" href="<?php the_permalink(); ?>"><?php the_title( ); ?></a></h4>
    <div class="content_price">
        <span class="price"><?php woocommerce_template_loop_price(); ?></span>
    </div>
</div>
<div class="product-thumb kt-template-loop">
    <a href="<?php the_permalink() ?>">
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
<div class="group-button-control">
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