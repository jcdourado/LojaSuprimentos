<?php
if ( ! defined( 'ABSPATH' ) ) {
    die;
}

/**
 * Pages widget class
 *
 * @since 1.0
 */
class Widget_KT_Product_Special extends WP_Widget {

	public function __construct() {
		$widget_ops = array(
                        'classname' => 'widget_kt_product_special', 
                        'description' => esc_attr__( 'Box special product on sidebar.', 'kutetheme' ) );
		parent::__construct( 'widget_kt_product_special', esc_attr__('KT Special Product', 'kutetheme' ), $widget_ops );
	}

	public function widget( $args, $instance ) {
        echo apply_filters( 'kt_wg_before_widget', $args['before_widget'] );
        
        $title          = ( isset( $instance[ 'title' ] ) && $instance[ 'title' ]  ) ? esc_html( $instance[ 'title' ] )   : '';
        
        $orderby        = ( isset( $instance[ 'orderby' ] ) && $instance[ 'orderby' ] ) ? esc_attr( $instance[ 'orderby' ] ) : 'date';
        
        $order          = ( isset( $instance[ 'order' ] ) && $instance[ 'order' ] )   ? esc_attr( $instance[ 'order' ] )   : 'desc';
        
        $posts_per_page = ( isset( $instance[ 'posts_per_page' ] ) && $instance[ 'posts_per_page' ] ) ? intval( $instance[ 'posts_per_page' ] )   : '3';
        
        $meta_query = WC()->query->get_meta_query();
        
        $params = array(
			'post_type'				=> 'product',
			'post_status'			=> 'publish',
			'ignore_sticky_posts'	=> 1,
			'posts_per_page' 		=> $posts_per_page,
			'meta_query' 			=> $meta_query,
            'suppress_filter'       => true,
            'orderby'               => $orderby,
            'order'	                => $order
		);
        if( $title ){
            echo apply_filters( 'kt_wg_before_title', $args['before_title'] ) ;
            echo esc_html( $title ) ;
            echo apply_filters( 'kt_wg_after_title', $args['after_title'] ) ;
        }
        $product = new WP_Query( $params );
        ?>
        <!-- SPECIAL -->
        <div class="block left-module">
            <div class="block_content">
                <ul class="products-block">
                    <?php if ( $product->have_posts() ):?>
                            <?php while($product->have_posts()): $product->the_post(); ?>
                                <?php wc_get_template_part( 'content', 'special-product-sidebar' ); ?>
                            <?php endwhile; ?>
                    <?php
                        endif;
                        wp_reset_query();
                        wp_reset_postdata();
                        $shop_page_url = get_permalink( woocommerce_get_page_id( 'shop' ) );            
                    ?>
                </ul>
                <div class="products-block">
                    <div class="products-block-bottom">
                        <a class="link-all" href="<?php echo esc_url( $shop_page_url ) ; ?>"><?php esc_html_e( 'All Products', 'kutetheme' ) ?></a>
                    </div>
                </div>
            </div>                            
        </div>
        <!-- ./SPECIAL -->
        <?php
        echo apply_filters( 'kt_wg_after_widget', $args[ 'after_widget' ] ) ;
	}

	public function update( $new_instance, $old_instance ) {
        $instance                     = $new_instance; 
        
        $instance[ 'title' ]          = ( isset( $new_instance[ 'title' ] ) && $new_instance[ 'title' ] ) ? esc_html( $new_instance[ 'title' ] ) : '';
        
        $instance[ 'orderby' ]        = ( isset( $new_instance[ 'orderby' ] ) && $new_instance[ 'orderby' ] ) ? esc_attr( $new_instance[ 'orderby' ] ) : 'date';
        
        $instance[ 'order' ]          = ( isset( $new_instance[ 'order' ] ) && $new_instance[ 'order' ] )   ? esc_attr( $new_instance[ 'order' ] ) : 'desc';
        
        $instance[ 'posts_per_page' ] = ( isset( $new_instance[ 'posts_per_page' ] ) && $new_instance[ 'posts_per_page' ] )   ? intval( $new_instance[ 'posts_per_page' ] ) : '3';
        
		return $instance;
	}

	public function form( $instance ) {
		//Defaults
        $title          = ( isset( $instance[ 'title' ] ) && $instance[ 'title' ]  ) ? esc_html( $instance[ 'title' ] )   : '';
        
        $orderby        = ( isset( $instance[ 'orderby' ] ) && $instance[ 'orderby' ] ) ? esc_attr( $instance[ 'orderby' ] ) : 'date';
        
        $order          = ( isset( $instance[ 'order' ] ) && $instance[ 'order' ] )   ? esc_attr( $instance[ 'order' ] )   : 'desc';
        
        $posts_per_page = ( isset( $instance[ 'posts_per_page' ] ) && $instance[ 'posts_per_page' ] ) ? intval( $instance[ 'posts_per_page' ] )   : '3';
	?>
        
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'kutetheme'); ?></label> 
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
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
            	<option value="asc" <?php selected( esc_attr( $order ), 'asc') ?>><?php esc_html_e( 'ASC', 'kutetheme' ) ?></option>
            </select>
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'posts_per_page' ) ); ?>"><?php esc_html_e( 'Products per page:', 'kutetheme'); ?></label> 
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'posts_per_page' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name('posts_per_page') ); ?>" type="text" value="<?php echo esc_attr($posts_per_page); ?>" />
        </p>
        
    <?php
	}

}
add_action( 'widgets_init', 'Widget_KT_Product_Special');

function Widget_KT_Product_Special(){
    register_widget( 'Widget_KT_Product_Special' );
}