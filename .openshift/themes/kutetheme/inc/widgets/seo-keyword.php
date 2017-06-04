<?php
if ( ! defined( 'ABSPATH' ) ) {
    die;
}

/**
 * Pages widget class
 *
 * @since 1.0
 */
class Widget_KT_SEO_Keyword extends WP_Widget {

	public function __construct() {
		$widget_ops = array(
                        'classname' => 'widget_kt_seo_keyword', 
                        'description' => esc_attr__( 'Show trademark, link, keyword, ...', 'kutetheme' ) );
		parent::__construct( 'widget_kt_seo_keyword', esc_attr__('KT SEO Keyword', 'kutetheme' ), $widget_ops );
	}

	public function widget( $args, $instance ) {
	   echo apply_filters( 'kt_wg_before_widget', $args['before_widget'] );
       //Defaults
        $wtitle = (isset( $instance[ 'wtitle' ] ) && $instance[ 'wtitle' ] ) ? esc_attr( $instance[ 'wtitle' ] ) : '';
       ?>
       <ul class="trademark-list">
            <li class="trademark-text-tit"><?php echo esc_html( $wtitle ) ; ?><?php esc_html_e( ":", 'kutetheme' ) ; ?></li>
            <?php 
             if( isset( $instance[ 'title' ] ) && $instance[ 'title' ] && count( $instance[ 'title' ] ) > 0 ):
                for( $i = 0; $i < count($instance['title']); $i++ ):
                
                    $title  = isset( $instance[ 'title' ][ $i ] )  && $instance[ 'title' ][$i]   ? esc_attr( $instance[ 'title' ][$i] ) : '';
                    
                    $link   = isset( $instance[ 'link' ][ $i ] )   && $instance[ 'link' ][$i]    ? esc_url( $instance[ 'link' ][$i] ) : '#';
                    
                    $target = isset( $instance[ 'target' ][ $i ] ) && $instance[ 'target' ][$i]  ? esc_attr( $instance[ 'target' ][$i] ) : '_blank';
                    
                    if($title): ?>
                        <li><a target="<?php echo esc_attr( $target ); ?>" href="<?php echo esc_url( $link ); ?>"><?php echo esc_html( $title ) ?></a></li>
                    <?php endif; ?>
                <?php endfor; ?>
            <?php endif; ?>
        </ul>
       <?php
       echo apply_filters( 'kt_wg_after_widget', $args[ 'after_widget' ] ) ;
	}

