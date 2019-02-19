<?php
// For those who are object orientated. Add a class 
// function as the menu callback and setup the 
// menus automatically. 

// Exit if accessed directly
/**
 * Register a custom menu page.
 */
function cam_register_my_custom_menu_page(){
    add_menu_page( 
        __( 'Market Index', 'cam-portal' ),
        'Market Index',
        'public_post',
        'cam_mi',
        'cam_add_market',
        'dashicons-chart-pie',
        6
    );
}
add_action( 'admin_menu', 'cam_register_my_custom_menu_page' );
add_action( 'admin_init', 'cam_market_index' );
function cam_market_index(){
    register_setting ('cam-market-price', 'pro_name');
    add_settings_section( 'cam-market-price-section', 'Product Price', 'cam_portal_market_section', 'cam_add_market');
	add_settings_field( 'pro-name', 'Product Name', 'cam_product_name', 'cam_add_market', 'cam-market-price-section');
}
function cam_portal_market_section(){
    // echo 'Product Price';
}
function cam_product_name() {
	$firstName = esc_attr( get_option( 'pro_name' ) );
	echo '<input type="text" name="pro_name" value="'.$firstName.'" placeholder="Name" />';
}
function cam_add_market(){
    require_once (get_template_directory() . '/inc/customize-field/cam-market-index.php');
}
