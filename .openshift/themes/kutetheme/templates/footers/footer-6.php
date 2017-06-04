<?php
    $address = kt_get_info_address();
    $hotline = kt_get_info_hotline();
    $email   = kt_get_info_email();
    $copyright = kt_get_info_copyrights();
    $kt_footer_payment_logos = kt_option('kt_footer_payment_logos',false);
?>
<footer class="footer5">
     <div class="container">
         <div class="footer-top">
            <div class="left">
                <div class="footer-logo"><?php kt_get_logo_footer(); ?></div>
                <ul class="address-list">
                    <li class="feature-icon first">
                        <p class="no-margin"><span class="tit-name">
                            <?php _e('Address','kutetheme');?>:</span>
                            <span class="tit-contain"><?php echo esc_html($address );?></span>
                        </p>
                    </li>
                    <li class="feature-icon">
                        <p class="no-margin"><span class="tit-name">
                            <?php _e('Phone','kutetheme');?>:</span>
                            <span class="tit-contain"><?php echo esc_html( $hotline );?></span>
                        </p>
                    </li>
                    <li class="feature-icon">
                        <p class="no-margin">
                            <span class="tit-name"><?php _e('Email','kutetheme');?>:</span>
                            <span class="tit-contain"><?php echo esc_html( $email );?></span>
                        </p>
                    </li>
                </ul>
                <?php
                    if(is_active_sidebar('footer-menu-1')){
                        dynamic_sidebar('footer-menu-1');
                    }
                 ?>
            </div>
            <div class="right">
                <div class="row">
                     <div class="col-sm-4">
                        <?php
                            if(is_active_sidebar('footer-menu-2')){
                                dynamic_sidebar('footer-menu-2');
                            }
                         ?>
                     </div>
                     <div class="col-sm-4">
                        <?php
                            if(is_active_sidebar('footer-menu-3')){
                                dynamic_sidebar('footer-menu-3');
                            }
                         ?>
                     </div>
                     <div class="col-sm-4">
                        <?php
                            if(is_active_sidebar('footer-menu-4')){
                                dynamic_sidebar('footer-menu-4');
                            }
                         ?>
                     </div>
                </div>
             </div>
         </div>
         <div class="footer-bottom">
             <?php
                  if(is_active_sidebar('footer-menu-bottom')){
                      dynamic_sidebar('footer-menu-bottom');
                  }
             ?>
             <div class="footer-coppyright"><?php echo kt_get_html($copyright);?></div>
             <?php if($kt_footer_payment_logos):?>
                <div class="payment-logos">
                    <?php
                    foreach( $kt_footer_payment_logos as $logo){
                        ?>
                        <img src="<?php echo esc_url( $logo );?>" alt="<?php _e( 'payment logo', 'kutetheme' ) ?>" height="auto" width="auto" />
                        <?php
                    }
                    ?>
                </div>
              <?php endif;?>
         </div>
     </div>
</footer>