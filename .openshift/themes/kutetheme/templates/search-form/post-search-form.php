<?php
/**
 * The template search form
 *
 *
 * @author 		KuteTheme
 * @package 	THEME/WooCommerce
 * @version     KuteTheme 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>
<form class="form-inline <?php if( ! kt_is_wc() ) : ?> blog-search-form <?php endif; ?>"  method="get" action="<?php echo esc_url( home_url( '/' ) ) ?>">
      <div class="form-group input-serach">
        <?php if( kt_is_wc() ) : ?>
        <input type="hidden" name="post_type" value="product" />
        <?php else: ?>
        <input type="hidden" name="post_type" value="post" />
        <?php endif; ?>
        <input value="<?php echo esc_attr( get_search_query() );?>" type="text" name="s"  placeholder="<?php echo esc_attr( esc_attr__( 'Keyword here...', 'kutetheme') ) ?>" />
      </div>
      <button type="submit" class="pull-right btn-search"></button>
</form>