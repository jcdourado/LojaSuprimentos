<?php get_header();?>
<div class="main-container">
	<div class="container">
		<h1 class="look-book-page-title"><?php _e('Look Books','kutetheme');?></h1>
		<?php if( have_posts()):?>
		<div class="kt-lookbook kt-lookbook-list">
			<div class="lookbook-grid" data-layoutMode="masonry" data-cols="3">
				<?php while ( have_posts()) {
					the_post();
					$_kt_page_lookbook_location = get_post_meta( get_the_ID(),'_kt_page_lookbook_location',true );
					$full_image_src = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), "full" ); 
					?>
					<div class="item-lookbook">
						<div class="inner">
							<div class="image">
								<?php the_post_thumbnail('lookbook-thumb-masonry');?>
							</div>
							<div class="info">
								<h3 class="title"><?php the_title();?></h3>
								<?php if( $_kt_page_lookbook_location) :?>
								<span class="location"><?php echo esc_html( $_kt_page_lookbook_location );?></span>
								<?php endif;?>
							</div>
							<a class="icon-quickview fancybox" href="<?php echo esc_url( $full_image_src[0] );?>"><i class="fa fa-search"></i></a>
						</div>
					</div>
					<?php
				}?>
				</div>
			</div>
			<div class="blog-paging clearfix">
                <?php kt_paging_nav();?>
            </div>
		<?php else:?>
			<p><?php _e('No Look book item.','kutetheme');?></p>
		<?php endif;?>
	</div>
</div>
<?php get_footer();?>