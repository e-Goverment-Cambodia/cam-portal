<?php
function block_title_shortcode( $atts , $content = null ) {

	// Attributes
	extract (shortcode_atts(
		array(
			'link' => '',
		),
		$atts
	) );
    $output = '<div class="block-title primary-color">';
    if ($link != ''){
        $output .= '<a class="primary-color font-moul" href="' .$link. '">' . $content .'</a></div>';
    }else{
        $output .= '<span class="primary-color font-moul" >' . $content .'</span></div>';
    }
    // Return image HTML code
    return $output;

}
add_shortcode( 'block_title', 'block_title_shortcode' );

