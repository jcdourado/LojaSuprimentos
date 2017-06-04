<?php
/**
 * Product quantity inputs
 *
 * @author      WooThemes
 * @package     WooCommerce/Templates
 * @version     2.6.2
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

?>
<div class="quantity">
    <table>
        <tr>
            <td class="quantity-label">
                <?php esc_html_e('Qty', 'kutetheme') ?>
            </td>
            <td>
                <span class="quantity-minus"><?php esc_html_e( '-', 'kutetheme' ) ?></span>
                <input type="text" step="<?php echo esc_attr( $step ); ?>" <?php if ( is_numeric( $min_value ) ) : ?>min="<?php echo esc_attr( $min_value ); ?>"<?php endif; ?> <?php if ( is_numeric( $max_value ) ) : ?>max="<?php echo esc_attr( $max_value ); ?>"<?php endif; ?> name="<?php echo esc_attr( $input_name ); ?>" value="<?php echo esc_attr( $input_value ); ?>" title="<?php echo esc_attr_x( 'Qty', 'Product quantity input tooltip', 'kutetheme' ) ?>" class="input-text qty text" size="4" />
                <span class="quantity-plus"><?php esc_html_e( '+', 'kutetheme' ) ?></span>
            </td>
        </tr>
    </table>
</div>
