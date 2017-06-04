<!-- Footer -->
<?php
    $address = kt_get_info_address();
    $hotline = kt_get_info_hotline();
    $email   = kt_get_info_email();
    $copyright = kt_get_info_copyrights();
    $kt_footer_payment_logo = kt_option('kt_footer_payment_logo','');
    $kt_footer_background = kt_option('kt_footer_background','');
    $kt_footer_subscribe_newsletter_list_id = kt_option('kt_footer_subscribe_newsletter_list_id','');
?>
<footer id="footer2">
     <div class="footer-top">
         <div class="container">
             <div class="row">
                 <div class="col-sm-3">
                     <div class="footer-logo">
                         <?php kt_get_logo_footer(); ?>
                     </div>
                 </div>
                 <div class="col-sm-6">
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
                 <div class="col-sm-3">
                    <div class="social-link">
                     <?php kt_get_social_footer(); ?>
                     </div>
                 </div>
             </div>
         </div>
     </div>

     <!-- footer paralax-->
     <div class="footer-paralax"<?php if($kt_footer_background):?> style="background: url('<?php echo esc_url( $kt_footer_background );?>') 50% 0 no-repeat fixed;"<?php endif;?>>
         <div class="footer-row footer-center">
             <div class="container">
                <?php
                $kt_footer_subscribe_newsletter_title = kt_option('kt_footer_subscribe_newsletter_title','');
                $kt_footer_subscribe_newsletter_description = kt_option('kt_footer_subscribe_newsletter_description','');
                ?>
                <?php echo  do_shortcode( '[mailchimp title="'.$kt_footer_subscribe_newsletter_title.'" list="'.$kt_footer_subscribe_newsletter_list_id.'" text_before="'.$kt_footer_subscribe_newsletter_description.'" text_after="" height_option=""]'.__( 'Success! Check your inbox or spam folder for a message containing a confirmation link.', 'kutetheme' ).'[/mailchimp]' ); ?>
             </div>
         </div>
         <div class="footer-row">
             <div class="container">
                 <div class="row">
                     <div class="col-sm-3">
                         <div class="widget-container">
                             <h3 class="widget-title"><?php _e( 'Infomation', 'kutetheme' ) ?></h3>
                             <div class="widget-body">
                                 <ul>
                                     <li><a class="location" href="#"><?php echo kt_get_html($address);?></a></li>
                                     <li><a class="phone" href="#"><?php echo kt_get_html($hotline);?></a></li>
                                     <li><a class="email" href="#"><?php echo kt_get_html($email);?></a></li>
                                 </ul>
                             </div>
                         </div>
                     </div>
                     <div class="col-sm-3">
                        <?php
                            if(is_active_sidebar('footer-menu-1')){
                                dynamic_sidebar('footer-menu-1');
                            }
                        ?>
                     </div>
                     <div class="col-sm-3">
                         <?php
                            if(is_active_sidebar('footer-menu-2')){
                                dynamic_sidebar('footer-menu-2');
                            }
                        ?>
                     </div>
                     <div class="col-sm-3">
                         <?php
                            if(is_active_sidebar('footer-menu-3')){
                                dynamic_sidebar('footer-menu-3');
                            }
                        ?>
                     </div>
                 </div>
             </div>
         </div>
         <div class="footer-bottom">
             <div class="container">
                 <div class="footer-bottom-wapper">
                     <div class="row">
                         <div class="col-sm-8">
                             <div class="footer-coppyright">
                                 <?php echo kt_get_html( $copyright );?>
                             </div>

                         </div>
                        <?php if( $kt_footer_payment_logo ): ?>
                         <div class="col-sm-4">
                             <div class="footer-payment-logo">
                                 <img height="auto" width="auto" src="<?php echo esc_url( $kt_footer_payment_logo ); ?>" alt="<?php _e( 'payment logo', 'kutetheme' ) ?>" />
                             </div>
                         </div>
                        <?php endif;?>
                     </div>
                 </div>
             </div>
         </div>
     </div>
     <!-- ./footer paralax-->
</footer>