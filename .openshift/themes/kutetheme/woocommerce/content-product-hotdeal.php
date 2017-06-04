<div class="product-container">
    <div class="product-image">
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
        <div class="group-tool-button">
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
            <?php
        		/**
        		 * woocommerce_after_shop_loop_item hook
        		 *
        		 * @hooked woocommerce_template_loop_add_to_cart - 10
        		 */
        		do_action( 'woocommerce_after_shop_loop_item' );
        
        	?>
        </div>
    </div>
    <div class="product-info">
        <h5 class="product-name"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
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