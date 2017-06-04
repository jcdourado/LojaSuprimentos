<?php
    $copyright = kt_get_info_copyrights();
    $kt_footer_payment_logos = kt_option('kt_footer_payment_logos',false);
?>
<footer class="footer4 style2">
     <div class="container">
         <div class="footer-top">
            <div class="left">
                <div class="row">
                     <div class="col-sm-4">
                        <?php
                            if(is_active_sidebar('footer-menu-1')){
                                dynamic_sidebar('footer-menu-1');
                            }
                         ?>
                     </div>
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
                 </div>
            </div>
            <div class="right">
                <?php
                    if(is_active_sidebar('footer-menu-4')){
                        dynamic_sidebar('footer-menu-4');
                    }
                 ?>
             </div>
         </div>
         <div class="footer-bottom">
             <div class="footer-coppyright"><?php echo kt_get_html($copyright);?></div>
             <?php if($kt_footer_payment_logos):?>
                <div class="payment-logos">
                    <?php foreach( $kt_footer_payment_logos as $logo){ ?>
                        <img src="<?php echo esc_url( $logo );?>" alt="<?php _e( 'payment logo', 'kutetheme' ) ?>" height="auto" width="auto" />
                    <?php } ?>
                </div>
              <?php endif;?>
         </div>
     </div>
</footer>