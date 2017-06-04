<?php
if ( ! defined( 'ABSPATH' ) ) {
    die;
}


/**
 * Pages widget class
 *
 * @since 1.0
 */
class WP_Widget_KT_Image extends WP_Widget {

	public function __construct() {
		$widget_ops = array( 'classname' => 'widget_kt_image', 'description' => esc_attr__( 'Image for widget.', 'kutetheme' ) );
		parent::__construct( 'kt_image', esc_attr__('KT image', 'kutetheme' ), $widget_ops);
	}

	public function widget( $args, $instance ) {
        $attachment = wp_get_attachment_image_src( $instance[ 'attachment' ], 'full' );
        
        if($attachment && isset( $attachment[ 0 ] ) && $attachment[ 0 ] ){
            
    		echo  apply_filters( 'kt_wg_before_widget', $args['before_widget'] );
            
            $capture = ( isset( $instance[ 'capture' ] ) ) ? esc_attr( $instance[ 'capture' ] ) : '';
            
            $link = ( isset( $instance [ 'link' ] ) )      ? esc_url( $instance[ 'link' ] ) : '#';
            
            $target = ( isset( $instance[ 'target' ] ) )   ? esc_attr( $instance[ 'target' ] ) : '_blank';
            
            ?>
            <div class="block left-module">
                <div class="banner-opacity">
                    <a href="<?php echo esc_url( $link ) ;  ?>" target="<?php echo esc_attr( $target )  ?>"><img src="<?php echo esc_url($attachment[ 0 ]) ?>" alt="<?php echo esc_attr( $capture ) ; ?>" /></a>
                </div>
            </div>
            <?php
            
    		echo apply_filters( 'kt_wg_after_widget', $args[ 'after_widget' ] ) ;
		}
	}

	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
        
		$instance[ 'link' ]   = esc_url( $new_instance[ 'link' ] );
        
        $instance[ 'target' ] = esc_attr( $new_instance[ 'target' ] );
        
        $instance[ 'size' ]   = esc_attr( $new_instance[ 'size' ] );
        
        $instance[ 'attachment' ] = intval($new_instance[ 'attachment' ]);
        
		return $instance;
	}

	public function form( $instance ) {
		//Defaults
		$instance = wp_parse_args( (array) $instance, array( 'target' => '_self') );
        
        if( isset( $instance[ 'link' ] ) ) $link = esc_url( $instance[ 'link' ] ); else $link = "";
        
        if( isset( $instance[ 'attachment' ] ) ) $attachment = intval( $instance[ 'attachment' ] ); else $attachment = "";
        
        $preview = false;
        
        $img_preview = "";
        
        if( isset( $instance[ 'attachment' ] ) && intval($instance[ 'attachment' ] ) > 0 ){
            
            $file = wp_get_attachment_image_src( $instance[ 'attachment' ], 'full' );
            
            $preview = true;
            
            $img_preview = $file[ 0 ];
        }
		$capture = ( isset( $instance[ 'capture' ] ) ) ? esc_attr( $instance[ 'capture' ] ) : '';
	?>
        
        <p style="text-align: center;">
            <input type="button" style="width: 100%; padding: 10px; height: auto;" class="button kt_image_upload" value="<?php esc_attr_e( 'Select your image', 'kutetheme') ?>" />
            <input class="widefat kt_image_attachment" id="<?php echo esc_attr( $this->get_field_id( 'attachment' ) ); ?>" name="<?php echo esc_attr(  $this->get_field_name( 'attachment' ) ); ?>" type="hidden" value="<?php echo intval( $attachment ); ?>" />
        </p>
        <p class="kt_image_preview" style="<?php if( $preview ){ echo "display: block;";} ?>">
            <img src="<?php echo esc_url( $img_preview ); ?>" alt="" class="kt_image_preview_img" />
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'capture' ) ); ?>"><?php esc_html_e( 'Capture:', 'kutetheme'); ?></label> 
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'capture' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'capture' ) ); ?>" type="text" value="<?php echo esc_attr( $capture ); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'link' ) ); ?>"><?php esc_html_e( 'Link:', 'kutetheme'); ?></label> 
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'link' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'link' ) ); ?>" type="text" value="<?php echo esc_url( $link ); ?>" />
        </p>
        <p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'target' ) ); ?>"><?php esc_html_e( 'Target:', 'kutetheme'); ?></label>
			
            <select name="<?php echo esc_attr( $this->get_field_name( 'target' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id('target') ); ?>" class="widefat">
				<option value="_self"<?php selected( esc_attr( $instance[ 'target' ] ), '_self' ); ?>><?php esc_html_e( 'Stay in Window', 'kutetheme' ); ?></option>
				<option value="_blank"<?php selected( esc_attr( $instance[ 'target' ] ), '_blank' ); ?>><?php esc_html_e( 'Open New Window', 'kutetheme' ); ?></option>
			</select>
		</p>
    <?php
	}

}

function kt_image_register_widgets() {
	register_widget( 'WP_Widget_KT_Image' );
}

add_action( 'widgets_init', 'kt_image_register_widgets' );