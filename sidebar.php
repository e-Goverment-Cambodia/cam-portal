<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Cambodia_Portal
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

<div class="col-lg-4 widget-area">
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
	<?php
// // WP_Query arguments
// $args = array(
// 	'post_type'              => array( 'section_data' ),
// 	'post_status'            => array( 'publish' ),
// 	'posts_per_page'         => '1',
// 	'tax_query'              => array(
// 		array(
// 			'taxonomy'         => 'types',
// 			'terms'            => 'Market Index',
// 			'field'            => 'name',
// 		),
// 	),
// );

// // The Query
// $section_query = new WP_Query( $args );

// // The Loop
// if ( $section_query->have_posts() ) {
// 	while ( $section_query->have_posts() ) {
// 		$section_query->the_post();
// 		// do something
// 	}
// } else {
// 	// no posts found
// }

// // Restore original Post Data
// wp_reset_postdata();
	?>
</div><!-- #secondary -->
