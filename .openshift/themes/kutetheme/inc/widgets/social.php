<?php
if ( ! defined( 'ABSPATH' ) ) {
    die;
}

/**
 * Pages widget class
 *
 * @since 1.0
 */
class Widget_KT_Social extends WP_Widget {

	public function __construct() {
		$widget_ops = array(
                        'classname' => 'widget_kt_social', 
                        'description' => esc_attr__( 'Accepted display social.', 'kutetheme' ) );
		parent::__construct( 'widget_kt_social', esc_attr__('KT Social', 'kutetheme' ), $widget_ops );
	}

	public function widget( $args, $instance ) {
	   echo apply_filters( 'kt_wg_before_widget', $args['before_widget'] );
       //Defaults
        $wtitle = (isset( $instance[ 'wtitle' ] ) && $instance[ 'wtitle' ] ) ? esc_html( $instance[ 'wtitle' ] ) : '';
        
        $facebook   = kt_option('kt_facebook_link_id');
        $twitter    = kt_option('kt_twitter_link_id');
        $pinterest  = kt_option('kt_pinterest_link_id');
        $dribbble   = kt_option('kt_dribbble_link_id');
        $vimeo      = kt_option('kt_vimeo_link_id');
        $tumblr     = kt_option('kt_tumblr_link_id');
        $skype      = kt_option('kt_skype_link_id');
        $linkedin   = kt_option('kt_linkedIn_link_id');
        $vk         = kt_option('kt_vk_link_id');
        $googleplus = kt_option('kt_google_plus_link_id');
        $youtube    = kt_option('kt_youtube_link_id');
        $instagram  = kt_option('kt_instagram_link_id');
        
        $social_icons = '';
        
        if ($facebook) {
            $social_icons .= '<a target="_blank" href="'.esc_url($facebook).'" title ="'.__( 'Facebook', 'kutetheme' ).'" ><i class="fa fa-facebook"></i></a>';
        }
        if ($twitter) {
            $social_icons .= '<a target="_blank" href="http://www.twitter.com/'.esc_attr($twitter).'" title = "'.__( 'Twitter', 'kutetheme' ).'" ><i class="fa fa-twitter"></i></a>';
        }
        if ($dribbble) {
            $social_icons .= '<a target="_blank" href="http://www.dribbble.com/'.esc_attr($dribbble).'" title ="'.__( 'Dribbble', 'kutetheme' ).'" ><i class="fa fa-dribbble"></i></a>';
        }
        if ($vimeo) {
            $social_icons .= '<a target="_blank" href="http://www.vimeo.com/'.esc_attr($vimeo).'" title ="'.__( 'Vimeo', 'kutetheme' ).'" ><i class="fa fa-vimeo-square"></i></a>';
        }
        if ($tumblr) {
            $social_icons .= '<a target="_blank" href="http://'.esc_attr($tumblr).'.tumblr.com/" title ="'.__( 'Tumblr', 'kutetheme' ).'" ><i class="fa fa-tumblr"></i></a>';
        } 
        if ($skype) {
            $social_icons .= '<a target="_blank" href="skype:'.esc_attr($skype).'" title ="'.__( 'Skype', 'kutetheme' ).'" ><i class="fa fa-skype"></i></a>';
        }
        if ($linkedin) {
            $social_icons .= '<a target="_blank" href="'.esc_attr($linkedin).'" title ="'.__( 'Linkedin', 'kutetheme' ).'" ><i class="fa fa-linkedin"></i></a>';
        }
        if ($googleplus) {
            $social_icons .= '<a target="_blank" href="'.esc_url( $googleplus ).'" title ="'.__( 'Google Plus', 'kutetheme' ).'" ><i class="fa fa-google-plus"></i></a>';
        }
        if ($youtube) {
            $social_icons .= '<a target="_blank" href="http://www.youtube.com/user/'.esc_attr( $youtube ).'" title ="'.__( 'Youtube', 'kutetheme' ).'"><i class="fa fa-youtube"></i></a>';
        }
        if ($pinterest) {
            $social_icons .= '<a target="_blank" href="http://www.pinterest.com/'.esc_attr( $pinterest ).'/" title ="'.__( 'Pinterest', 'kutetheme' ).'" ><i class="fa fa-pinterest-p"></i></a>';
        }
        if ($instagram) {
            $social_icons .= '<a target="_blank" href="http://instagram.com/'.esc_attr( $instagram ).'" title ="'.__( 'Instagram', 'kutetheme' ).'" ><i class="fa fa-instagram"></i></a>';
        }
        
        if ($vk) {
            $social_icons .= '<a target="_blank" href="https://vk.com/'.esc_attr( $vk ).'" title ="'.__( 'Vk', 'kutetheme' ).'" ><i class="fa fa-vk"></i></a>';
        }
        ?>
        <?php if($wtitle): ?>
        <div class="introduce-title"><?php echo esc_attr($wtitle) ?></div>
        <?php endif;?>
        <div class="social-link">
            <?php
                echo kt_get_html( $social_icons );
            ?>
        </div>
        <?php
       echo apply_filters( 'kt_wg_after_widget', $args[ 'after_widget' ] ) ;
	}

	public function update( $new_instance, $old_instance ) {
		$instance = $new_instance;
		$instance[ 'wtitle' ] = $new_instance[ 'wtitle' ] ? esc_html( $new_instance[ 'wtitle' ] ) : '';
		return $instance;
	}

	public function form( $instance ) {
		//Defaults
        $wtitle = (isset( $instance[ 'wtitle' ] ) && $instance[ 'wtitle' ] ) ? esc_html( $instance[ 'wtitle' ] ) : '';
	?>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'wtitle' ) ); ?>"><?php esc_html_e( 'Title:', 'kutetheme'); ?></label> 
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'wtitle' ) ) ; ?>" name="<?php echo esc_attr( $this->get_field_name('wtitle') ) ; ?>" type="text" value="<?php echo esc_attr( $wtitle ); ?>" />
        </p>
    <?php
	}

}
add_action( 'widgets_init', 'Widget_KT_Social');

function Widget_KT_Social(){
    register_widget( 'Widget_KT_Social' );
}