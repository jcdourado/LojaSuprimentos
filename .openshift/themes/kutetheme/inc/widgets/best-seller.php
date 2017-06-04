<?php
if ( ! defined( 'ABSPATH' ) ) {
    die;
}

/**
 * Pages widget class
 *
 * @since 1.0
 */
class Widget_KT_Best_Seller extends WP_Widget {

	public function __construct() {
		$widget_ops = array(
                        'classname'   => 'widget_kt_best_seller', 
                        'description' => esc_attr__( 'Box best seller product on sidebar.', 'kutetheme' )
                    );
		parent::__construct( 'widget_kt_best_seller', esc_attr__('KT Best Seller', 'kutetheme' ), $widget_ops );
	}

	public function widget( $args, $instance ) {
        echo apply_filters( 'kt_wg_before_widget', $args['before_widget'] );
        
        $title   = ( isset( $instance[ 'title' ] )   && $instance[ 'title' ] )             ? esc_html ( $instance[ 'title' ] )   : esc_attr__( 'Best Sellers', 'kutetheme' );
        
        $number  = ( isset( $instance[ 'number' ] )  && intval( $instance[ 'number' ] ) )  ? intval( $instance[ 'number' ] )     : 6;
        
        $perpage = ( isset( $instance[ 'perpage' ] ) && intval( $instance[ 'perpage' ] ) ) ? intval( $instance[ 'perpage' ] )    : 3;
        
        $meta_query = WC()->query->get_meta_query();
        $params = array(
			'post_type'			  => 'product',
			'post_status'		  => 'publish',
			'ignore_sticky_posts' => 1,
			'posts_per_page'      => $number,
			'meta_query' 		  => $meta_query,
            'suppress_filter'     => true,
            'orderby'             => 'meta_value_num',
            'meta_key'            => 'total_sales'
		);
        $product = new WP_Query( $params );
        
        if( $product->have_posts() ):
        
            $speed    = ( isset( $instance[ 'speed' ] ) && ( intval( $instance[ 'speed' ] ) > 0 ) ) ? intval( $instance[ 'speed' ] ) : 250;
            
            $autoplay = ( isset( $instance[ 'autoplay' ] ) && ( $instance[ 'autoplay' ] ) ) ? 'true' : 'false';
            
            $loop     = ( isset( $instance[ 'loop' ] ) && ( $instance[ 'loop' ] ) ) ? 'true' : 'false';
            ?>
            <!-- block best sellers -->
            <div class="block left-module">
                <?php
                if( $title ){
                    echo apply_filters( 'kt_wg_before_title', $args['before_title'] ) ;
                    echo esc_html( $title ) ;
                    echo apply_filters( 'kt_wg_after_title', $args['after_title'] ) ;
                }
                $i = 1;
                $endtag = $perpage + 1;
                ob_start();
                ?>
                <?php while($product->have_posts()): $product->the_post(); ?>
                    <?php if( $i == 1 ): ?>
                    <ul class="products-block best-sell">
                    <?php endif; ?>
                        <?php wc_get_template_part( 'content', 'special-product-sidebar' ); ?>
                    <?php $i++; ?>
                    <?php if( $i == $endtag ): $i = 1; ?>
                    </ul>
                    <?php endif; ?>
                <?php endwhile; ?>
                <?php $html = ob_get_clean(); ?>
                <?php if( $i < 2 ){ $loop = 'false'; } ?>
                <div class="block_content">
                    <div class="owl-carousel owl-best-sell" data-slidespeed="<?php echo intval( $speed ); ?>" data-loop="<?php echo esc_attr( $loop ) ; ?>" data-nav = "false" data-margin = "0" data-autoplayTimeout="1000" data-autoplay="<?php echo esc_attr( $autoplay ) ; ?>" data-autoplayHoverPause = "true" data-items="1">
                        <?php echo kt_get_html( $html ); ?>
                    </div>
                </div>
            </div>
            <!-- ./block best sellers  -->
            <?php
        endif;
        wp_reset_query();
        wp_reset_postdata();
        echo apply_filters( 'kt_wg_after_widget', $args[ 'after_widget' ] ) ;
	}

