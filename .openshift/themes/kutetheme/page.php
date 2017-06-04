<?php
/**
 * The template for displaying pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @package KuteTheme
 * @subpackage Kute_Theme
 * @since KuteTheme 1.0
 */

get_header();


// Start the loop.
while ( have_posts() ) : the_post();
    $id = get_the_ID();
endwhile;

// Default option
$kt_sidebar_are = kt_option( 'kt_sidebar_are', 'left' );

// Page option
$kt_page_layout = kt_get_post_meta( $id, 'kt_page_layout', '' );
$kt_show_page_breadcrumb = kt_get_post_meta( $id, 'kt_show_page_breadcrumb', 'show' );

if( $kt_page_layout != "" ){
	$kt_sidebar_are = $kt_page_layout;
}

$sidebar_are_layout = 'sidebar-'.$kt_sidebar_are;

if( $kt_sidebar_are == "left" || $kt_sidebar_are == "right" ){
    $col_class = "main-content col-xs-12 col-sm-8 col-md-9"; 
}else{
    $col_class = "main-content page-full-width col-sm-12";
}
?>
<div id="primary" class="content-area <?php echo esc_attr( $sidebar_are_layout );?>">
	<main id="main" class="site-main">
    	<?php
    	if( $kt_show_page_breadcrumb == 'show' ) {
    		breadcrumb_trail();
    	}
    	?>
        <div class="row">
            <div class="<?php echo esc_attr($col_class);?>">
                <?php
				// Start the loop.
				while ( have_posts() ) : the_post();

					// Include the page content template.
					get_template_part( 'content', 'page' );

				// End the loop.
				endwhile;
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
	</main><!-- .site-main -->
</div><!-- .content-area -->

<?php get_footer(); ?>
