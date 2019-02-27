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
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-lg-8">
		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', get_post_type() );

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