	public function update( $new_instance, $old_instance ) {
		$instance = $new_instance;
        $instance[ 'title' ]    = ( isset( $new_instance[ 'title' ] )    && $new_instance[ 'title' ] )                 ? esc_html($new_instance[ 'title' ] ) : esc_attr__( 'Best Sellers', 'kutetheme' );
        
        $instance[ 'number' ]   = ( isset( $new_instance[ 'number' ] )   && intval( $new_instance[ 'perpage' ] ) > 0 ) ? intval( $new_instance[ 'number' ] ) : 6;
        
        $instance[ 'perpage' ]  = ( isset( $new_instance[ 'perpage' ] )  && intval( $new_instance[ 'perpage' ] ) > 0 ) ? intval( $new_instance[ 'perpage' ] ) : 3;
        
        $instance[ 'speed' ]    = ( isset( $new_instance[ 'speed' ] )    && intval( $new_instance[ 'speed' ] ) > 0 )   ? intval( $new_instance[ 'speed' ] ) : 250;
        
        $instance[ 'autoplay' ] = ( isset( $new_instance[ 'autoplay' ] ) && $new_instance[ 'autoplay' ] )              ? esc_attr( $new_instance[ 'autoplay' ] ) : '';
        
        $instance[ 'loop' ]     = ( isset( $new_instance[ 'loop' ] )     && $new_instance[ 'loop' ] )                  ? esc_attr( $new_instance[ 'loop' ] ) : '';
		
        return $instance;
	}

	public function form( $instance ) {
		//Defaults
        $title    = ( isset( $instance[ 'title' ] )    && $instance[ 'title' ] )                ? esc_html( $instance[ 'title' ] ) : esc_attr__( 'Best Sellers', 'kutetheme' );
        
        $number   = ( isset( $instance[ 'number' ] )   && intval( $instance[ 'number' ] ) > 0 ) ? intval( $instance[ 'number' ] ) : 6;
        
        $perpage  = ( isset( $instance[ 'perpage' ] )  && intval($instance[ 'perpage' ] ) > 0 ) ? intval( $instance[ 'perpage' ] ) : 3;
        
        $speed    = ( isset( $instance[ 'speed' ] )    && intval( $instance[ 'speed' ] ) > 0 )  ? intval( $instance[ 'speed' ] ) : 250;
        
        $autoplay = ( isset( $instance[ 'autoplay' ] ) && $instance[ 'autoplay' ] )             ? 'true' : 'false';
        
        $loop     = ( isset( $instance[ 'loop' ] )     && $instance[ 'loop' ] )                 ? 'true' : 'false';
	?>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ) ; ?>"><?php esc_html_e( 'Title:', 'kutetheme'); ?></label> 
            
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_html( $title ); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>"><?php esc_html_e( 'Number:', 'kutetheme'); ?></label> 
            
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'number' ) ); ?>" type="text" value="<?php echo intval( $number ); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'perpage' ) ); ?>"><?php esc_html_e( 'Perpage:', 'kutetheme'); ?></label> 
            
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'perpage' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name('perpage') ); ?>" type="text" value="<?php echo intval( $perpage ); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'speed' ) ); ?>"><?php esc_html_e( 'Speed Carousel:', 'kutetheme'); ?></label> 
            
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'speed' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name('speed') ); ?>" type="text" value="<?php echo intval( $speed ); ?>" />
        </p>
        
        <p>
            <input type="checkbox" <?php checked( esc_attr( $autoplay ), "true" ) ?> class="checkbox" id="<?php echo esc_attr( $this->get_field_id( 'autoplay' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'autoplay' ) ); ?>" />
            
            <label for="<?php echo esc_attr( $this->get_field_id( 'autoplay' ) ); ?>"><?php esc_html_e( 'Auto play', 'kutetheme' ) ?></label><br />
            
            <input type="checkbox" <?php checked( esc_attr( $loop ), "true" ) ?> class="checkbox" id="<?php echo esc_attr( $this->get_field_id( 'loop' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name('loop') ); ?>" />
            
            <label for="<?php echo esc_attr( $this->get_field_id( 'loop' ) ); ?>"><?php esc_html_e( 'Loop', 'kutetheme' ); ?></label><br />
        </p>
    <?php
	}

}
add_action( 'widgets_init', 'Widget_KT_Best_Seller');
function Widget_KT_Best_Seller(){
    register_widget( 'Widget_KT_Best_Seller' );
}