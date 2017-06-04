<?php
/**
 * The template post meta
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

<div class="entry-meta-data">
    <?php
    printf( '<span class="author vcard"><i class="fa fa-user"></i> '.__('by:', 'kutetheme' ).'  <a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
        esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
        esc_attr( sprintf( esc_attr__( 'View all posts by %s', 'kutetheme' ), get_the_author() ) ),
        get_the_author()
    );
    ?>
    <span class="cat"><i class="fa fa-folder-o"></i> <?php the_category(', '); ?></span>
    <span class="comment-count"><i class="fa fa-comment-o"></i> <?php comments_number(
        esc_attr__('0 comment', 'kutetheme'),
        esc_attr__('1 comment', 'kutetheme'),
        esc_attr__('% comments', 'kutetheme')
    ); ?></span>
    <span class="date"><i class="fa fa-calendar"></i> <?php echo get_the_date('F j, Y');?></span>
</div>