	public function update( $new_instance, $old_instance ) {
		$instance = $new_instance;
		$instance[ 'wtitle' ] = isset( $new_instance[ 'wtitle' ] ) && $new_instance[ 'wtitle' ] ? esc_html( $new_instance[ 'wtitle' ] ) : '';
        
        if( isset( $new_instance[ 'title' ] ) && $new_instance[ 'title' ] && count( $new_instance[ 'title' ] ) > 0 ){
            $tmp = array();
            for( $i = 0; $i < count( $new_instance['title'] ); $i++ ) {
                
                $title  = isset( $new_instance[ 'title' ][ $i ] )  && $new_instance[ 'title' ][$i]   ? esc_attr( $new_instance[ 'title' ][$i] ) : '';
                    
                $link   = isset( $new_instance[ 'link' ][ $i ] )   && $new_instance[ 'link' ][$i]    ? esc_url( $new_instance[ 'link' ][$i] ) : '#';
                    
                $target = isset( $new_instance[ 'target' ][ $i ] ) && $new_instance[ 'target' ][$i]  ? esc_attr( $new_instance[ 'target' ][$i] ) : '_blank';
                
                if( $title ){
                    $tmp[ 'title' ][]   = esc_html( $title ) ?  esc_html( $title ) : '';
                    $tmp[ 'link' ][]    = $link ? $link : '#';
                    $tmp[ 'target '][]  = $target ? $target : '_blank';
                }
            }
            $instance[ 'title' ]  = $tmp[ 'title' ];
            $instance[ 'link' ]   = $tmp[ 'link' ];
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
            <input class="widefat" id="<?php echo  esc_attr( $this->get_field_id( 'wtitle' ) ) ; ?>" name="<?php echo  esc_attr( $this->get_field_name('wtitle') ) ; ?>" type="text" value="<?php echo esc_html( $wtitle ); ?>" />
        </p>
        <div class="content multi-item">
            <?php
                if(isset($instance[ 'title' ]) && $instance[ 'title' ] && count($instance[ 'title' ]) > 0 ){
                    for( $i = 0; $i < count( $instance['title'] ); $i++ ){
                        
                        $title  = isset( $instance[ 'title' ][ $i ] )  && $instance[ 'title' ][$i]  ? esc_attr( $instance[ 'title' ][$i] ) : '';
                    
                        $link   = isset( $instance[ 'link' ][ $i ] )   && $instance[ 'link' ][$i]   ? esc_url( $instance[ 'link' ][$i] ) : '#';
                            
                        $target = isset( $instance[ 'target' ][ $i ] ) && $instance[ 'target' ][$i] ? esc_attr( $instance[ 'target' ][$i] ) : '_blank';

                        if($title){?>
                        <div class="item widget-content">
                            <span class="remove"><?php esc_html_e('X', 'kutetheme');?></span>
                            <p>
                                <label><?php esc_html_e( 'Title:', 'kutetheme'); ?></label> 
                                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('title') ); ?>[]" type="text" value="<?php echo esc_html( $title ); ?>" />
                            </p>
                            <p>
                                <label for="<?php echo esc_attr( $this->get_field_id( 'link' ) ); ?>"><?php esc_html_e( 'Link:', 'kutetheme'); ?></label> 
                                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'link') ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'link' ) ); ?>[]" type="text" value="<?php echo esc_url( $link ) ; ?>" />
                            </p>
                            <p>
                    			<label><?php esc_html_e( 'Target:', 'kutetheme'); ?></label>
                    			<select name="<?php echo esc_attr( $this->get_field_name('target') ); ?>[]" id="<?php echo esc_attr( $this->get_field_id('target') ); ?>" class="widefat">
                    				<option value="_blank"<?php selected( esc_attr( $target ) , '_blank' ); ?>><?php esc_html_e( 'Open New Window', 'kutetheme'); ?></option>
                    				<option value="_self"<?php selected( esc_attr( $target ), '_self' ); ?>><?php esc_html_e( 'Stay in Window', 'kutetheme'); ?></option>
                    			</select>
                    		</p>
                        </div>
                    <?php }
                    }
                }else{?>
                    <div class="item widget-content">
                        <span class="remove"><?php esc_html_e('X', 'kutetheme');?></span>
                        <p>
                            <label><?php esc_html_e( 'Title:', 'kutetheme'); ?></label> 
                            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>[]" type="text" />
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
                        
                        <p>
                            <label for="<?php echo esc_attr( $this->get_field_id('link') ); ?>"><?php esc_html_e('Link:', 'kutetheme'); ?></label> 
                            <input class="widefat widget-name" id="<?php echo esc_attr( $this->get_field_id('link') ); ?>" tpl-name="<?php echo esc_attr( $this->get_field_name('link') ); ?>[]" type="text" />
                        </p>
                        
                        <p>
                			<label><?php esc_html_e( 'Target:', 'kutetheme'); ?></label>
                			<select tpl-name="<?php echo esc_attr( $this->get_field_name('target') ); ?>[]" id="<?php echo esc_attr( $this->get_field_id('target') ); ?>" class="widefat widget-name">
                				<option value="_blank"><?php esc_html_e( 'Open New Window', 'kutetheme'); ?></option>
                				<option value="_self"><?php esc_html_e( 'Stay in Window', 'kutetheme'); ?></option>
                			</select>
                		</p>
                    </div>
                </div>
            </div>
            <p></p>
        </div>
    <?php
	}

}
add_action( 'widgets_init','Widget_KT_SEO_Keyword');

function Widget_KT_SEO_Keyword(){
    register_widget( 'Widget_KT_SEO_Keyword' );
}