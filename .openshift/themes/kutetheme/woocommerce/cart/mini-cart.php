<?php
/**
 * Mini-cart
 *
 * Contains the markup for the mini-cart, used by the cart widget
 *
 * @author 		KuteTheme
 * @package 	THEME/WooCommerce
 * @version     2.6.2
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>

<?php do_action( 'woocommerce_before_mini_cart' ); ?>
<div class="widget_shopping_cart_content">
    <?php 
        global $woocommerce; 
        $cart_count =  WC()->cart->cart_contents_count ;
        $check_out_url = WC()->cart->get_checkout_url();
        $cart_url =  WC()->cart->get_cart_url();
        $kt_used_header = kt_option('kt_used_header', '1');
        $cart_subtotal = $woocommerce->cart->get_cart_subtotal();
    ?>
    <?php if( $kt_used_header == 1 ):?>
    <div id="cart-block" class="shopping-cart-box col-xs-5 col-sm-5 col-md-2">
        <a class="cart-link" href="<?php echo esc_url( $cart_url ); ?>">
            <span class="title"><?php esc_html_e( 'Shopping cart', 'kutetheme' ); ?></span>
            <span class="total"><?php echo sprintf ( _n( '%d item', '%d items', esc_attr( $cart_count ), 'kutetheme' ), esc_attr( $cart_count ) ) ?></span>
            <span><?php esc_html_e( '-', 'kutetheme' ); ?></span> 
            <?php echo WC()->cart->get_cart_total() ?>
            <span class="notify notify-left"><?php echo esc_attr( $cart_count ); ?></span>
        </a>
        <?php do_action( 'kt_mini_cart_content', esc_url(  $check_out_url ) ); ?>
    </div>
    <?php elseif( $kt_used_header == 2 ):?>
        <div class="col-xs-5 col-sm-4 col-md-2 group-button-header">
            <?php
                if(defined( 'YITH_WOOCOMPARE' )): global $yith_woocompare; $count = count($yith_woocompare->obj->products_list); ?>
                <a href="#" class="btn-compare yith-woocompare-open"><?php esc_html_e( "Compare", 'kutetheme') ?><span>(<?php echo intval( $count ) ?>)</span></a>
            <?php endif; ?>
            <?php if( function_exists( 'YITH_WCWL' ) ):
                $wishlist_url = YITH_WCWL()->get_wishlist_url(); ?>
                <a class="btn-heart" href="<?php echo esc_url( $wishlist_url ); ?>"><?php esc_html_e( 'Wishlists', 'kutetheme') ?></a>
            <?php endif; ?>
            <div class="btn-cart" id="cart-block">
                <a class="cart-link" title="<?php esc_html_e( 'My cart', 'kutetheme' ) ?>" href="<?php echo esc_url($cart_url);?>"><?php esc_html_e('Cart', 'kutetheme' );?></a>
                <span class="notify notify-right"><?php echo esc_attr( $cart_count ); ?></span>
                <?php do_action( 'kt_mini_cart_content', esc_url( $check_out_url ) ); ?>
            </div>
        </div>
    <?php elseif( $kt_used_header == 3 ) :?>
        <div class="col-sm-6 col-md-6 col-lg-3 group-button-header">
                <div class="btn-cart" id="cart-block">
                    <a title="<?php esc_html_e( 'My cart', 'kutetheme' ) ?>" href="<?php echo esc_url( $cart_url );?>"><?php _e( 'Cart', 'kutetheme');?></a>
                    <span class="notify notify-right"><?php echo esc_attr( $cart_count ); ?></span>
                    <?php do_action( 'kt_mini_cart_content', esc_url( $check_out_url ) ); ?>
                </div>
                <?php $url = get_permalink( get_option('woocommerce_myaccount_page_id') );?>
                <a title="<?php _e('My Account', 'kutetheme');?>" href="<?php echo esc_attr( $url );?>" class="btn-login">
                <?php
                if( is_user_logged_in() ) _e( 'Account', 'kutetheme' );
                else _e( 'Login', 'kutetheme' );
                ?>
                </a>
                <?php if( function_exists( 'YITH_WCWL' ) ):
                    $wishlist_url = YITH_WCWL()->get_wishlist_url(); ?>
                    <a title="<?php esc_html_e( "Wishlists", 'kutetheme') ?>" class="btn-heart" href="<?php echo esc_url( $wishlist_url ); ?>"><?php esc_html_e( 'Wishlists', 'kutetheme') ?></a>
                <?php endif; ?>
            </div>
    <?php elseif( $kt_used_header == 4 ) :?>
            <div class="col-sm-2 col-md-2 col-lg-1 group-button-header">
                <div class="btn-cart" id="cart-block">
                    <a title="<?php esc_html_e( 'My cart', 'kutetheme' ) ?>" href="<?php echo esc_url( $cart_url );?>"><?php esc_html_e( 'My cart', 'kutetheme' ) ?></a>
                    <span class="notify notify-right"><?php echo esc_attr( $cart_count ); ?></span>
                    <?php do_action( 'kt_mini_cart_content', esc_url( $check_out_url ) ); ?>
                </div>
            </div>
    <?php elseif( $kt_used_header == 5 ) :?>
        <?php
            if(defined( 'YITH_WOOCOMPARE' )): global $yith_woocompare; $count = count($yith_woocompare->obj->products_list); ?>
            <a title="<?php esc_html_e( "Compare", 'kutetheme') ?>" href="#" class="btn-compare yith-woocompare-open"><?php esc_html_e( "Compare", 'kutetheme') ?><span>(<?php echo intval( $count ) ?>)</span></a>
        <?php endif; ?>
        
        <?php if( function_exists( 'YITH_WCWL' ) ):
            $wishlist_url = YITH_WCWL()->get_wishlist_url(); ?>
            <a title="<?php esc_html_e( "Wishlists", 'kutetheme') ?>" class="btn-heart" href="<?php echo esc_url( $wishlist_url ); ?>"><?php esc_html_e( 'Wishlists', 'kutetheme') ?></a>
        <?php endif; ?>
        
        <div class="btn-cart" id="cart-block">
            <a class="cart-link" title="<?php esc_html_e( 'My cart', 'kutetheme' ) ?>" href="<?php echo esc_url( $cart_url );?>"><?php esc_html_e( 'Cart', 'kutetheme' );?></a>
            <span class="notify notify-right"><?php echo esc_attr( $cart_count ); ?></span>
            <?php do_action( 'kt_mini_cart_content', esc_url( $check_out_url ) ); ?>
        </div>
    <?php elseif( $kt_used_header == 6 ) :?>
        <div class="col-xs-5 col-sm-4 col-md-2 group-button-header">
            <?php
                if(defined( 'YITH_WOOCOMPARE' )): global $yith_woocompare; $count = count($yith_woocompare->obj->products_list); ?>
                <a title="<?php esc_html_e( "Compare", 'kutetheme') ?>" href="#" class="btn-compare yith-woocompare-open"><?php esc_html_e( "Compare", 'kutetheme') ?><span>(<?php echo intval( $count ) ?>)</span></a>
            <?php endif; ?>
            <?php if( function_exists( 'YITH_WCWL' ) ):
                $wishlist_url = YITH_WCWL()->get_wishlist_url(); ?>
                <a title="<?php esc_html_e( "Wishlists", 'kutetheme') ?>" class="btn-heart" href="<?php echo esc_url( $wishlist_url ); ?>"><?php esc_html_e( 'Wishlists', 'kutetheme') ?></a>
            <?php endif; ?>
            <div class="btn-cart" id="cart-block">
                <a class="cart-link" title="<?php esc_html_e( 'My cart', 'kutetheme' ) ?>" href="<?php echo esc_url( $cart_url );?>"><?php esc_html_e( 'Cart', 'kutetheme' );?></a>
                <span class="notify notify-right"><?php echo esc_attr( $cart_count ); ?></span>
                <?php do_action( 'kt_mini_cart_content', esc_url( $check_out_url ) ); ?>
            </div>
    
        </div>
    <?php elseif( $kt_used_header == 7 ) :?>
        <div class="bolock-cart-topbar" id="cart-block">
            <a title="<?php _e( 'My cart', 'kutetheme' ) ?>" href="<?php echo esc_url( $cart_url ); ?>"><?php _e( 'Cart', 'kutetheme' ) ?><span class="count"><?php echo esc_attr( $cart_count ); ?></span></a>
            <?php do_action( 'kt_mini_cart_content', esc_url( $check_out_url ) ); ?>
        </div>
    <?php elseif( $kt_used_header == 8 ): ?>
        <div class="btn-cart" id="cart-block">
            <a class="cart-link" title="<?php esc_html_e( 'My cart', 'kutetheme' ) ?>" href="<?php echo esc_url( $cart_url );?>"><?php esc_html_e( 'My cart', 'kutetheme' ) ?></a>
            <span class="notify notify-right"><?php echo esc_attr( $cart_count ); ?></span>
            <?php do_action( 'kt_mini_cart_content', esc_url( $check_out_url ) ); ?>
        </div>
    <?php elseif( $kt_used_header == 12): ?>
        <a class="cart-link" href="<?php echo esc_url( $cart_url ); ?>">
            <span class="icon">
                <span class="count"><?php echo esc_html( $cart_count );?></span>
            </span>
            <span class="total"><?php _e('Cart','kutetheme');?>: <?php echo kt_get_html( $cart_subtotal );?></span>
        </a>
        <?php do_action( 'kt_mini_cart_content', esc_url( $check_out_url ) ); ?>

    <?php elseif( $kt_used_header == 11): ?>
        <a class="cart-link" href="<?php echo esc_url( $cart_url ); ?>">
            <span class="icon">
                <span class="count"><?php echo esc_html( $cart_count );?></span>
            </span>
            <span class="total"><?php _e('Cart','kutetheme');?></span>
        </a>
        <?php do_action( 'kt_mini_cart_content', esc_url( $check_out_url ) ); ?>
    <?php elseif( $kt_used_header == 9): ?>
        <a class="cart-link" href="<?php echo esc_url( $cart_url ); ?>">
            <span class="count"><?php echo esc_html( $cart_count );?></span>
        </a>
        <?php do_action( 'kt_mini_cart_content', esc_url( $check_out_url ) ); ?>
    <?php elseif( $kt_used_header == 13): ?>
        <a class="cart-link" href="<?php echo esc_url( $cart_url ); ?>">
            <span class="icon">
                <span class="count"><?php echo esc_html( $cart_count );?></span>
            </span>
            <?php _e('Cart:','kutetheme');?>
            <?php echo kt_get_html( $cart_subtotal );?>
        </a>
        <?php do_action( 'kt_mini_cart_content', esc_url( $check_out_url ) ); ?>
    <?php elseif( $kt_used_header == 14): ?>
        <a class="cart-link" href="<?php echo esc_url( $cart_url ); ?>">
            <span class="icon">
                <span class="count"><?php echo esc_html( $cart_count );?></span>
            </span>
            <?php _e('Cart','kutetheme');?>
        </a>
        <?php do_action( 'kt_mini_cart_content', esc_url( $check_out_url ) ); ?>
    <?php endif;?>
    <?php do_action( 'woocommerce_after_mini_cart' ); ?>
</div>
