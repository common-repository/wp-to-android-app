<?php 

/**
 * Plugin Name:       WP to Android App
 * Plugin URI:        http://kites.dev/
 * Description:       Simply Convert your WordPress site to a native android app for free
 * Version:           1.9.3
 * Author:            Kites.Dev
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       wptonativeandroid
 * Domain Path:       /languages
 * Tested up to: 6.0
 */
 
/* Backend Script and Css */



function wptonativeandroid_admin_script() {
	wp_enqueue_media();
    wp_enqueue_script( 'wptonativeandroid-admin-script', plugin_dir_url( __FILE__ ) . '/js/wptonativeandroid-admin.js',array( 'jquery' ), '', true );
   
}
 add_action('admin_enqueue_scripts', 'wptonativeandroid_admin_script');
 

/* Includes Required Files */
 
 include( plugin_dir_path( __FILE__ ) . 'includes/settings.php');
 include( plugin_dir_path( __FILE__ ) . 'includes/init.php');
 
