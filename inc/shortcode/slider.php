<?php
// Slider Shortcode Generator

function main_slider_shortcode( $atts , $content = null ) {
	ob_start();
	// Attributes
	$atts = shortcode_atts(
		array(
			'cat_id'			=> '',
			'posts_per_page'	=> 4
		),
		$atts,
		'slider'
	);

	// WP_Query arguments
	$args = array(
		'post_type'			=> array( 'post' ),
		'post_status'		=> array( 'publish' ),
		'posts_per_page'	=> $atts['posts_per_page'],
		'cat'				=> $atts['cat_id']
	);
	
	// The Query
	$slider_query = new WP_Query( $args );
	// The Loop
	if ( $slider_query->have_posts() ) { ?>
	<!-- </div> -->
	<div class="container plr-rs-0 plr-xs-rs-0 plr-sm-rs-0">
		<div class="slick-slideshow">
	<?php
		while ( $slider_query->have_posts() ) :
			$slider_query->the_post(); ?>
			<div class="slick-item">
				<div class="slick-photo">
					<div class="aspect-ratio">
						<div class="img" style="background-image: url(<?php echo cam_portal_get_the_post_thumbnail('large'); ?>);" ></div>
					</div>
				</div>
				<div class="primary-background-color">
					<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				</div>
			</div>
		<?php
		endwhile; ?>
		</div>
	</div>
	<!-- <div> -->
	<?php
	}
	// Restore original Post Data
	wp_reset_postdata();
	// Return code
	return ob_get_clean();
}
add_shortcode( 'slider', 'main_slider_shortcode' );