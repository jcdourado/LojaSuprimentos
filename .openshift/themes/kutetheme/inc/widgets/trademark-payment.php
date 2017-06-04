<?php
if ( ! defined( 'ABSPATH' ) ) {
    die;
}

/**
 * Pages widget class
 *
 * @since 1.0
 */
class Widget_KT_Trademark_Payment extends WP_Widget {

	public function __construct() {
		$widget_ops = array(
                        'classname' => 'widget_kt_trademark_payment', 
                        'description' => esc_attr__( 'Accepted trademark payment.', 'kutetheme' ) );
		parent::__construct( 'widget_kt_trademark_payment', esc_attr__('KT Trademark Payment', 'kutetheme' ), $widget_ops );
	}

	public function widget( $args, $instance ) {
	   echo apply_filters( 'kt_wg_before_widget', $args['before_widget'] );
       //Defaults
        $wtitle = (isset( $instance[ 'wtitle' ] ) && $instance[ 'wtitle' ] ) ? esc_html( $instance[ 'wtitle' ] ) : '';
       ?>
       <ul id="trademark-list">
            <li id="payment-methods"><?php echo esc_attr( $wtitle ) ; ?><?php echo ":"; ?></li>
            <?php 
             if(isset( $instance[ 'title' ]) && $instance[ 'title' ] && count($instance[ 'title' ]) > 0 ):
                for( $i = 0; $i < count($instance['title']); $i++ ):
                
                    $title  = ( isset($instance[ 'title' ][$i])   && $instance[ 'title' ][$i] )   ? esc_html( $instance[ 'title' ][$i] )        : '';
                    $image  = ( isset($instance[ 'image' ][$i])   && intval( $instance[ 'image' ][$i] ) ) ? intval( $instance[ 'image' ][$i] )  : '';
                    $link   = ( isset($instance[ 'link' ][$i])    && $instance[ 'link' ][$i] )    ? esc_url( $instance[ 'link' ][$i] )          : '#';
                    $target = ( isset($instance[ 'target' ][$i])  && $instance[ 'target' ][$i]  ) ? esc_attr( $instance[ 'target' ][$i] )       : '_blank';
                    
                    $img_preview = "";
                    if($image){
                        $img_preview = wp_get_attachment_image( intval( $image ), 'full' );
                    }
                    if( $title && $img_preview ):
                        ?>
                        <li>
                            <a target="<?php echo esc_attr( $target ) ?>" href="<?php echo esc_url( $link );  ?>">
                                <?php echo apply_filters( 'kt_trademark_image', $img_preview ); ?>
                            </a>
                        </li>
                    <?php endif; ?>
                <?php endfor; ?>
            <?php endif; ?>
        </ul>
       <?php
       echo apply_filters( 'kt_wg_after_widget', $args[ 'after_widget' ] ) ;
	}

	public function update( $new_instance, $old_instance ) {
		$instance = $new_instance;
		$instance[ 'wtitle' ] = $new_instance[ 'wtitle' ] ? $new_instance[ 'wtitle' ] : '';
        
        if( isset( $new_instance[ 'title' ] ) && $new_instance[ 'title' ] && count( $new_instance[ 'title' ] ) > 0 ){
            $tmp = array();
            for( $i = 0; $i < count($new_instance['title']); $i++ ){
                
                $title  = ( isset($new_instance[ 'title' ][$i])  && $new_instance[ 'title' ][$i] )   ? esc_html( $new_instance[ 'title' ][$i] ) : '';
                
                $image  = ( isset($new_instance[ 'image' ][$i])  && intval( $new_instance[ 'image' ][$i] ) ) ? intval( $new_instance[ 'image' ][$i] ) : '';
                
                $link   = ( isset($new_instance[ 'link' ][$i])   && $new_instance[ 'link' ][$i] )    ? esc_url( $new_instance[ 'link' ][$i] ): '#';
                
                $target = ( isset($new_instance[ 'target' ][$i]) && $new_instance[ 'target' ][$i]  ) ? esc_attr( $new_instance[ 'target' ][$i] ) : '_blank';
                
                if($title){
                    $tmp[ 'title' ][]   = $title ? $title : '';
                    $tmp[ 'image' ][]   = $image > 0 ? $image : '';
                    $tmp[ 'link' ][]    = $link ? $link : '#';
                    $tmp[ 'target '][]  = $target ? $target : '_blank';
                }
            }
            $instance[ 'title' ] = $tmp[ 'title' ];
            $instance[ 'image' ] = $tmp[ 'image' ];
            $instance[ 'link' ] = $tmp[ 'link' ];
            $instance[ 'target' ] = $tmp[ 'target' ];
        }
		return $instance;
	}

