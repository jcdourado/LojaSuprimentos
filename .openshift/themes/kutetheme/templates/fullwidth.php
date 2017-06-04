<?php
/**
 * Template Name: Full Width Page
 *
 * @package WordPress
 * @subpackage Kute Theme
 * @since KuteTheme 1.0
 */
 get_header();?>
    <div id="primary" class="content-area">
    	<main id="main" class="site-main">
    	<?php
    	// Start the loop.
    	while ( have_posts() ) : the_post();
            ?>
            <div class="main-content"><?php the_content( );?></div>
            <?php
    	// End the loop.
    	endwhile;
    	?>
    	</main><!-- .site-main -->
    </div><!-- .content-area -->
<?php 
get_footer(); ?>