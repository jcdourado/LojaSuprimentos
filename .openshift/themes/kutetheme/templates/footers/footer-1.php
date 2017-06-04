<!-- Footer -->
<footer id="footer">
     <div class="container">
            <!-- introduce-box -->
            <div id="introduce-box" class="row">
                <div class="col-md-3">
                    <div id="address-box">
                        <?php 
                            $logo      = kt_get_logo_footer();  
                            $address   = kt_get_info_address();
                            $hotline   = kt_get_info_hotline();
                            $email     = kt_get_info_email();
                            $copyright = kt_get_info_copyrights();
                            $allowed_html = array(
                                'a' => array(
                                    'href' => array (),
                                    'title' => array ()
                                ),
                                'img' => array(
                                    'alt' => array (),
                                    'src' => array()
                                ),
                            );
                            echo wp_kses( $logo, $allowed_html );
                        ?>
                        <div id="address-list">
                            <?php if( $address ): ?>
                                <div class="tit-name"><?php esc_html_e( 'Address:', 'kutetheme' ) ?></div>
                                <div class="tit-contain"><?php echo kt_get_html( $address );  ?></div>
                            <?php endif; ?>
                            
                            <?php if( $hotline ): ?>
                                <div class="tit-name"><?php esc_html_e( 'Phone:', 'kutetheme' ) ?></div>
                                <div class="tit-contain"><?php echo kt_get_html( $hotline ); ?></div>
                            <?php endif; ?>
                            
                            <?php if( $email && is_email( $email ) ): ?>
                                <div class="tit-name"><?php esc_html_e( 'Email:', 'kutetheme' ) ?></div>
                                <div class="tit-contain"><?php echo kt_get_html( $email ); ?></div>
                            <?php endif; ?>
                        </div>
                    </div> 
                </div>
                <div class="col-md-6">
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
                <div class="col-md-3">
                    <div id="contact-box">
                        <?php
                            if(is_active_sidebar('footer-social')){
                                dynamic_sidebar('footer-social');
                            }
                        ?>
                    </div>
                    
                </div>
            </div><!-- /#introduce-box -->
        
            <!-- #trademark-box -->
            <div id="trademark-box">
                <?php
                    if(is_active_sidebar('footer-payment')){
                        dynamic_sidebar('footer-payment');
                    }
                ?>
            </div> <!-- /#trademark-box -->
            
            <!-- #trademark-text-box -->
            <div id="trademark-text-box">
                <?php
                    if(is_active_sidebar('footer-bottom')){
                        dynamic_sidebar('footer-bottom');
                    }
                ?>
            </div><!-- /#trademark-text-box -->
            <div id="footer-menu-box">
                <?php
                    if(is_active_sidebar('footer-menu-bottom')){
                        dynamic_sidebar('footer-menu-bottom');
                    }
                ?>
                <?php if( $copyright ): ?>
                    <p class="text-center"><?php echo kt_get_html( $copyright ) ; ?></p>
                <?php endif; ?>
            </div><!-- /#footer-menu-box -->
        </div> 
</footer>
<!--end footer-->