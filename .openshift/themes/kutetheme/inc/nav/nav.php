<?php
/**
 * Custom nav in wp-admin
 *
 * @author      KuteThemes
 * @package     Kite/Template
 * @since       1.0.0
 * @link        http://kutethemes.com
 */

// Exit if accessed directly
if ( !defined('ABSPATH')) exit;

if( ! class_exists( 'KT_MEGAMENU' ) ) {
    /**
     * Class KT_MEGAMENU
     * @since 1.0
     */
     
    class KT_MEGAMENU {
        
        public $custom_fields;
        
    	/*--------------------------------------------*
    	 * Constructor
    	 *--------------------------------------------*/
    
    	/**
    	 * Initializes the plugin by setting localization, filters, and administration functions.
    	 */
    	function __construct() {
    		
            $this->custom_fields = array('img_icon', 'menu_page', 'enable');
            
    		// add custom menu fields to menu
    		add_filter( 'wp_setup_nav_menu_item', array( $this, 'kt_add_custom_nav_fields' ) );
    
    		// save menu custom fields
    		add_action( 'wp_update_nav_menu_item', array( $this, 'kt_update_custom_nav_fields'), 10, 3 );
    		
    		// edit menu walker
    		add_filter( 'wp_edit_nav_menu_walker', array( $this, 'kt_edit_walker'), 10, 2 );
            
            // add enqueue scripts
            add_action( 'admin_enqueue_scripts', 	array( $this, 'register_scripts' ) );
    
    	} // end constructor
    	
    	/**
    	 * Add custom fields to $item nav object
    	 * in order to be used in custom Walker
    	 *
    	 * @access      public
    	 * @since       1.0 
    	 * @return      void
    	*/
    	function kt_add_custom_nav_fields( $menu_item ) {
            foreach ( $this->custom_fields as $key ) {
                $menu_item->$key = get_post_meta( $menu_item->ID, '_menu_item_megamenu_'.$key, true );
            }
    	    return $menu_item;
    	    
    	}
    	
    	/**
    	 * Save menu custom fields
    	 *
    	 * @access      public
    	 * @since       1.0 
    	 * @return      void
    	*/
    	function kt_update_custom_nav_fields( $menu_id, $menu_item_db_id, $args ) {
            
            foreach ( $this->custom_fields as $key ) {
    			if( !isset( $_REQUEST['menu-item-megamenu-'.$key][$menu_item_db_id] ) ) {
    				$_REQUEST['menu-item-megamenu-'.$key][$menu_item_db_id] = '';
    			}
    
    			$value = $_REQUEST['menu-item-megamenu-'.$key][$menu_item_db_id];
                
    			update_post_meta( $menu_item_db_id, '_menu_item_megamenu_'.$key, $value );
    		}
            
    	}
    	
    	/**
    	 * Define new Walker edit
    	 *
    	 * @access      public
    	 * @since       1.0 
    	 * @return      void
    	*/
    	function kt_edit_walker($walker,$menu_id) {
    	    return 'Walker_Nav_Menu_Edit_Custom';
    	}
        
        /**
		 * Register megamenu javascript assets
		 *
		 * @return void
		 *
		 * @since  1.0
		 */
		function register_scripts($hook) {
            if ( 'nav-menus.php' != $hook ) return;
            
            wp_enqueue_style( 'kt-style-mega-menu', THEME_URL . '/inc/nav/css/megamenu.css');
            wp_enqueue_media();
            wp_enqueue_script( 'kt-script-mega-menu', THEME_URL . '/inc/nav/js/megamenu.js', array( 'jquery' ), '1.0.0', true );
    
		}
    
    } // end kt_MegaMenu() class
    
    // instantiate plugin's class
    new KT_MEGAMENU();
    
}

require_once( THEME_DIR. 'inc/nav/nav_menu_custom_fields.php' );
require_once( THEME_DIR. 'inc/nav/nav_edit_custom_walker.php' );

