<?php
/**
 * Fuctions for register Post Type Brand
 *
 * @link http://codex.wordpress.org/Function_Reference/register_post_type
 *
 * @package Cambodia_Portal
 */

function cam_portal_setup_brand_post(){
    $labels = array(
        'name'               => _x( 'Dept Brands', 'post type general name', 'cam-portal' ),
		'singular_name'      => _x( 'Brand', 'post type singular name', 'cam-portal' ),
		'menu_name'          => _x( 'Dept Brands', 'admin menu', 'cam-portal' ),
		'name_admin_bar'     => _x( 'Brand', 'add new on admin bar', 'cam-portal' ),
		'add_new'            => _x( 'Add New', 'Brand', 'cam-portal' ),
		'add_new_item'       => __( 'Add New Brand', 'cam-portal' ),
		'new_item'           => __( 'New Brand', 'cam-portal' ),
		'edit_item'          => __( 'Edit Brand', 'cam-portal' ),
		'view_item'          => __( 'View Brand', 'cam-portal' ),
		'all_items'          => __( 'All Dept Brands', 'cam-portal' ),
		'search_items'       => __( 'Search Dept Brands', 'cam-portal' ),
		'parent_item_colon'  => __( 'Parent Dept Brands:', 'cam-portal' ),
		'not_found'          => __( 'No Dept Brands found.', 'cam-portal' ),
		'not_found_in_trash' => __( 'No Dept Brands found in Trash.', 'cam-portal' )
    );
    $args = array(
        'labels'        => $labels,
        'public'        => true,
        'has_archive'   => true,
        'rewrite'       => array('slug' => 'dept-brand', 'with_front' => false),
        'menu_position' => 12,
        'menu_icon'     => 'dashicons-store',
        'supports'      => array('title')
    );
    register_post_type('cam_portal_brand', $args);
}
add_action ('init', 'cam_portal_setup_brand_post');