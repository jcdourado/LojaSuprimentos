<?php
/**
 * Product loop new flash
 *
 * @author 		AngelsIT
 * @package 	Kute Theme
 * @version     2.6.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post, $product;

$postdate 		= get_the_time( 'Y-m-d' );			// Post date

$postdatestamp 	= strtotime( $postdate );			// Timestamped post date

$newness 		= kt_option( 'kt_woo_newness', 7 ); 	// Newness in days as defined by option
?>
<?php if ( ( time() - ( 60 * 60 * 24 * $newness ) ) < $postdatestamp ) : ?>

	<?php echo apply_filters( 'woocommerce_new_flash', '<span class="product-new">' . esc_attr__( 'New', 'kutetheme' ) . '</span>', $post, $product ); ?>

<?php endif; ?>
