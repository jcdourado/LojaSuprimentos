<?php
/**
 * The template loop
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
    <h3 class="entry-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
    <?php get_template_part( 'templates/post','meta' );?>
    <div class="row">
        <?php if(has_post_thumbnail()):?>
        <div class="col-sm-12 col-md-5">
            <div class="entry-thumb image-hover2">
                <a href="<?php the_permalink();?>">
                    <?php the_post_thumbnail('kt-post-thumb');?>
                </a>
            </div>
        </div>
        <div class="col-sm-12 col-md-7">
        <?php else:?>
            <div class="col-sm-12">
        <?php endif;?>
                <div class="entry-ci">
                    <div class="entry-excerpt">
                        <?php the_excerpt(); ?>
                    </div>
                    <?php the_tags( '<div class="entry-tags">'.__('<i class="fa fa-tags"></i>', 'kutetheme' ).' ', ', ', '<div>' );?>
                    <div class="entry-more">
                        <a href="<?php the_permalink();?>"><?php esc_html_e( 'Read more', 'kutetheme' );?></a>
                    </div>
                </div>
            </div>
        </div>
    </article>
</div>