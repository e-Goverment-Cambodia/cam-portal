<?php
// Block-2 Shortcode Generator

function main_block_2_shortcode( $atts , $content = null ) {
	ob_start();
	// Attributes
	$atts = shortcode_atts(
		array(
			'cat' => '',
			'number'		=> '',
		),
		$atts,
		'block-2'
	);

	// WP_Query arguments
	$args = array(
		'post_type'              => array( 'post' ),
		'post_status'            => array( 'publish' ),
		'posts_per_page'         => $atts['number'],
		'tax_query'              => array(
			array(
				'taxonomy'         => 'category',
				'terms'            => $atts['cat'],
				'field'            => 'name',
			),
		),
	);
	
	// The Query
	$block_2_query = new WP_Query( $args );
	// The Loop
	if ( $block_2_query->have_posts() ) { ?>
	<div class="container">
		<?php 
		$arr = [
			'link'=>'google.com', 
			'title'=> 'Hello',
		];
		echo block_title($arr); 
		
		?>
		<div class="b-1 row slick-slideshow-responsive">
	<?php
		while ( $block_2_query->have_posts() ) :
			$block_2_query->the_post(); ?>
			<div class="b-item-wrap col-lg-4">
				<div class="b-item">
					<div class="b-thumnail"><?php the_post_thumbnail( 'post-thumbnail' ); ?></div>
					<div class="b-title"><a href="<?php the_permalink(); ?>"><?php echo mb_strimwidth( get_the_title(), 0, 75, '...' ); ?></a></div>
					<div class="b-date"><?php cam_portal_posted_on(); ?></div>
				</div>
			</div>
		<?php
		endwhile; ?>
		</div>
	</div>
	<?php
	}
	// Restore original Post Data
	wp_reset_postdata();
	// Return code
	return ob_get_clean();
}
add_shortcode( 'block-2', 'main_block_2_shortcode' );