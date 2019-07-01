<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Cambodia_Portal
 */

get_header();
the_cam_portal_breadcrumbs();

?>
<div class="container">
	<div class="row">
		<div class="col-lg-8">

			<form class="service-filter" method="GET" action="<?php echo home_url('/'); ?>">
				<div class="form-group row mb-0">
					<div class="col-sm-12">
						<div class="relative">
							<input name="s" placeholder="<?php echo __( 'ស្វែងរកតាមពាក្យ', 'cam-portal' ); ?>" type="text" id="inputTypehead" class="typeahead form-control" data-provide="typeahead" autocomplete="off" />
							<button class="btn btn-secondary" type="submit"><?php echo __( 'ស្វែងរក', 'cam-portal' ); ?></button>
						</div>
					</div>
				</div>
			</form>

			<div class="b-2">

			<?php if ( have_posts() ) : ?>

				<?php
				/* Start the Loop */
				while ( have_posts() ) :
					the_post();

					get_template_part( 'template-parts/content', 'document' );

				endwhile;
				cam_portal_paginations();
			else :
				get_template_part( 'template-parts/content', 'none' );
			endif;
			?>

			</div>
			<!-- End b-2-->
		</div>
		<!--End col-lg-8 -->

		<?php get_sidebar(); ?>

	</div>
	<!-- End row -->
</div>
<!-- End container -->

<?php
get_footer();
