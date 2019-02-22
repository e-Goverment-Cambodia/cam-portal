<?php
function grid_shortcode( $atts , $content = null ) {

	// Attributes
	extract (shortcode_atts(
		array(
			'class' => '',
		),
		$atts
	) );

	// Return image HTML code
	return '<div class="'. $class .'">'. do_shortcode($content) .'</div>';

}
add_shortcode( 'grid', 'grid_shortcode' );