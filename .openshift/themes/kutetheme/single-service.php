<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage Kute theme
 * @since KuteTheme 1.0
 */

get_header(); 
$kt_sidebar_are = kt_option( 'kt_sidebar_are', 'full' );

$sidebar_are_layout = 'sidebar-'.$kt_sidebar_are;

if( $kt_sidebar_are == "left" || $kt_sidebar_are == "right" ){
    $col_class = "main-content col-xs-12 col-sm-8 col-md-9"; 
}else{
    $col_class = "main-content col-xs-12 col-sm-12 col-md-12";
}
?>
<div id="primary" class="content-area service-single <?php echo esc_attr( $sidebar_are_layout ); ?>">
	<main id="main" class="site-main" role="main">
        <div class="container">
            <?php breadcrumb_trail();?>
            <div class="row">
                <div class="<?php echo esc_attr( $col_class );?>">
                    <?php
                    the_post();
                    ?>
                    <header>
    					<h1 class="page-title screen-reader-text"><?php the_title(); ?></h1>
    				</header>
                    <article class="entry-detail">
                        <div class="content-text entry-content clearfix">
                            <?php the_content(); ?>
                            <?php
                            wp_link_pages( array(
                                'before'      => '<div class="nav-links"><span class="page-links-title">' . esc_attr__( 'Pages:', 'kutetheme' ) . '</span>',
                                'after'       => '</div>',
                                'link_before' => '<span>',
                                'link_after'  => '</span>',
                                'pagelink'    => '%',
                                'separator'   => '',
                            ) );
                            ?>
                        </div>
                        <?php the_tags( '<div class="entry-tags">'.esc_attr__( 'Tags:', 'kutetheme' ).' ', ', ', '<div>' );?>
                    </article>
                    <div class="single-box">
                    <?php
                    // If comments are open or we have at least one comment, load up the comment template.
                    if ( comments_open() || get_comments_number() ) :
                        comments_template();
                    endif;
                    ?>
                    </div>
                </div>
                <?php if( $kt_sidebar_are != 'full' ){ ?>
                    <div class="col-xs-12 col-sm-4 col-md-3">
                        <div class="sidebar">
                            <?php get_sidebar();?>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
	</main><!-- .site-main -->
</div><!-- .content-area -->

<?php get_footer(); ?>