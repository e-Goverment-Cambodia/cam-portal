<?php
/**
 * Template tag for Registering Custom Post type
 * Market Index etc,
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Cambodia_Portal
 */
function cam_portal_create_post_type() {
    register_post_type( 'section_data',
        array(
            'labels' => array(
                'name'          => __( 'Sections', 'cam-portal' ),
                'singular_name' => __( 'Section', 'cam-portal' )
            ),
            
            'menu_position'     => 9,
            'public'      => true,
            'publicly_queryable' => true,
            'rewrite' => array( 'slug' => 'sections' , 'with_front' => false ),
            'has_archive' => true,
            'menu_icon'   => 'dashicons-welcome-write-blog',
            'supports'    => array('title', 'thumbnail')
        )
    );
}
add_action( 'init', 'cam_portal_create_post_type' );

function cam_portal_create_post_tax(){
    $labels = array(
		'name'              => _x( 'Types', 'taxonomy general name' ),
		'singular_name'     => _x( 'Type', 'taxonomy singular name', 'cam-portal' ),
		'search_items'      => __( 'Search Types', 'cam-portal' ),
		'all_items'         => __( 'All Types', 'cam-portal' ),
		'parent_item'       => __( 'Parent Type', 'cam-portal' ),
		'parent_item_colon' => __( 'Parent Type:', 'cam-portal' ),
		'edit_item'         => __( 'Edit Type', 'cam-portal' ),
		'update_item'       => __( 'Update Type', 'cam-portal' ),
		'add_new_item'      => __( 'Add New Type', 'cam-portal' ),
		'new_item_name'     => __( 'New Type Name', 'cam-portal' ),
		'menu_name'         => __( 'Type', 'cam-portal' ),
	);

	$args = array(
		'hierarchical'      => true,
        'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
        'rewrite'           => array( 'slug' => 'types' , 'with_front' => false )
	);
    register_taxonomy( 'types', array( 'section_data' ), $args );
}
// hook into the init action and call cam_portal_create_post_tax when it fires
add_action( 'init', 'cam_portal_create_post_tax', 0 );

/**
 * Use radio inputs instead of checkboxes for term checklists in specified taxonomies.
 *
 * @param   array   $args
 * @return  array
 */
add_filter( 'wp_terms_checklist_args', 'term_radio_checklist' );
function term_radio_checklist( $args ) {
    if ( ! empty( $args['taxonomy'] ) && $args['taxonomy'] === 'types' /* <== Change to your required taxonomy */ ) {
        if ( empty( $args['walker'] ) || is_a( $args['walker'], 'Walker' ) ) { // Don't override 3rd party walkers.
            if ( ! class_exists( 'Walker_Category_Radio_Checklist' ) ) {
                /**
                 * Custom walker for switching checkbox inputs to radio.
                 *
                 * @see Walker_Category_Checklist
                 */
                class Walker_Category_Radio_Checklist extends Walker_Category_Checklist {
                    function walk( $elements, $max_depth, $args = array() ) {
                        $output = parent::walk( $elements, $max_depth, $args );
                        $output = str_replace(
                            array( 'type="checkbox"', "type='checkbox'" ),
                            array( 'type="radio"', "type='radio'" ),
                            $output
                        );

                        return $output;
                    }
                }
            }

            $args['walker'] = new Walker_Category_Radio_Checklist;
        }
    }

    return $args;
}

