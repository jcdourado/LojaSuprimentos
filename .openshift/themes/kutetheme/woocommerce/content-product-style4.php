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
	<?php
    global $product;
    
    $attachment_ids = $product->get_gallery_attachment_ids();
    
    $secondary_image = '';
    $size = apply_filters( 'kt_box_product_thumbnail_loop', 'kt_shop_catalog_270' );
    if( $attachment_ids ){
        $secondary_image = wp_get_attachment_image( $attachment_ids[0], $size );
    }

    if( has_post_thumbnail() ){
        ?>
        <a class="primary_image" href="<?php the_permalink();?>"><?php the_post_thumbnail( $size );?></a>
        <?php
    }else{
        ?>
        <a class="primary_image" href="<?php the_permalink();?>"><?php echo wc_placeholder_img( $size ); ?></a>
        <?php
    }
    if( $secondary_image != "" ){
        ?>
        <a class="secondary_image" href="<?php the_permalink();?>"><?php echo $secondary_image; ?></a>
        <?php
    }else{
        ?>
        <a class="secondary_image" href="<?php the_permalink();?>"><?php echo wc_placeholder_img( $size ); ?></a>
        <?php
    }

	?>
	<div class="group-button-control">
	    <?php kt_get_tool_wishlish ();?>
	    <?php kt_get_tool_compare();?>
	    <?php kt_get_tool_quickview();?>
	</div>
	<div class="product-label"><?php do_action( 'kt_loop_product_label' ); ?></div>
	<?php
	woocommerce_template_loop_add_to_cart();
	?>
</div>
<div class="product-info">
	<div class="product-name">
	    <a href="<?php the_permalink();?>"> <?php the_title();?></a>
	</div>
	<div class="box-price">
	    <?php do_action( 'kt_after_shop_loop_item_title' );?>
	</div>
</div>