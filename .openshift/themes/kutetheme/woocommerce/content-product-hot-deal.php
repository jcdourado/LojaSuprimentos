<div class="left-block">
    <a href="<?php the_permalink(); ?>">
        <?php
			/**
			 * woocommerce_template_loop_product_thumbnail hook
			 *
			 * @hooked woocommerce_template_loop_product_thumbnail - 10
			 */
            $size = apply_filters( 'kt_product_thumbnail_loop', 'kt_shop_catalog_164' );
            echo woocommerce_get_product_thumbnail( $size );
		?>
    </a>
</div>
<div class="right-block">
    <h5 class="product-name"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
    <div class="content_price">
        <?php
			/**
			 * woocommerce_after_shop_loop_item_title hook
			 * @hooked woocommerce_template_loop_price - 5
			 * @hooked woocommerce_template_loop_rating - 10
			 */
			do_action( 'kt_after_shop_loop_item_title' );
		?>
    </div>
</div>