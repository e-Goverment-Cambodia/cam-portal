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
		'id'            => $prefix . 'sector_tax',
		'title'         => 'Customize Term',
		'object_types'  => array( 'term', ),
        'taxonomies'    => array( 'sector' ), 
	) );
    $cmb_term->add_field( array(
		'name'      => 'Logo',
		'desc'      => 'Add Custom Logo Image for sector taxonomies',
		'id'        => $prefix . 'sector_logo',
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
		'object_types'  => array( 'organization', ), // Post type
	) );
    $cmb_brand->add_field( array(
		'name'      => 'Dept Address',
		'id'        => $prefix . 'dept_address',
		'type'      => 'wysiwyg',
		'options' => array(
			'media_buttons' => false,
			'textarea_rows' => get_option('default_post_edit_rows', 3),
			'teeny' => true,
		),
	) );
	$cmb_brand->add_field( array(
		'name' 		=> 'Dept Address Maps',
		'desc' 		=> 'Input maps address iframe',
		'id' 		=> $prefix . 'dept_address_maps',
		'type' 		=> 'textarea_code'
	) );
	$group_field_id = $cmb_brand->add_field( array(
		'description' => 'You can add or remove mutiple contact in below field',
		'id' 		=> $prefix . 'dept_contact_group',
		'type'        => 'group',
		'options'     => array(
			'group_title'       => 'Contact {#}',
			'add_button'        => 'Add Another Contact',
			'remove_button'     => 'Remove Contact',
			'sortable'          => true,
		),
	) );
	$cmb_brand->add_group_field( $group_field_id, array(
		'name' => 'Position',
		'id'   => 'contact_position',
		'type' => 'text',
		// 'repeatable' => true,
	) );
	
	$cmb_brand->add_group_field( $group_field_id, array(
		'name' => 'Full name',
		'id'   => 'contact_name',
		'type' => 'text',
	) );
	$cmb_brand->add_group_field( $group_field_id, array(
		'name' => 'Contact Number',
		'id'   => 'contact_number',
		'type' => 'text',
		// 'repeatable' => true,
	) );
	$cmb_brand->add_group_field( $group_field_id, array(
		'name' => 'Email',
		'id'   => 'contact_email',
		'type' => 'text_email',
	) );
	
}