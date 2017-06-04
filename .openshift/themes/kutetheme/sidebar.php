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
$kt_used_sidebar = kt_option( 'kt_used_sidebar', 'sidebar-primary' );

if( is_page() ) {
	$kt_page_used_sidebar = kt_get_post_meta( get_the_ID(), 'kt_page_used_sidebar', 'none' );
	
    if( $kt_page_used_sidebar != "none" ){
		$kt_used_sidebar = $kt_page_used_sidebar;
	}
}
?>

<div id="secondary" class="secondary">
	<?php if ( is_active_sidebar( $kt_used_sidebar ) ) : ?>
		<div id="widget-area" class="widget-area" role="complementary">
			<?php dynamic_sidebar( $kt_used_sidebar ); ?>
		</div><!-- .widget-area -->
	<?php endif; ?>
</div><!-- .secondary -->
