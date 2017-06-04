<?php get_header( );?>
<?php
the_post();
$_kt_page_colection_design = get_post_meta( get_the_ID(),'_kt_page_colection_design',true );
$_kt_page_gallery_colection = get_post_meta( get_the_ID(),'_kt_page_gallery_colection',true );
?>
<div class="container">
	<?php breadcrumb_trail();?>
	<div class="single-colection-container">
		<div class="row">
			<div class="col-sm-4">
				<div class="colection-images">
					<?php
					$src_full = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()),'full');
					?>
					<div class="main-image">
						<a class="fancybox" href="<?php echo esc_url( $src_full[0] );?>"><?php the_post_thumbnail('full');?></a>
					</div>
					
				</div>
			</div>
			<div class="col-sm-8">
				<div class="colection-single">
					<h1 class="colection-title"><?php the_title( );?></h1>
					<p class="designer"><?php _e('Designer','kutetheme');?>: <strong><?php echo esc_html( $_kt_page_colection_design );?></strong> </p>
					<div class="desc">
						<?php the_excerpt();?>
					</div>
					<?php if($_kt_page_gallery_colection): ?>
					<div class="colection-thumb  owl-carousel" data-nav="true" data-dots="false" data-margin="10" data-responsive='{"0":{"items":"1"},"768":{"items":"2"},"992":{"items":"3"}}'>
						<a class="thumb-item selected" href="<?php echo esc_url( $src_full[0] );?>"><?php the_post_thumbnail('colection_small_thumb');?></a>
						<?php
						foreach ($_kt_page_gallery_colection as $key => $value) {
							$gallery_colection_thumb = get_post_meta( get_the_ID(),'_kt_page_gallery_colection',true );
							?>
							<a class="thumb-item" href="<?php echo esc_url( $value );?>"><?php echo wp_get_attachment_image( $key, 'colection_small_thumb' );?></a>
							<?php
						}
						?>
					</div>
					<?php endif;?>
				</div>
			</div>

			<div class="col-sm-12">
				<div class="colection-content">
					<?php the_content();?>
				</div>
				<?php
            		$args = array(  
						'post_type'      => 'colection', 
						'post_status' 	 => 'publish',
						'posts_per_page' => 10
			        );
			        $colections = new WP_Query(  $args );
				?>
				<?php if($colections->have_posts()):?>
				<div class="related_colection">
					<h2><?php _e('Related Colections','kutetheme');?></h2>
					<ul class="related_colections block-collections owl-carousel" data-margin="30" data-dots="false" data-nav="true" data-responsive='{"0":{"items":"1"},"768":{"items":"2"},"992":{"items":"4"}}'>
						<?php 
						while ($colections->have_posts()) {
							$colections->the_post();
							?>
							<li>
								<?php if( has_post_thumbnail( )):?>
		        				<div class="image banner-boder-zoom2">
		        					<a href="<?php the_permalink();?>"><?php the_post_thumbnail( 'colection-thumb' );?></a>
		        				</div>
		        				<?php endif;?>	
		        				<div class="info">
                                    <h3 class="title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
                                    <div class="desc"><?php the_excerpt();?></div>
                                    <?php if( $_kt_page_colection_design ):?>
                                    <div class="author"><?php _e('Designed by','kutetheme');?>: <?php echo esc_html( $_kt_page_colection_design );?></div>
                                	<?php endif;?>
                                </div>
							</li>
						<?php
						}
						?>
					</ul>
				</div>
				<?php endif;?>
			</div>
		</div>
	</div>
</div>
<?php get_footer( );?>