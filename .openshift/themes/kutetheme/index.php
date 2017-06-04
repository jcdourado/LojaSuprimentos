<?php

/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * e.g., it puts together the home page when no home.php file exists.
 *
 * Learn more: {@link https://codex.wordpress.org/Template_Hierarchy}
 *
 * @package WordPress
 * @subpackage Kute Theme
 * @since KuteTheme 1.0
 */
get_header(); 

$kt_sidebar_are = kt_option( 'kt_sidebar_are', 'left' );

$sidebar_are_layout = 'sidebar-'.$kt_sidebar_are;

if( $kt_sidebar_are == "left" || $kt_sidebar_are == "right" ){
    $col_class = "main-content col-xs-12 col-sm-8 col-md-9"; 
}else{
    $col_class = "main-content col-xs-12 col-sm-12 col-md-12";
}
?>
<div id="primary" class="content-area <?php echo esc_attr( $sidebar_are_layout );?>">
	<main id="main" class="site-main" role="main">
        <div class="container">
            <?php breadcrumb_trail();?>
            <div class="row">
                <div class="<?php echo esc_attr( $col_class );?>">
                    <?php if ( have_posts() ) : ?>
            			<?php if ( is_home() && ! is_front_page() ) : ?>
            				<header>
            					<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
            				</header>
            			<?php endif; ?>
                        <div class="blog-paging top clearfix">
                            <?php kt_display_result_post();?>
                            <?php kt_paging_nav();?>
                         </div>
                        <div class="blog-posts">
            			<?php
            			// Start the loop.
            			while ( have_posts() ) : the_post();
            				/*
            				 * Get template loop
            				 */
            			     get_template_part( 'templates/loop' );
            
            			// End the loop.
            			endwhile;
                        ?>
                        </div>
                        <div class="blog-paging clearfix">
                            <?php kt_paging_nav();?>
                        </div>
                        <?php
            		// If no content, include the "No posts found" template.
            		else :
            			get_template_part( 'content', 'none' );
            		endif;
            		?>
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