	public function form( $instance ) {
		//Defaults
        $wtitle = (isset( $instance[ 'wtitle' ] ) && $instance[ 'wtitle' ] ) ? esc_attr( $instance[ 'wtitle' ] )  : '';
	?>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'wtitle' ) ); ?>"><?php esc_html_e( 'Title:', 'kutetheme'); ?></label> 
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'wtitle' ) ) ; ?>" name="<?php echo esc_attr( $this->get_field_name('wtitle') ) ; ?>" type="text" value="<?php echo esc_attr($wtitle); ?>" />
        </p>
        <div class="content multi-item">
            <?php
                if(isset($instance[ 'title' ]) && $instance[ 'title' ] && count($instance[ 'title' ]) > 0 ){
                    for( $i = 0; $i < count($instance['title']); $i++ ){
                        
                        $title  = ( isset($instance[ 'title' ][$i])   && $instance[ 'title' ][$i] )   ? esc_html( $instance[ 'title' ][$i] ) : '';
                        
                        $image  = ( isset($instance[ 'image' ][$i])   && intval( $instance[ 'image' ][$i] ) ) ? intval( $instance[ 'image' ][$i] ) : '';
                        
                        $link   = ( isset($instance[ 'link' ][$i])    && $instance[ 'link' ][$i] )    ? esc_url( $instance[ 'link' ][$i] ): '#';
                        
                        $target = ( isset($instance[ 'target' ][$i])  && $instance[ 'target' ][$i]  ) ? esc_attr( $instance[ 'target' ][$i] ) : '_blank';
                        
                        $img_preview = "";
                        if($image){
                            $img_preview = wp_get_attachment_url($image);
                            $preview = true;
                        }
                        if( $title ){?>
                        <div class="item widget-content">
                            <span class="remove"><?php esc_html_e( 'X', 'kutetheme' );?></span>
                            <p>
                                <label><?php esc_html_e( 'Title:', 'kutetheme'); ?></label> 
                                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('title') ); ?>[]" type="text" value="<?php echo esc_attr($title); ?>" />
                            </p>
                            <p style="text-align: center;">
                                <input type="button" style="width: 100%; padding: 10px; height: auto;" class="button kt_image_upload" value="<?php esc_attr_e( 'Select your image', 'kutetheme') ?>" />
                                <input class="widefat kt_image_attachment" id="<?php echo esc_attr( $this->get_field_id( 'image') ); ?>" name="<?php echo esc_attr( $this->get_field_name('image') ); ?>[]" type="hidden" value="<?php echo intval( $image ); ?>" />
                            </p>
                            <p class="kt_image_preview" style="<?php if( $preview ){ echo "display: block;";} ?>">
                                <img src="<?php echo esc_url( $img_preview ); ?>" alt="" class="kt_image_preview_img" />
                            </p>
                            <p>
                            <label for="<?php echo esc_attr( $this->get_field_id( 'link' ) ); ?>"><?php esc_html_e( 'Link:', 'kutetheme'); ?></label> 
                                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'link') ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'link' ) ); ?>[]" type="text" value="<?php echo esc_url( $link ); ?>" />
                            </p>
                            <p>
                    			<label><?php esc_html_e( 'Target:', 'kutetheme'); ?></label>
                    			<select name="<?php echo esc_attr(  $this->get_field_name('target') ); ?>[]" id="<?php echo esc_attr( $this->get_field_id('target') ); ?>" class="widefat">
                    				<option value="_blank"<?php selected( esc_attr( $target ), '_blank' ); ?>><?php esc_html_e('Open New Window', 'kutetheme'); ?></option>
                    				<option value="_self"<?php selected( esc_attr( $target ), '_self' ); ?>><?php esc_html_e('Stay in Window', 'kutetheme'); ?></option>
                    			</select>
                    		</p>
                        </div>
                    <?php }
                    }
                }else{?>
                    <div class="item widget-content">
                        <span class="remove"><?php esc_html_e( 'X', 'kutetheme' ) ?></span>
                        <p>
                            <label><?php esc_html_e( 'Title:', 'kutetheme'); ?></label> 
                            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>[]" type="text" />
                        </p>
                        <p style="text-align: center;">
                            <input type="button" style="width: 100%; padding: 10px; height: auto;" class="button kt_image_upload" value="<?php esc_attr_e( 'Select your image', 'kutetheme' ) ?>" />
                            <input class="widefat kt_image_attachment" id="<?php echo esc_attr( $this->get_field_id( 'image' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'image' ) ); ?>[]" type="hidden"  />
                        </p>
                        <p class="kt_image_preview">
                            <img src="" alt="" class="kt_image_preview_img" />
                        </p>
                        <p>
                        <label for="<?php echo esc_attr( $this->get_field_id( 'link' ) ); ?>"><?php esc_html_e( 'Link:', 'kutetheme'); ?></label> 
                            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'link' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'link' ) ); ?>[]" type="text" />
                        </p>
                        <p>
                			<label><?php esc_html_e( 'Target:', 'kutetheme'); ?></label>
                			<select name="<?php echo esc_attr( $this->get_field_name( 'target' ) ); ?>[]" id="<?php echo esc_attr( $this->get_field_id( 'target' ) ); ?>" class="widefat">
                				<option value="_blank"><?php esc_html_e( 'Open New Window', 'kutetheme' ); ?></option>
                				<option value="_self"><?php esc_html_e( 'Stay in Window', 'kutetheme' ); ?></option>
                			</select>
                		</p>
                    </div>
            <?php } ?>
            
            <div style="text-align: right;" class="btn-template">
                <input type="button" class="button btn-plus" value="+" />
                <div class="template" style="display: none;">
                    <div class="item widget-content">
                        <span class="remove"><?php esc_html_e( 'X', 'kutetheme' );?></span>
                        <p>
                            <label><?php esc_html_e('Title:', 'kutetheme'); ?></label> 
                            <input class="widefat widget-name" id="<?php echo esc_attr( $this->get_field_id('title') ); ?>" tpl-name="<?php echo esc_attr( $this->get_field_name('title') ); ?>[]" type="text" />
                        </p>
                        
                        <p style="text-align: center;">
                            <input type="button" style="width: 100%; padding: 10px; height: auto;" class="button kt_image_upload" value="<?php esc_attr_e('Select your image', 'kutetheme') ?>" />
                            <input class="widefat widget-name kt_image_attachment" id="<?php echo esc_attr( $this->get_field_id('image') ); ?>" tpl-name="<?php echo esc_attr( $this->get_field_name('image') ); ?>[]" type="hidden" />
                        </p>
                        
                        <p class="kt_image_preview" style="display: none;">
                            <img src="" alt="" class="kt_image_preview_img" />
                        </p>
                        
                        <p>
                            <label for="<?php echo esc_attr( $this->get_field_id('link') ); ?>"><?php esc_html_e('Link:', 'kutetheme'); ?></label> 
                            <input class="widefat widget-name" id="<?php echo esc_attr( $this->get_field_id('link') ); ?>" tpl-name="<?php echo esc_attr( $this->get_field_name('link') ); ?>[]" type="text" />
                        </p>
                        
                        <p>
                			<label><?php esc_html_e( 'Target:', 'kutetheme'); ?></label>
                			<select tpl-name="<?php echo esc_attr( $this->get_field_name('target') ); ?>[]" id="<?php echo esc_attr( $this->get_field_id('target') ); ?>" class="widefat widget-name">
                				<option value="_blank"><?php esc_html_e('Open New Window', 'kutetheme'); ?></option>
                				<option value="_self"><?php esc_html_e('Stay in Window', 'kutetheme'); ?></option>
                			</select>
                		</p>
                    </div>
                </div>
            </div>
        </div>
    <?php
	}

}
add_action( 'widgets_init', 'Widget_KT_Trademark_Payment');

function Widget_KT_Trademark_Payment(){
      register_widget( 'Widget_KT_Trademark_Payment' );
}