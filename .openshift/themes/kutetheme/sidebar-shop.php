<?php
/**
 * The sidebar containing the main widget area
 *
 * @package WordPress
 * @subpackage Kute theme
 * @since KuteTheme 1.0
 */
?>
<?php
$kt_woowoo_shop_used_sidebar = kt_option( 'kt_woowoo_shop_used_sidebar', 'sidebar-shop' );

if( is_product() ) {
	$kt_woowoo_shop_used_sidebar = kt_option( 'kt_woo_single_used_sidebar', 'sidebar-shop' );
}
?>
<div id="secondary" class="secondary">
	<?php if ( is_active_sidebar( $kt_woowoo_shop_used_sidebar ) ) : ?>
		<div id="widget-area" class="widget-area" role="complementary">
			<?php dynamic_sidebar( $kt_woowoo_shop_used_sidebar ); ?>
		</div><!-- .widget-area -->
	<?php endif; ?>
</div><!-- .secondary -->
