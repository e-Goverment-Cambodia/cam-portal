<?php
// Block-2 Shortcode Generator

function main_block_2_shortcode( $atts , $content = null ) {
	ob_start();
	// Attributes
	$atts = shortcode_atts(
		array(
			'cat_id' 		=> '', // category name ( multi category seperate by coma ',')
			'posts_per_page'=> '', // number of posts per page
			'offset'		=> 0, 
			'title'			=> '', // title of block title
			'link_cat_id'	=> '',  // the block title's link to a category list
			'char'			=> 75
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
	$block_2_query = new WP_Query( $args );
	// The Loop
	if ( $block_2_query->have_posts() ) { ?>
	<div class="container">
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
		<div class="b-1 row slick-slideshow-responsive">
	<?php
		while ( $block_2_query->have_posts() ) :
			$block_2_query->the_post(); ?>
			<div class="b-item-wrap col-lg-4">
				<div class="b-item">
					<div class="b-thumnail"><?php cam_portal_the_post_thumbnail(); ?></div>
					<div class="b-title"><a href="<?php the_permalink(); ?>"><?php echo mb_strimwidth( get_the_title(), 0, $atts['char'], '...' ); ?></a></div>
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