<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the "site-content" div and all content after.
 *
 * @package WordPress
 * @subpackage KuteTheme
 * @since KuteTheme 1.0
 */
?>

</div><!-- .site-content -->

<?php kt_get_footer();?>
    </div><!--.content-->
</div><!-- .site -->
<a href="#" class="scroll_top" title="<?php esc_html_e( 'Scroll to Top', 'kutetheme' ) ?>"><?php esc_html_e( 'Scroll', 'kutetheme' ) ?></a>
<?php wp_footer(); ?>
</body>
</html>
