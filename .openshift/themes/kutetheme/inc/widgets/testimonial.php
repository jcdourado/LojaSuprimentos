<?php
if ( ! defined( 'ABSPATH' ) ) {
    die;
}

/**
 * Pages widget class
 *
 * @since 1.0
 */
class Widget_KT_Testimonial extends WP_Widget {

	public function __construct() {
		$widget_ops = array(
                        'classname' => 'widget_kt_testimonial', 
                        'description' => esc_attr__( 'Testimonial Carousel on sidebar.', 'kutetheme' ) );
		parent::__construct( 'widget_kt_testimonial', esc_attr__('KT Testimonial', 'kutetheme' ), $widget_ops );
	}

	public function widget( $args, $instance ) {
        echo apply_filters( 'kt_wg_before_widget', $args['before_widget'] );
        
        
        $title   = ( isset( $instance[ 'title' ] )   && $instance[ 'title' ] ) ? esc_html( $instance[ 'title' ] ) : '';
        $number  = ( isset( $instance[ 'number' ] )  && intval( $instance[ 'number' ] ) > 0 )  ? intval( $instance[ 'number' ] )  : 3;
        $orderby = ( isset( $instance[ 'orderby' ] ) && $instance[ 'orderby' ] ) ? esc_attr( $instance[ 'orderby' ] ) : 'date';
        $order   = ( isset( $instance[ 'order' ] )   && $instance[ 'order' ] ) ? esc_attr( $instance[ 'order' ] )   : 'desc';
        
        
        $autoplay   = ( isset( $instance[ 'autoplay' ] )   && $instance[ 'autoplay' ] ) ? "true" : "false";
        $loop       = ( isset( $instance[ 'loop' ] )       && $instance[ 'loop' ] ) ? "true" : "false";
		$slidespeed = ( isset( $instance[ 'slidespeed' ] ) && intval( $instance[ 'slidespeed' ] ) ) ? intval( $instance[ 'slidespeed' ] ) : '250';
        
        
        if( $title ){
            echo apply_filters( 'kt_wg_before_title', $args['before_title'] ) ;
            echo esc_html( $title );
            echo apply_filters( 'kt_wg_after_title', $args['after_title'] ) ;
        }
        $query = array( 
            'post_type' => 'testimonial', 
            'number'    => intval( $number ),
            'orderby'   => esc_attr( $orderby ),
            'order'     => esc_attr( $order )
        );
        $data_carousel    = array(
            "autoplay"   => $autoplay,
            "slidespeed" => $slidespeed,
            "theme"      => 'style-navigation-bottom',
            'nav'        => "false",
            'items'      => 1
        );
        $pages = new WP_Query( $query );
        if($pages->have_posts()):
            if( $pages->have_posts() ) $data_carousel['loop'] = esc_attr( $loop ) ;
           ?>
           <!-- Testimonials -->
            <div class="block left-module container-testimonials">
                <div class="block_content">
                    <ul class="testimonials owl-carousel" <?php echo _data_carousel($data_carousel); ?>>
                        <?php while($pages->have_posts()): $pages->the_post(); ?>
                        <li>
                            <div class="client-mane"><?php the_title(); ?></div>
                            <div class="client-avarta">
                                <?php the_post_thumbnail( '110x110' ); ?>
                            </div>
                            <div class="testimonial">
                                <?php the_content();  ?>
                            </div>
                        </li>
                        <?php endwhile; ?>
                    </ul>
                </div>
            </div>
            <!-- ./Testimonials -->
       <?php
       endif;
       wp_reset_query();
       wp_reset_postdata();
       echo apply_filters( 'kt_wg_after_widget', $args[ 'after_widget' ] ) ;
	}

	public function update( $new_instance, $old_instance ) {
		$instance = $new_instance;
        
        $instance[ 'title' ]      = ( isset( $new_instance[ 'title' ] )        && $new_instance[ 'title' ] )                ? esc_html( $new_instance[ 'title' ] )      : '';
        
		$instance[ 'autoplay' ]   = ( isset( $new_instance[ 'autoplay' ] )     && $new_instance[ 'autoplay' ] )             ? esc_attr( $new_instance[ 'autoplay' ] )   : "";
        
        $instance[ 'loop' ]       = ( isset( $new_instance[ 'loop' ] )         && $new_instance[ 'loop' ]  )                ? esc_attr( $new_instance[ 'loop' ] )       : "";
        
        $instance[ 'slidespeed' ] = ( isset( $new_instance[ 'slidespeed' ] )   && intval( $new_instance[ 'slidespeed' ] ) ) ? intval( $new_instance[ 'slidespeed' ] )   : 250;
        
        $instance[ 'number' ]     = ( isset( $new_instance[ 'number' ] )       && intval( $new_instance[ 'number' ] ) > 0 ) ? intval( $new_instance[ 'number' ] )       : 3;
        
        $instance[ 'orderby' ]    = ( isset( $new_instance[ 'orderby' ] )      && $new_instance[ 'orderby' ] )              ? esc_attr( $new_instance[ 'orderby' ] )    : 'date';
        
        $instance[ 'order' ]      = ( isset( $new_instance[ 'order' ] )        && $new_instance[ 'order' ] )                ? esc_attr( $new_instance[ 'order' ] )      : 'desc';
        
		return $instance;
	}

