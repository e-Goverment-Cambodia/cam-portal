<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Cambodia_Portal
 */

get_header();
?>
	<div class="mb-15 mb-xs-15 mb-sm-15"></div>
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-lg-8">
		<?php
		while ( have_posts() ) :
			the_post();

			echo "Heloo";

		endwhile; // End of the loop.
		?>
			</div>
			<?php
				get_sidebar();
			?>
			
		</div><!-- end row-->
		<?php if( 'section_data' != get_post_type() ) cam_portal_the_related_post(); ?>
	</div><!-- #primary -->

<?php
get_footer();
