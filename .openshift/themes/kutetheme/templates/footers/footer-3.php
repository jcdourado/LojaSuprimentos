<?php
    $address = kt_get_info_address();
    $hotline = kt_get_info_hotline();
    $email   = kt_get_info_email();
    $copyright = kt_get_info_copyrights();
    $kt_footer_payment_logo = kt_option( 'kt_footer_payment_logo', '' );
?>
<!-- Footer -->
<footer id="footer2" class="footer3">
     <div class="footer-top">
         <div class="container">
             <div class="row">
                 <div class="col-sm-3">
                     <div class="footer-logo">
                         <?php kt_get_logo_footer(); ?>
                     </div>
                 </div>
                 <div class="col-sm-12 col-md-6">
                     <div class="footer-menu">       
                         <?php
		                    wp_nav_menu( array(
		                        'menu'              => 'custom_footer_menu',
		                        'theme_location'    => 'custom_footer_menu',
		                        'depth'             => 1,
		                        'container'         => '',
		                        'container_class'   => '',
		                        'container_id'      => '',
		                        'menu_class'        => 'custom_footer_menu',
		                        'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
		                        'walker'            => new wp_bootstrap_navwalker())
		                    );
		                ?>
                     </div>
                 </div>
                 <div class="col-sm-12 col-md-3">
                    <div class="footer-sidebar4">
                        <?php
                            if(is_active_sidebar('footer-menu-4')){
                                dynamic_sidebar('footer-menu-4');
                            }
                        ?>
                    </div>         
                     
                 </div>
             </div>
         </div>
     </div>

     <!-- footer paralax-->
     <div class="footer-row">
         <div class="container">
             <div class="row">
                 <div class="col-sm-6 col-md-3">
                     <div class="widget-container widget-contact-info">
                         <h3 class="widget-title"><?php _e( 'Information', 'kutetheme' ) ?></h3>
                         <div class="widget-body">
                             <ul>
                                 <li><a class="location" href="#"><span class="address"><?php _e( 'Address:', 'kutetheme' ) ?></span><?php echo kt_get_html($address);?></a></li>
                                 <li><a class="phone" href="#"><span><?php _e( 'Hotline:', 'kutetheme' ) ?></span><?php echo kt_get_html($hotline);?></a></li>
                                 <li><a class="email" href="#"><span><?php _e( 'Email:', 'kutetheme' ) ?></span><?php echo kt_get_html($email);?></a></li>
                             </ul>
                         </div>
                     </div>
                 </div>
                 <div class="col-sm-3 col-md-2">
                     <div class="widget-container">
                         <?php
                            if(is_active_sidebar('footer-menu-1')){
                                dynamic_sidebar('footer-menu-1');
                            }
                         ?>
                     </div>
                 </div>
                 <div class="col-sm-3 col-md-2">
                     <div class="widget-container">
                         <?php
                            if(is_active_sidebar('footer-menu-2')){
                                dynamic_sidebar('footer-menu-2');
                            }
                        ?>
                     </div>
                 </div>
                 <div class="col-sm-6 col-md-2">
                     <div class="widget-container">
                         <?php
                            if(is_active_sidebar('footer-menu-3')){
                                dynamic_sidebar('footer-menu-3');
                            }
                        ?>
                     </div>
                 </div>
                 <div class="col-sm-6 col-md-3">
                     <div class="widget-container">
                         <?php
                            if(is_active_sidebar('footer-social')){
                                dynamic_sidebar('footer-social');
                            }
                        ?>
                     </div>
                     
                     <?php if( $kt_footer_payment_logo ): ?>
                         <div class="widget-container">
                            <h3 class="widget-title"><?php _e( 'payment', 'kutetheme' ) ?></h3>
                            <div class="widget-body">
                                <img src="<?php echo esc_url( $kt_footer_payment_logo ); ?>" alt="<?php _e( 'payment logo', 'kutetheme' ) ?>" width="auto" height="auto" />
                            </div>
                         </div>
                     <?php endif;?>
                 </div>
             </div>
         </div>
     </div>
     <div class="footer-bottom">
         <div class="container">
             <div class="footer-bottom-wapper">
                 <div class="row">
                     <div class="col-sm-12">
                         <div class="footer-coppyright">
                             <?php if( $copyright ): ?>
                                <p class="text-center"><?php echo kt_get_html( $copyright ) ; ?></p>
                             <?php endif; ?>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
     <!-- ./footer paralax-->
</footer>