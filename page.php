<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Cambodia_Portal
 */

get_header();
the_cam_portal_breadcrumbs();
?>

	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-lg-8">
				<div class="detail-wrap">
		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', 'page' );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>	
			</div><!-- #detail-wrap-->
			</div><!-- #col-sm-12 col-lg-8-->
			<?php get_sidebar(); ?>
		</div><!-- #row -->
	</div><!-- #Container -->

<?php
get_footer();
