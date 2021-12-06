<?php 
/*
Plugin Name: ACF Option Page
Version: 1.0.0
Description: Add custom option pages to the WordPRess admin with Acf
Author: Sandip Mistry
Author URI: https://sandipmistry.cm
*/

/**
 * @see  https://since1979.dev/snippet-002-adding-option-pages-with-acf/
 * @uses acf https://www.advancedcustomfields.com/
 * @uses acf_add_options_page https://www.advancedcustomfields.com/resources/acf_add_options_page/
 * @uses acf_add_options_sub_page https://www.advancedcustomfields.com/resources/acf_add_options_sub_page/
 */

function add_acf_menu_pages()
{
    acf_add_options_page(array(
        'page_title' => 'App Options',
        'menu_title' => 'App Options',
        'menu_slug' => 'app-options',
        'capability' => 'manage_options',
        'position' => 61.1,
        'redirect' => true,
        'icon_url' => 'dashicons-admin-customizer',
        'update_button' => 'Save options',
        'updated_message' => 'Options saved',
    ));

    // acf_add_options_sub_page(array(
    //     'page_title' => 'Theme logos',
    //     'menu_title' => 'Theme logos',
    //     'parent_slug' => 'theme-options',
    // ));

}


/**
 * Hook: acf/init.
 *
 * @uses add_action() https://developer.wordpress.org/reference/functions/add_action/
 * @uses acf/init https://www.advancedcustomfields.com/resources/acf-init/
 */
add_action('acf/init', 'add_acf_menu_pages');


// ACF Option page REST API

@header( 'Access-Control-Allow-Origin: *' );

function wp_api_v2_mobile_app_settings ($data) {
    
     global $wpdb;
     $arr = array();
     $options = array('title','description','application_message','contact_no','whatsapp_no','contact_email','website','address');

     foreach ($options as $option) {
        $arr[$option] = get_field($option, 'option');
     }

     wp_send_json_success($arr);

}


add_action( 'rest_api_init', function () {

register_rest_route( 'wp/v2', '/mobile_app_settings', array(
        'methods' => 'GET',
        'callback' => 'wp_api_v2_mobile_app_settings',
    ) );

});

?>