	public function form( $instance ) {
		//Defaults
        $title      = ( isset( $instance[ 'title' ] ) && $instance[ 'title' ] ) ? esc_html( $instance[ 'title' ] ) : '';
        
        $autoplay   = ( isset( $instance[ 'autoplay' ] ) && $instance[ 'autoplay' ] ) ? "true" : "false";
        
        $loop       = ( isset( $instance[ 'loop' ] ) && $instance[ 'loop' ] ) ? "true" : "false";
		
        $slidespeed = ( isset( $instance[ 'slidespeed' ] ) && intval( $instance[ 'slidespeed' ] ) ) ? intval( $instance[ 'slidespeed' ] ) : 250;
        
        $number  = ( isset( $instance[ 'number' ] ) && intval( $instance[ 'number' ] ) > 0 )  ? intval( $instance[ 'number' ] )  : 3;
        
        $orderby = ( isset( $instance[ 'orderby' ] ) && $instance[ 'orderby' ] ) ? esc_attr( $instance[ 'orderby' ] ) : 'date';
        
        $order   = ( isset( $instance[ 'order' ] ) && $instance[ 'order' ] ) ? esc_attr( $instance[ 'order' ] )   : 'desc';
	?>
        
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'kutetheme'); ?></label> 
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
        </p>
        <p>
			<input class="checkbox" <?php checked( esc_attr( $autoplay ), "true" ); ?> type="checkbox" id="<?php echo esc_attr( $this->get_field_id('autoplay') ); ?>" name="<?php echo esc_attr( $this->get_field_name('autoplay') ); ?>" /> 
            <label for="<?php echo esc_attr( $this->get_field_id( 'autoplay' ) ); ?>"><?php esc_html_e( 'Auto next slide', 'kutetheme' ) ?></label>
		</p>
        <p>
			<input class="checkbox" <?php checked( esc_attr( $loop ), "true" ); ?> type="checkbox" id="<?php echo esc_attr( $this->get_field_id('loop') ); ?>" name="<?php echo esc_attr( $this->get_field_name('loop') ); ?>" /> 
            <label for="<?php echo esc_attr( $this->get_field_id( 'loop' ) ); ?>"><?php esc_html_e( 'Inifnity loop. Duplicate last and first items to get loop illusion.', 'kutetheme' ) ?></label>
		</p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'slidespeed' ) ); ?>"><?php esc_html_e( 'Slide Speed:', 'kutetheme'); ?></label> 
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'slidespeed' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name('slidespeed') ); ?>" type="text" value="<?php echo intval( $slidespeed ); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>"><?php esc_html_e( 'Number:', 'kutetheme'); ?></label> 
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name('number') ); ?>" type="text" value="<?php echo intval( $number ); ?>" />
        </p>
        
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'orderby' ) ); ?>"><?php esc_html_e( 'Order By:', 'kutetheme'); ?></label> 
            <select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'orderby' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name('orderby') ); ?>">
                <option value="id" <?php selected( esc_attr( $orderby ), 'id' ) ?>><?php esc_html_e( 'ID', 'kutetheme' ) ?></option>
            	<option class="author" value="author" <?php selected( esc_attr( $orderby ), 'author' ) ?>><?php esc_html_e( 'Author', 'kutetheme' ) ?></option>
            	<option class="name" value="name" <?php selected( esc_attr( $orderby ), 'name' ) ?>><?php esc_html_e( 'Name', 'kutetheme' ) ?></option>
            	<option class="date" value="date" <?php selected( esc_attr( $orderby ), 'date' ) ?>><?php esc_html_e( 'Date', 'kutetheme' ) ?></option>
            	<option class="modified" value="modified" <?php selected( esc_attr( $orderby ), 'modified' ) ?>><?php esc_html_e( 'Modified', 'kutetheme' ) ?></option>
            	<option class="rand" value="rand" <?php selected( esc_attr( $orderby ), 'rand' ) ?>><?php esc_html_e( 'Rand', 'kutetheme' ) ?></option>
            </select>
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'order' ) ); ?>"><?php esc_html_e( 'Order Way:', 'kutetheme'); ?></label> 
            <select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'order' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name('order') ); ?>">
                <option value="desc" <?php selected( esc_attr( $order ), 'desc' ) ?>><?php esc_html_e( 'DESC', 'kutetheme' ) ?></option>
            	<option value="asc" <?php selected( esc_attr( $order ), 'asc' ) ?>><?php esc_html_e( 'ASC', 'kutetheme' ) ?></option>
            </select>
        </p>
        
    <?php
	}

}
add_action( 'widgets_init', 'Widget_KT_Testimonial');

function Widget_KT_Testimonial(){
    register_widget( 'Widget_KT_Testimonial' );
}