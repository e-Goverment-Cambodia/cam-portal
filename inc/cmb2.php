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

/**
 * Get the bootstrap! If using the plugin from wordpress.org, REMOVE THIS!
 */

if ( file_exists( dirname( __FILE__ ) . '/cmb2/init.php' ) ) {
	require_once dirname( __FILE__ ) . '/cmb2/init.php';
} elseif ( file_exists( dirname( __FILE__ ) . '/CMB2/init.php' ) ) {
	require_once dirname( __FILE__ ) . '/CMB2/init.php';
}

add_action( 'cmb2_admin_init', 'cam_register_repeatable_group_field_metabox' );
/**
 * Hook in and add a metabox to demonstrate repeatable grouped fields
 */
function cam_register_repeatable_group_field_metabox() {
	$prefix = 'cam_group_';

	/**
	 * Repeatable Field Groups
	 */
	$cmb_group = new_cmb2_box( array(
		'id'           => $prefix . 'metabox',
		'title'        => esc_html__( 'Data Field Group', 'cam-portal' ),
		'object_types' => array( 'section_data' ),
	) );

	// $group_field_id is the field id string, so in this case: $prefix . 'demo'
	$group_field_id = $cmb_group->add_field( array(
		'id'          => $prefix . 'items',
		'type'        => 'group',
		// 'description' => esc_html__( 'Generates reusable form entries', 'cam-portal' ),
		'options'     => array(
			'group_title'    => esc_html__( 'Item {#}', 'cam-portal' ), // {#} gets replaced by row number
			'add_button'     => esc_html__( 'Add Another Item', 'cam-portal' ),
			'remove_button'  => esc_html__( 'Remove Item', 'cam-portal' ),
			'sortable'       => true,
			'closed'      => true, // true to have the groups closed by default
			// 'remove_confirm' => esc_html__( 'Are you sure you want to remove?', 'cam-portal' ), // Performs confirmation before removing group.
		),
	) );


	/**
	 * Group fields works the same, except ids only need
	 * to be unique to the group. Prefix is not needed.
	 *
	 * The parent field's id needs to be passed as the first argument.
	 */
	$cmb_group->add_group_field( $group_field_id, array(
		'name'       => esc_html__( 'Title', 'cam-portal' ),
		'id'         => 'title',
		'type'       => 'text',
		// 'repeatable' => true, // Repeatable fields are supported w/in repeatable groups (for most types)
	) );
	$cmb_group->add_group_field( $group_field_id, array(
		'name'       => esc_html__( 'Value', 'cam-portal' ),
		'id'         => 'value',
		'type'       => 'textarea_small',
		// 'repeatable' => true, // Repeatable fields are supported w/in repeatable groups (for most types)
	) );



	/**
	 * Custom PDF field meta box
	 * Repeatable Field Groups
	 */
	$cmb_pdf_field_grp = new_cmb2_box( array(
		'id'           => $prefix . 'pdf_metabox',
		'title'        => esc_html__( 'Select FDF file below :', 'cam-portal' ),
		'object_types' => array( 'post' ),
	) );

	$group_pdf_field_id = $cmb_pdf_field_grp->add_field( array(
		'id'          => $prefix . 'pdf_items',
		'type'        => 'group',
		'options'     => array(
			'group_title'    => esc_html__( 'PDF File {#}', 'cam-portal' ), // {#} gets replaced by row number
			'add_button'     => esc_html__( 'Add More PDF', 'cam-portal' ),
			'remove_button'  => esc_html__( 'Remove This PDF', 'cam-portal' ),
			'sortable'       => true,
			'closed'      => false, // true to have the groups closed by default
		),
	) );

	$cmb_pdf_field_grp->add_group_field( $group_pdf_field_id, array(
		'name'       => esc_html__( 'Choose PDF File :', 'cam-portal' ),
		'id'         => 'pdf_url',
		'type'       => 'file',
		'query_args' => array( 'type' => 'application/pdf'),
		'options' => array(
			'url' => false, // Hide the text input for the url
		),
		'repeatable' => true, // Repeatable fields are supported w/in repeatable groups (for most types)
	) );


	/**
	 * Custom Facebook Video field meta box
	 * Repeatable Field Groups
	 */
	$cmb_facebook_video_field_grp = new_cmb2_box( array(
		'id'           => $prefix . 'facebook_video_metabox',
		'title'        => 'Facebook Video URL Below :',
		'object_types' => array( 'post' ),
	) );

	$cmb_facebook_video_field_grp->add_field( array(
		'id'         => 'facebook_video_url',
		'type'       => 'text_url',
		'repeatable' => true,
	) );

}
/**
 * Callback to define the optionss-saved message.
 *
 * @param CMB2  $cmb The CMB2 object.
 * @param array $args {
 *     An array of message arguments
 *
 *     @type bool   $is_options_page Whether current page is this options page.
 *     @type bool   $should_notify   Whether options were saved and we should be notified.
 *     @type bool   $is_updated      Whether options were updated with save (or stayed the same).
 *     @type string $setting         For add_settings_error(), Slug title of the setting to which
 *                                   this error applies.
 *     @type string $code            For add_settings_error(), Slug-name to identify the error.
 *                                   Used as part of 'id' attribute in HTML output.
 *     @type string $message         For add_settings_error(), The formatted message text to display
 *                                   to the user (will be shown inside styled `<div>` and `<p>` tags).
 *                                   Will be 'Settings updated.' if $is_updated is true, else 'Nothing to update.'
 *     @type string $type            For add_settings_error(), Message type, controls HTML class.
 *                                   Accepts 'error', 'updated', '', 'notice-warning', etc.
 *                                   Will be 'updated' if $is_updated is true, else 'notice-warning'.
 * }
 */
function cam_options_page_message_callback( $cmb, $args ) {
	if ( ! empty( $args['should_notify'] ) ) {

		if ( $args['is_updated'] ) {

			// Modify the updated message.
			$args['message'] = sprintf( esc_html__( '%s &mdash; Updated!', 'cam-portal' ), $cmb->prop( 'title' ) );
		}

		add_settings_error( $args['setting'], $args['code'], $args['message'], $args['type'] );
	}
}

