<?php
// Block-2 Shortcode Generator

function main_block_4_shortcode( $atts , $content = null ) {
	ob_start();
	// Attributes
	$atts = shortcode_atts(
		array(
			'cat_id' 		=> '', // category name ( multi category seperate by coma ',')
			'posts_per_page'=> '', // number of posts per page
			'offset'		=> 0, 
			'title'			=> '', // title of block title
			'link_cat_id'	=> ''  // the block title's link to a category list
		),
		$atts,
		'block-2'
	);
	// WP_Query arguments
	$args = array(
		'post_type'             => array( 'post' ),
		'post_status'           => array( 'publish' ),
		'posts_per_page'        => $atts['posts_per_page'],
		'offset'        		=> $atts['offset'],
		'cat'					=> $atts['cat_id']
	);
	
	// The Query
	$block_5_query = new WP_Query( $args );
	// The Loop
	if ( $block_5_query->have_posts() ) { ?>
		<?php 
		// To display the block title use the_block_title() function in 'inc\template-functions.php'
		if( $atts['title'] != '' ){
			$arr = [
				'cat_id'	=> $atts['link_cat_id'], 
				'title'	=> $atts['title'],
			];
			the_block_title( $arr );
		}		
	?>
	<div class="b-3">
	<?php
		while ( $block_5_query->have_posts() ) :
			$block_5_query->the_post(); 
			$html = 	'<div class="b-item-wrap">
							<div class="b-item">
								<div class="b-date-wrap">
									<div class="b-date primary-background-color">
										<div class="day">%s</div>
										<div class="month">%s</div>
										<div class="year">%s</div>
									</div>
								</div>
								<div class="b-title-wrap">
									<div class="b-title"><a href="%s">%s</a></div>
								</div>
							</div>
						</div>';
			printf( $html, '24', 'មករា', '2019', get_the_permalink(), mb_strimwidth( get_the_title(), 0, 80, '...' ) );

		endwhile;
		?>
	</div>
	<?php
	}
	// Restore original Post Data
	wp_reset_postdata();
	// Return code
	return ob_get_clean();
}
add_shortcode( 'block-5', 'main_block_4_shortcode' );