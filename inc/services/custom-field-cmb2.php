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
	 * Add Field for Contact Brand Post Type
	 */
    $cmb_brand = new_cmb2_box( array(
		'id'            => $prefix . 'brand_item',
		'title'         => 'Ogranization Detail',
		'object_types'  => array( 'organization', ), // Post type
	) );
    $cmb_brand->add_field( array(
		'name'      => 'Ogranization Address',
		'id'        => $prefix . 'dept_address',
		'type'      => 'wysiwyg',
		'options' => array(
			'media_buttons' => false,
			'textarea_rows' => get_option('default_post_edit_rows', 3),
			'teeny' => true,
		),
	) );
	$cmb_brand->add_field( array(
		'name' 		=> 'Ogranization Address Maps',
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
	/**
	 * End Dept Post Type
	 */

	/**
	 * Start Add Field for Sevice Post Type
	 */
	$cmb_service = new_cmb2_box( array(
		'id'            => $prefix . 'service_item',
		'title'         => 'Service Detail',
		'object_types'  => array( 'service', )
	) );
	$cmb_service->add_field( array(
		'name'      => 'Service Purpose',
		'id'        => $prefix . 'service_purpose',
		'type'      => 'textarea_small',
	) );
	$cmb_service->add_field( array(
		'name'      => 'Service Regulation',
		'id'        => $prefix . 'service_regulation',
		'type'      => 'textarea_small'
	) );
	$cmb_service->add_field( array(
		'name'      => 'Service Customer',
		'id'        => $prefix . 'service_customer',
		'type'      => 'text',
	) );
	$cmb_service->add_field( array(
		'name'      => 'Service Standart',
		'id'        => $prefix . 'service_standart',
		'type'      => 'wysiwyg',
		'options' => array(
			'media_buttons' => false,
			'textarea_rows' => get_option('default_post_edit_rows', 3),
			'teeny' => true,
		),
	) );
	$cmb_service->add_field( array(
		'name'      => 'Service Document Needed',
		'id'        => $prefix . 'service_doc',
		'type'      => 'wysiwyg',
		'options' => array(
			'media_buttons' => false,
			'textarea_rows' => get_option('default_post_edit_rows', 3),
			'teeny' => true,
		),
	) );
	$cmb_service->add_field( array(
		'name'      => 'Service Document form',
		'id'        => $prefix . 'service_form',
		'type'    => 'file',
		'options' => array(
			'url' => false,
		),
		'text'    => array(
			'add_upload_file_text' => 'Add or Upload File'
		),
		'query_args' => array(
			'type' => 'application/pdf'
		),
	) );
	$cmb_service->add_field( array(
		'name'      => 'Service Process',
		'id'        => $prefix . 'service_process',
		'type'      => 'wysiwyg',
		'options' => array(
			'media_buttons' => false,
			'textarea_rows' => get_option('default_post_edit_rows', 5),
			'teeny' => true,
		),
	) );
	$cmb_service->add_field( array(
		'name'      => 'Service Process Form',
		'id'        => $prefix . 'service_pro_form',
		'type'    => 'file',
		'options' => array(
			'url' => false,
		),
		'text'    => array(
			'add_upload_file_text' => 'Add or Upload File'
		),
		'query_args' => array(
			'type' => array(
			'image/gif',
			'image/jpeg',
			'image/png',
			),
		),
		'preview_size' => 'small',
	) );
}