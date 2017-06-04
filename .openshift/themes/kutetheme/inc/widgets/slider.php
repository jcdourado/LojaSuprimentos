<?php
if ( ! defined( 'ABSPATH' ) ) {
    die;
}

/**
 * Pages widget class
 *
 * @since 1.0
 */
class Widget_KT_Slider extends WP_Widget {

	public function __construct() {
		$widget_ops = array(
                        'classname' => 'widget_kt_slider', 
                        'description' => esc_attr__( 'Slider Carousel on sidebar.', 'kutetheme' ) );
		parent::__construct( 'widget_kt_slider', esc_attr__('KT Slider', 'kutetheme' ), $widget_ops );
	}

	public function widget( $args, $instance ) {
	   echo apply_filters( 'kt_wg_before_widget', $args['before_widget'] );
       
		$autoplay   = ( isset( $instance[ 'autoplay' ] ) && $instance[ 'autoplay' ] )  ? "true" : "false";
        
        $loop       = ( isset( $instance[ 'loop' ] ) &&  $instance[ 'loop' ] ) ? "true" : "false";
        
        $slidespeed = ( isset( $instance[ 'slidespeed' ] ) && intval( $instance[ 'slidespeed' ] ) ) ? intval( $instance[ 'slidespeed' ] ) : 250;
       
       $data_carousel    = array(
            "autoplay"   => $autoplay,
            "slidespeed" => $slidespeed,
            "theme"      => 'style-navigation-bottom',
            'nav'        => "false",
            'loop'       => $loop,
            'items'      => 1
        );
       if( is_array( $instance[ 'image' ] ) && count($instance[ 'image' ]) < 2 ){
            $data_carousel[ 'loop' ] = false;
       }
       ?>
        <div class="col-left-slide left-module">
            <ul class="owl-carousel owl-style2" <?php echo _data_carousel($data_carousel); ?>>
                <?php
                    if( isset($instance[ 'image' ] ) && $instance[ 'image' ] && count( $instance[ 'image' ] ) > 0 ):
                    
                        for( $i = 0; $i < count( $instance[ 'image' ] ); $i++ ):
                        
                            $title       = ( isset($instance[ 'title' ][$i])  && $instance[ 'title' ][$i] ) ? esc_html( $instance[ 'title' ][$i] ) : '';
                            
                            $image       = ( isset($instance[ 'image' ][$i])  && intval( $instance[ 'image' ][$i] ) ) ? intval( $instance[ 'image' ][$i] ) : '';
                            
                            $link        = ( isset($instance[ 'link' ][$i])   && $instance[ 'link' ][$i] ) ? esc_url( $instance[ 'link' ][$i] ) : '#';
                            
                            $link_target = ( isset($instance[ 'target' ][$i]) && $instance[ 'target' ][$i] ) ? esc_attr( $instance[ 'target' ][$i] ) : '_blank';
                            
                            $img_preview = "";
                            
                            if( $image ){
                                $img_preview = wp_get_attachment_image_src($image, 'full');
                                if( is_array( $img_preview ) ){
                                     $img_preview = $img_preview[0];
                                     $preview = true;
                                }else{
                                    $img_preview = "";
                                }
                            }
                            if( $preview ):
                                ?>
                                <li>
                                    <a target="<?php echo esc_attr( $link_target );  ?>" title="<?php echo esc_attr( $title )  ;  ?>" href="<?php echo esc_url( $link )  ?>">
                                    <img src="<?php echo esc_url( $img_preview ); ?>" alt="<?php echo esc_attr( $title ) ;  ?>" /></a>
                                </li>
                            <?php endif; ?>
                    <?php endfor; ?>
                <?php endif; ?>
            </ul>
        </div>
       <?php
       echo apply_filters( 'kt_wg_after_widget', $args[ 'after_widget' ] ) ;
	}

	public function update( $new_instance, $old_instance ) {
		$instance = $new_instance;
        
		$instance[ 'autoplay' ]   = ( isset( $new_instance[ 'autoplay' ] ) && $new_instance[ 'autoplay' ] ) ? esc_attr( $new_instance[ 'autoplay' ] )  : '';
        
        $instance[ 'loop' ]       = ( isset( $new_instance[ 'loop' ] ) && $new_instance[ 'loop' ] ) ? esc_attr( $new_instance[ 'loop' ] )  : '';
        
        $instance[ 'slidespeed' ] = ( isset( $new_instance[ 'slidespeed' ] ) && intval( $new_instance[ 'slidespeed' ] ) ) ? intval( $new_instance[ 'slidespeed' ] ) : 250;
        
        if( isset( $new_instance[ 'image' ] ) && $new_instance[ 'image' ] && count( $new_instance[ 'image' ] ) > 0 ){
            $tmp = array();
            for( $i = 0; $i < count($new_instance['image']); $i++ ){
                
                $title       = ( isset($instance[ 'title' ][$i])  && $instance[ 'title' ][$i] ) ? esc_html( $instance[ 'title' ][$i] ) : '';
                            
                $image       = ( isset($instance[ 'image' ][$i])  && intval( $instance[ 'image' ][$i] ) ) ? intval( $instance[ 'image' ][$i] ) : '';
                
                $link        = ( isset($instance[ 'link' ][$i])   && $instance[ 'link' ][$i] ) ? esc_url( $instance[ 'link' ][$i] ) : '#';
                
                $link_target = ( isset($instance[ 'target' ][$i]) && $instance[ 'target' ][$i] ) ? esc_attr( $instance[ 'target' ][$i] ) : '_blank';
                
                
                if($image){
                    $tmp[ 'title' ][]   = esc_attr( $title )  ? esc_attr( $title ) : '';
                    $tmp[ 'image' ][]   = $image  ? $image : '';
                    $tmp[ 'link' ][]    = $link   ? $link : '#';
                    $tmp[ 'target '][]  = $target ? $target : '_blank';
                }
            }
            $instance[ 'title' ] = $tmp[ 'title' ];
            $instance[ 'image' ] = $tmp[ 'image' ];
            $instance[ 'link' ]  = $tmp[ 'link' ];
            $instance[ 'target' ]= $tmp[ 'target' ];
        }
		return $instance;
	}

