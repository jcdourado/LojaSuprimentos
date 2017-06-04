<?php
/**
 * The template for displaying archive pages
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each one. For example, tag.php (Tag archives),
 * category.php (Category archives), author.php (Author archives), etc.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Kutetheme
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
            			<header>
            				<?php
            					the_archive_title( '<h1 class="page-title">', '</h1>' );
            					the_archive_description( '<div class="taxonomy-description">', '</div>' );
            				?>
            			</header><!-- .page-header -->
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
                <?php
                if( $kt_sidebar_are != 'full' ){
                    ?>
                    <div class="col-xs-12 col-sm-4 col-md-3">
                        <div class="sidebar">
                            <?php get_sidebar();?>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
	</main><!-- .site-main -->
</div><!-- .content-area -->

<?php get_footer(); ?>
