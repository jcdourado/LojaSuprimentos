<?php
/**
 * The template used for displaying page content
 *
 * @package WordPress
 * @subpackage Kute Theme
 * @since KuteTheme 1.0
 */
?>
<?php 
    $kt_page_comment = kt_get_post_meta( get_the_ID(), 'kt_enable_page_comment', 'show' );
    $kt_show_page_title = kt_get_post_meta( get_the_ID(), 'kt_show_page_title', 'show');
    $kt_page_extra_class = kt_get_post_meta( get_the_ID(), 'kt_page_extra_class', 'show');
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( $kt_page_extra_class ); ?>>
    <?php if( $kt_show_page_title == 'show'): ?>
    	<header class="entry-header">
        	<h1 class="page-heading">
                <span class="page-heading-title2"><?php the_title();?></span>
            </h1>
        </header>
    <?php endif; ?>
	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'kutetheme' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
				'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'kutetheme' ) . ' </span>%',
				'separator'   => '<span class="screen-reader-text">, </span>',
			) );
		?>
	</div><!-- .entry-content -->
	<?php
    if( $kt_page_comment == 'show' ):
        // If comments are open or we have at least one comment, load up the comment template.
        if ( comments_open() || get_comments_number() ) :
            comments_template();
        endif;
    endif;
    ?>
</article><!-- #post-## -->
