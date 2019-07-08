<?php

function shortcut_function_shortcode( $atts , $content = null ) {
	ob_start();
	// The default attributes
	$a = shortcode_atts(
		array(
            'title'          	=> '', 
			'title_length'      => 20,
			'description'		=> '',
			'description_length'=> 40,
			'button'			=> 'Learn More',
			'uri'				=> '#',    
		),
		$atts
	);
?>
<div class="shortcut">
	<div class="title primary-color"><?php echo mb_strimwidth( $a['title'], 0, $a['title_length'], '...' ); ?></div>
	<div class="dropdown-divider w-25"></div>
	<div class="description"><?php echo mb_strimwidth( $a['description'], 0, $a['description_length'], '...' ); ?></div>
	<a href="<?php echo esc_url( home_url( '/'.$a['uri'] ) ); ?>" class="btn btn-outline-secondary"><?php echo $a['button']; ?></a>
</div>

<?php

	// Return code
	return ob_get_clean();
}
add_shortcode( 'shortcut', 'shortcut_function_shortcode' );

// [shortcut title="" title_length=10 description="" description_length=20 button="Learn More" uri="#"]