<?php
/**
 * Cambodia Portal Script Provider
 *
 * @package Cambodia_Portal
 */

function cam_portal_scripts() {
	// wp_register_style('cam-portal-style', false);
	wp_enqueue_style( 'cam-portal-style', get_stylesheet_uri() );
	wp_enqueue_style( 'cam-portal-bootstrap', get_template_directory_uri() . '/asset/bootstrap/css/bootstrap.min.css', array(), '4.3.1' );
	wp_enqueue_style( 'cam-portal-slick', get_template_directory_uri() . '/asset/slick/slick.css' );
	wp_enqueue_style( 'cam-portal-iconic', get_template_directory_uri() . '/asset/open-iconic/font/css/open-iconic-bootstrap.css' );
	wp_enqueue_style( 'cam-portal-custom', get_template_directory_uri() . '/asset/css/custom.css' );
	// include(get_template_directory() . '/inc/inline-css.php');
	// wp_add_inline_style('cam-portal-style', $cam_portal_inlinestyle );
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'cam-portal-navigation', get_template_directory_uri() . '/asset/js/navigation.js', array(), '20151215', true );
	wp_enqueue_script( 'cam-portal-poperjs', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js', array(), '20151215', true );
	wp_enqueue_script( 'cam-portal-bootstrap', get_template_directory_uri() . '/asset/bootstrap/js/bootstrap.min.js', array(), '20151215', true );
	wp_enqueue_script( 'cam-portal-slickjs', get_template_directory_uri() . '/asset/slick/slick.min.js', array(), '20151215', true );
	wp_enqueue_script( 'cam-portal-bootstrap3-typeahead.min', get_template_directory_uri() . '/asset/js/bootstrap3-typeahead.min.js', array(), '20151215', true );
	wp_enqueue_script( 'cam-portal-google-map-api', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyBbTDKtoivLuALOMTXcUViLnQZxNCuHdeA', array(), '20151215', true );
	wp_enqueue_script( 'cam-portal-main', get_template_directory_uri() . '/asset/js/main.js', array(), '20151215', true );
	

	wp_enqueue_script( 'cam-portal-skip-link-focus-fix', get_template_directory_uri() . '/asset/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'cam_portal_scripts' );


