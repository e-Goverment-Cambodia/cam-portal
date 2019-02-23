<?php
function block_title_shortcode( $atts , $content = null ) {
	
	ob_start();
	
	// Attributes
	$atts = shortcode_atts(
		array(
			'link_cat_id' => '',
			'title' => ''
		),
		$atts
	);
	
	// To display the block title use the_block_title() function in 'inc\template-functions.php'
	if( $atts['title'] != '' ){
		$arr = [
			'cat_id'	=> $atts['link_cat_id'], 
			'title'	=> $atts['title'],
		];
		the_block_title( $arr );
	}
	
	return ob_get_clean();
}
add_shortcode( 'block-title', 'block_title_shortcode' );

