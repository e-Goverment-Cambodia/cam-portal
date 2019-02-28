<?php
/**
 * Include and setup custom metaboxes and fields. (make sure you copy this file to outside the CMB2 directory)
 *
 * Be sure to replace all instances of 'cam_' with your project's prefix.
 * http://nacin.com/2010/05/11/in-wordpress-prefix-everything/
 *
 * @category Cambodia Portal
 * @package  Cambodia_Portal
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/CMB2/CMB2
 */

add_action( 'cmb2_admin_init', 'cam_portal_post_type_metaboxes' );
/**
 * Define the metabox and field configurations.
 */
function cam_portal_post_type_metaboxes() {

	// Start with an underscore to hide fields from custom fields list
    $prefix = 'cam_portal_';
    /**
	 * Initiate the metabox
	 */
    $cmb_term = new_cmb2_box( array(
		'id'            => $prefix . 'organization_tax',
		'title'         => __( 'Customize Term', 'cmb2' ),
		'object_types'  => array( 'term', ), // Post type
        'taxonomies'    => array( 'organization' ), 
	) );
    $cmb_term->add_field( array(
		'name'      => esc_html__( 'Logo', 'cmb2' ),
		'desc'      => esc_html__( 'Add Custom Logo Image for Organization taxonomies', 'cmb2' ),
		'id'        => $prefix . 'organization_logo',
        'type'      => 'file',
        'preview_size' => 'thumbnail',
        'text'      => array(
            'add_upload_file_text' => 'Add Logo'
        ),
        'options'   => array(
            'url'   => false
		),
		'query_args' => array(
			'type' => array(
				'image/jpeg',
				'image/png',
			),
		),
	) );



	/**
	 * Add Field for Dept Brand Post Type
	 */
    $cmb_brand = new_cmb2_box( array(
		'id'            => $prefix . 'brand_item',
		'title'         => 'Dept Brand Detail',
		'object_types'  => array( 'cam_portal_brand', ), // Post type
	) );
    $cmb_brand->add_field( array(
		'name'      => 'Dept Address',
		'id'        => $prefix . 'dept_address',
        'type'      => 'textarea_small',
	) );
	$cmb_brand->add_field( array(
		'name'      => 'Dept Address Maps',
		'id'        => $prefix . 'dept_address_maps',
        'type'      => 'oembed',
	) );	


}