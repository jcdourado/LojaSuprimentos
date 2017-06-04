<?php

require THEME_DIR . '/inc/widgets/trademark-payment.php';
require THEME_DIR . '/inc/widgets/seo-keyword.php';
require THEME_DIR . '/inc/widgets/slider.php';
require THEME_DIR . '/inc/widgets/testimonial.php';
require THEME_DIR . '/inc/widgets/kt_image.php';
require THEME_DIR . '/inc/widgets/social.php';
if(kt_is_wc()){
	require THEME_DIR . '/inc/widgets/best-seller.php';
	require THEME_DIR . '/inc/widgets/on-sale.php';
	require THEME_DIR . '/inc/widgets/product-special-sidebar.php';
}
