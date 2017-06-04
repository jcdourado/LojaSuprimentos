<?php
/**
 * The template loop search
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
<div <?php post_class('post-item'); ?>>
    <article class="entry">
        <div class="row">
            <div class="col-sm-12">
                <div class="entry-ci">
                    <h3 class="entry-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
                    <div class="entry-excerpt">
                        <?php the_excerpt(); ?>
                    </div>
                    <div class="entry-more">
                        <a href="<?php the_permalink();?>"><?php esc_html_e( 'Read more', 'kutetheme' );?></a>
                    </div>
                </div>
            </div>
        </div>
    </article>
</div>