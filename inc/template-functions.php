<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Cambodia_Portal
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function cam_portal_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'cam_portal_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function cam_portal_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'cam_portal_pingback_header' );

add_filter( 'dynamic_sidebar_params', 'b3m_wrap_widget_titles', 20 );
function b3m_wrap_widget_titles( array $params ) {
        
        // $params will ordinarily be an array of 2 elements, we're only interested in the first element
        $widget =& $params[0];
        $widget['before_title'] = '<div class="widget-title"><div class="block-title primary-color"><span class="primary-color font-moul">';
        $widget['after_title'] = '</span></div></div>';
        
        return $params;
        
}

// if ( function_exists( 'add_theme_support' ) ) { 
//     add_theme_support( 'post-thumbnails' );
//     set_post_thumbnail_size( 300, 200, true ); // default Post Thumbnail dimensions (cropped)

//     // additional image sizes
//     // delete the next line if you do not need additional image sizes
//     // add_image_size( 'category-thumb', 300, 9999 ); //300 pixels wide (and unlimited height)
// }

function block_title( $arr ){

    $link = $arr['link'] ? '<a class="primary-color font-moul" href="'.$arr['link'].'">'.$arr['title'].'</a>' : '<span class="primary-color font-moul" >'.$arr['title'].'</span>';
   

    $html =     '<div class="block-title primary-color">';
    $html .=    $link;
    $html .=    '</div>';

    return $html;
}