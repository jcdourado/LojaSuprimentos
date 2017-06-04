<li>
    <div class="products-block-left">
        <a href="<?php the_permalink() ; ?>">
            <?php
    			/**
    			 * woocommerce_template_loop_product_thumbnail hook
    			 *
    			 * @hooked woocommerce_template_loop_product_thumbnail - 10
    			 */
                do_action( 'woocommerce_template_loop_product_thumbnail' );
    		?>
        </a>
    </div>
    <div class="products-block-right">
        <p class="product-name">
            <a href="<?php the_permalink(); ?>"><?php echo the_title(); ?></a>
        </p>
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
</li>