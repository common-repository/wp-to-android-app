<?php 

add_action( 'rest_api_init', function () {
  register_rest_route( 'wptonativeandroidsettings/v1', '/settings', array(
    'methods' => 'GET',
    'callback' => 'wptonativeandroidsettings_app_setting_api',
    'permission_callback' => '__return_true'
  ) );
} );

function wptonativeandroidsettings_app_setting_api( $data ) {
  	$wptonativeandroidsettings_options = get_option( 'wptonativeandroidsettings_option_name' );
 
  return $wptonativeandroidsettings_options;
}




