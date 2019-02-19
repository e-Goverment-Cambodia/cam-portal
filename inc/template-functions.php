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



// Add Shortcode
function sidebar_post_shortcode( $atts , $content = null ) {

	// Attributes
	$atts = shortcode_atts(
		array(
			'type_name' => 'Market Index',
		),
		$atts,
		'sidebar-post'
	);

	// WP_Query arguments
	$args = array(
		'post_type'              => array( 'section_data' ),
		'post_status'            => array( 'publish' ),
		'posts_per_page'         => '2',
		'tax_query'              => array(
			array(
				'taxonomy'         => 'types',
				'terms'            => $atts['type_name'],
				'field'            => 'name',
			),
		),
	);
	
	// The Query
	$section_query = new WP_Query( $args );
	
	// The Loop
	if ( $section_query->have_posts() ) {
		$output = '<table class="table table-bordered block-30">';
		while ( $section_query->have_posts() ) :
			$section_query->the_post();
			$items = get_post_meta( get_the_ID(), 'cam_group_items', true );
			// echo '<pre>';
				print_r($items);
			// echo '</pre>';
			foreach ( $items as $key => $item ) {
				$item_name = $item_val = '';
				if ( isset( $item['title']['value'] ) ) {
					$item_name = $item['title'];
					$item_val = $item['value'];
				}
			}
		endwhile;
		$output .= '</tabel>';
	} else {
		echo 'nothing found';
	}
	
	// Restore original Post Data
	wp_reset_postdata();
	
	// Return code
	return $output;

}
add_shortcode( 'sidebar-post', 'sidebar_post_shortcode' );