	public function form( $instance ) {
		//Defaults
        $autoplay   = ( isset( $instance[ 'autoplay' ] ) && $instance[ 'autoplay' ] ) ? "true" : "false";
        
        $loop       = ( isset( $instance[ 'loop' ] ) && $instance[ 'loop' ] ) ? "true" : "false";
        
		$slidespeed = ( isset( $instance[ 'slidespeed' ] ) && intval( $instance[ 'slidespeed' ] ) ) ? intval($instance[ 'slidespeed' ]) : '250';
	?>
        <p>
			<input class="checkbox" <?php checked( esc_attr( $autoplay ) , "true" ); ?> type="checkbox" id="<?php echo esc_attr( $this->get_field_id('autoplay') ); ?>" name="<?php echo esc_attr( $this->get_field_name('autoplay') );  ?>" /> 
            <label for="<?php echo esc_attr( $this->get_field_id( 'autoplay' ) ); ?>"><?php esc_html_e( 'Auto next slide', 'kutetheme') ?></label>
		</p>
        <p>
			<input class="checkbox" <?php checked( esc_attr( $loop ) , "true" ); ?> type="checkbox" id="<?php echo esc_attr( $this->get_field_id('loop') ); ?>" name="<?php echo esc_attr( $this->get_field_name('loop') ); ?>" /> 
            <label for="<?php echo esc_attr( $this->get_field_id( 'loop' ) ); ?>"><?php esc_html_e( 'Inifnity loop. Duplicate last and first items to get loop illusion.', 'kutetheme') ?></label>
		</p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'slidespeed' ) ); ?>"><?php esc_html_e( 'Slide Speed:', 'kutetheme'); ?></label> 
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'slidespeed' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name('slidespeed') ); ?>" type="text" value="<?php echo esc_attr( $slidespeed ) ; ?>" />
        </p>
        <div class="content multi-item">
            <?php
                if(isset($instance[ 'image' ]) && $instance[ 'image' ] && count($instance[ 'image' ]) > 0 ){
                    for( $i = 0; $i < count($instance['image']); $i++ ){
                        
                        $title  = isset( $instance[ 'title' ][$i] )  && $instance[ 'title' ][$i]   ? esc_html( $instance[ 'title' ][$i] ) : '';
                        
                        $image  = isset( $instance[ 'image' ][$i] )  && $instance[ 'image' ][$i]   ? intval( $instance[ 'image' ][$i] ) : '';
                        
                        $link   = isset( $instance[ 'link' ][$i] )   && $instance[ 'link' ][$i]    ? esc_url( $instance[ 'link' ][$i] ) : '#';
                        
                        $target = isset( $instance[ 'target' ][$i] ) && $instance[ 'target' ][$i]  ? esc_attr( $instance[ 'target' ][$i] ) : '_blank';
                        
                        $img_preview = "";
                        if($image){
                            $img_preview = wp_get_attachment_image_src($image, 'full');
                            if( is_array($img_preview ) ) {
                                 $img_preview = $img_preview[0];
                                 $preview = true;
                            }else{
                                $img_preview = "";
                            }
                        }
                        if( $image ){?>
                            <div class="item widget-content">
                                <span class="remove"><?php esc_html_e( 'X', 'kutetheme' ) ?></span>
                                <p>
                                    <label><?php esc_html_e( 'Title:', 'kutetheme'); ?></label> 
                                    <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('title') ); ?>[]" type="text" value="<?php echo esc_html($title); ?>" />
                                </p>
                                <p style="text-align: center;">
                                    <input type="button" style="width: 100%; padding: 10px; height: auto;" class="button kt_image_upload" value="<?php esc_attr_e('Select your image', 'kutetheme') ?>" />
                                    <input class="widefat kt_image_attachment" id="<?php echo esc_attr( $this->get_field_id( 'image') ); ?>" name="<?php echo esc_attr( $this->get_field_name('image') ); ?>[]" type="hidden" value="<?php echo intval( $image ); ?>" />
                                </p>
                                <p class="kt_image_preview" style="<?php if( $preview ){ echo "display: block;";} ?>">
                                    <img src="<?php echo esc_url( $img_preview ); ?>" alt="" class="kt_image_preview_img" />
                                </p>
                                <p>
                                <label for="<?php echo esc_attr( $this->get_field_id( 'link' ) ); ?>"><?php esc_html_e( 'Link:', 'kutetheme'); ?></label> 
                                    <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'link') ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'link' ) ); ?>[]" type="text" value="<?php echo esc_url( $link ) ; ?>" />
                                </p>
                                <p>
                        			<label><?php esc_html_e( 'Target:', 'kutetheme'); ?></label>
                        			<select name="<?php echo esc_attr( $this->get_field_name('target') ); ?>[]" id="<?php echo esc_attr( $this->get_field_id('target') ); ?>" class="widefat">
                        				<option value="_blank"<?php selected( esc_attr( $target ) , '_blank' ); ?>><?php esc_html_e('Open New Window', 'kutetheme'); ?></option>
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
                        <span class="remove"><?php esc_html_e( 'X', 'kutetheme' ) ?></span>
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
add_action( 'widgets_init', 'Widget_KT_Slider');
function Widget_KT_Slider(){
    register_widget( 'Widget_KT_Slider' );
}