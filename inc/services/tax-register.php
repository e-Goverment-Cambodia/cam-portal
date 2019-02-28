<?php
/**
 * Fuctions for register Custom Taxonomy for service and brand
 *
 * @link https://codex.wordpress.org/Function_Reference/register_taxonomy
 *
 * @package Cambodia_Portal
 */

// hook into the init action and call Organization when it fires
add_action( 'init', 'setup_cam_portal_organizations_tax', 0 );
function setup_cam_portal_organizations_tax() {
	// Add new taxonomy, make it hierarchical (like categories)
	$labels = array(
		'name'              => _x( 'Organizations', 'taxonomy general name', 'cam-portal' ),
		'singular_name'     => _x( 'Organization', 'taxonomy singular name', 'cam-portal' ),
		'search_items'      => __( 'Search Organizations', 'cam-portal' ),
		'all_items'         => __( 'All Organizations', 'cam-portal' ),
		'parent_item'       => __( 'Parent Organization', 'cam-portal' ),
		'parent_item_colon' => __( 'Parent Organization:', 'cam-portal' ),
		'edit_item'         => __( 'Edit Organization', 'cam-portal' ),
		'update_item'       => __( 'Update Organization', 'cam-portal' ),
		'add_new_item'      => __( 'Add New Organization', 'cam-portal' ),
		'new_item_name'     => __( 'New Organization Name', 'cam-portal' ),
		'menu_name'         => __( 'Organization', 'cam-portal' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'organization', 'with_front' => false ),
	);

    register_taxonomy( 'organization', array( 'cam_portal_brand', 'cam_portal_service' ), $args );
    
    $labels = array(
		'name'                       => _x( 'Service Groups', 'taxonomy general name', 'cam-portal' ),
		'singular_name'              => _x( 'Service Group', 'taxonomy singular name', 'cam-portal' ),
		'search_items'               => __( 'Search Service Groups', 'cam-portal' ),
		'popular_items'              => __( 'Popular Service Groups', 'cam-portal' ),
		'all_items'                  => __( 'All Service Groups', 'cam-portal' ),
		'parent_item'                => __( 'Parent Service Group', 'cam-portal' ),
		'parent_item_colon'          => __( 'Parent Service Group:', 'cam-portal' ),
		'edit_item'                  => __( 'Edit Service Group', 'cam-portal' ),
		'update_item'                => __( 'Update Service Group', 'cam-portal' ),
		'add_new_item'               => __( 'Add New Service Group', 'cam-portal' ),
		'new_item_name'              => __( 'New Service Group Name', 'cam-portal' ),
		'separate_items_with_commas' => __( 'Separate Service Groups with commas', 'cam-portal' ),
		'add_or_remove_items'        => __( 'Add or remove Service Groups', 'cam-portal' ),
		'choose_from_most_used'      => __( 'Choose from the most used Service Groups', 'cam-portal' ),
		'not_found'                  => __( 'No Service Groups found.', 'cam-portal' ),
		'menu_name'                  => __( 'Service Groups', 'cam-portal' ),
	);

	$args = array(
		'hierarchical'          => true,
		'labels'                => $labels,
        'show_ui'               => true,
        // 'show_in_menu'          => false,
		'show_admin_column'     => true,
		'update_count_callback' => '_update_post_term_count',
		'query_var'             => true,
		'rewrite'               => array( 'slug' => 'sev_group', 'with_front' => false ),
	);

	register_taxonomy( 'service_group', 'cam_portal_service', $args );
}