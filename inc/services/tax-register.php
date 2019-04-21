<?php
/**
 * Fuctions for register Custom Taxonomy for service and brand
 *
 * @link https://codex.wordpress.org/Function_Reference/register_taxonomy
 *
 * @package Cambodia_Portal
 */

// hook into the init action and call sector when it fires
add_action( 'init', 'setup_cam_portal_sectors_tax', 0 );
function setup_cam_portal_sectors_tax() {
	// Add new taxonomy, make it hierarchical (like categories)
	$labels = array(
		'name'              => _x( 'Sectors', 'taxonomy general name', 'cam-portal' ),
		'singular_name'     => _x( 'Sector', 'taxonomy singular name', 'cam-portal' ),
		'search_items'      => __( 'Search Sectors', 'cam-portal' ),
		'all_items'         => __( 'All Sectors', 'cam-portal' ),
		'parent_item'       => __( 'Parent Sector', 'cam-portal' ),
		'parent_item_colon' => __( 'Parent Sector:', 'cam-portal' ),
		'edit_item'         => __( 'Edit Sector', 'cam-portal' ),
		'update_item'       => __( 'Update Sector', 'cam-portal' ),
		'add_new_item'      => __( 'Add New Sector', 'cam-portal' ),
		'new_item_name'     => __( 'New Sector Name', 'cam-portal' ),
		'menu_name'         => __( 'Sector', 'cam-portal' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'sector', 'with_front' => false ),
	);

    register_taxonomy( 'sector', array( 'organization', 'service' ), $args );
    
    $labels = array(
		'name'                       => _x( 'Groups', 'taxonomy general name', 'cam-portal' ),
		'singular_name'              => _x( 'Group', 'taxonomy singular name', 'cam-portal' ),
		'search_items'               => __( 'Search Groups', 'cam-portal' ),
		'popular_items'              => __( 'Popular Groups', 'cam-portal' ),
		'all_items'                  => __( 'All Groups', 'cam-portal' ),
		'parent_item'                => __( 'Parent Group', 'cam-portal' ),
		'parent_item_colon'          => __( 'Parent Group:', 'cam-portal' ),
		'edit_item'                  => __( 'Edit Group', 'cam-portal' ),
		'update_item'                => __( 'Update Group', 'cam-portal' ),
		'add_new_item'               => __( 'Add New Group', 'cam-portal' ),
		'new_item_name'              => __( 'New Group Name', 'cam-portal' ),
		'separate_items_with_commas' => __( 'Separate Groups with commas', 'cam-portal' ),
		'add_or_remove_items'        => __( 'Add or remove Groups', 'cam-portal' ),
		'choose_from_most_used'      => __( 'Choose from the most used Groups', 'cam-portal' ),
		'not_found'                  => __( 'No Groups found.', 'cam-portal' ),
		'menu_name'                  => __( 'Groups', 'cam-portal' ),
	);

	$args = array(
		'hierarchical'          => true,
		'labels'                => $labels,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'show_admin_column'     => true,
		'update_count_callback' => '_update_post_term_count',
		'query_var'             => true,
		'rewrite'               => array( 'slug' => 'sev_group', 'with_front' => false ),
	);

	register_taxonomy( 'service_group', 'service', $args );
}