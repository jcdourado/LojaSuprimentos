<?php
if ( ! defined( 'ABSPATH' ) ) {
    die;
}

/**
 * Pages widget class
 *
 * @since 1.0
 */
class Widget_KT_On_Sale extends WP_Widget {

	public function __construct() {
		$widget_ops = array(
                        'classname' => 'widget_kt_on_sale', 
                        'description' => esc_attr__( 'Box On Sale.', 'kutetheme' ) );
		parent::__construct( 'widget_kt_on_sale', esc_attr__('KT On Sale', 'kutetheme' ), $widget_ops );
	}

	public function widget( $args, $instance ) {
        echo apply_filters( 'kt_wg_before_widget', $args['before_widget'] );
        
        $title   = ( isset( $instance[ 'title' ] )   && $instance[ 'title' ] ) ? esc_html( $instance[ 'title' ] )   : '';
        
        $number  = ( isset( $instance[ 'number' ] )  && intval( $instance[ 'number' ] ) ) ? intval( $instance[ 'number' ] ) : 3;
        
        $orderby = ( isset( $instance[ 'orderby' ] ) && $instance[ 'orderby' ] ) ? esc_attr( $instance[ 'orderby' ] ) : 'date';
        
        $order   = ( isset( $instance[ 'order' ] )   && $instance[ 'order' ] )   ? esc_attr( $instance[ 'order' ] )   : 'desc';
        
        $meta_query = WC()->query->get_meta_query();
        $product_ids_on_sale = wc_get_product_ids_on_sale();
        $params = array(
			'post_type'				=> 'product',
			'post_status'			=> 'publish',
			'ignore_sticky_posts'	=> 1,
			'posts_per_page' 		=> $number,
			'meta_query' 			=> $meta_query,
            'suppress_filter'       => true,
            'orderby'               => $orderby,
            'order'	                => $order,
            'post__in'              => array_merge( array( 0 ), $product_ids_on_sale )
		);
        $product = new WP_Query( $params );
        if( $product->have_posts() ):
        ?>
        <!-- block best sellers -->
        <div class="block left-module">
            <?php 
                if( $title ){
                    echo apply_filters( 'kt_wg_before_title', $args['before_title'] ) ;
                    echo esc_html( $title );
                    echo apply_filters( 'kt_wg_after_title', $args['after_title'] ) ;
                }
                add_filter( 'woocommerce_sale_price_html', 'woocommerce_custom_sales_price', 10, 2 );
                add_filter("woocommerce_get_price_html_from_to", "kt_get_price_html_from_to", 10 , 4);
            ?>
            <div class="block_content product-onsale">
                <ul class="product-list owl-carousel" data-loop="false" data-nav = "false" data-margin = "0" data-autoplayTimeout="1000" data-autoplayHoverPause = "true" data-items="1" data-autoplay="false">
                    <?php while($product->have_posts()): $product->the_post(); ?>
                        <li>
                            <?php wc_get_template_part( 'content', 'on-sale-sidebar' ); ?>
                        </li>
                    <?php endwhile; ?>
                </ul>
            </div>
            <?php 
            remove_filter( "woocommerce_get_price_html_from_to", "kt_get_price_html_from_to", 10 , 4);
            remove_filter( 'woocommerce_sale_price_html', 'woocommerce_custom_sales_price', 10, 2 );
            ?>
        </div>
        <!-- ./block best sellers  -->
        <?php
        endif;
        echo apply_filters( 'kt_wg_after_widget', $args[ 'after_widget' ] ) ;
	}

	public function update( $new_instance, $old_instance ) {
		$instance = $new_instance;
        
        $instance[ 'title' ]    = ( isset( $new_instance[ 'title' ] ) && $new_instance[ 'title' ] ) ? esc_html( $new_instance[ 'title' ] ) : '';
        
        $instance[ 'number' ]   = ( isset( $new_instance[ 'number' ] ) && intval( $new_instance[ 'perpage' ] ) ) ? intval( $new_instance[ 'number' ] ) : 3;
        
        $instance[ 'orderby' ]  = ( isset( $new_instance[ 'orderby' ] ) && $new_instance[ 'orderby' ] ) ? esc_attr( $new_instance[ 'orderby' ] ) : 'date';
        
        $instance[ 'order' ]    = ( isset( $new_instance[ 'order' ] ) && $new_instance[ 'order' ] )   ? esc_attr( $new_instance[ 'order' ] ) : 'desc';
        
		return $instance;
	}

	public function form( $instance ) {
		//Defaults
        $title   = ( isset( $instance[ 'title' ] )   && $instance[ 'title' ] ) ? esc_html( $instance[ 'title' ] )   : '';
        
        $number  = ( isset( $instance[ 'number' ] )  && intval( $instance[ 'number' ] ) ) ? intval( $instance[ 'number' ] ) : 3;
        
        $orderby = ( isset( $instance[ 'orderby' ] ) && $instance[ 'orderby' ] ) ? esc_attr( $instance[ 'orderby' ] ) : 'date';
        
        $order   = ( isset( $instance[ 'order' ] )   && $instance[ 'order' ] )   ? esc_attr( $instance[ 'order' ] )   : 'desc';
        
	?>
        
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'kutetheme'); ?></label> 
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>"><?php esc_html_e( 'Number:', 'kutetheme'); ?></label> 
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name('number') ); ?>" type="text" value="<?php echo esc_attr( $number ); ?>" />
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
add_action( 'widgets_init','Widget_KT_On_Sale' );

function Widget_KT_On_Sale(){
    register_widget( 'Widget_KT_On_Sale' );
}