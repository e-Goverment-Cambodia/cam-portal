<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Cambodia_Portal
 */

get_header();
the_cam_portal_breadcrumbs();

$queried_object = get_queried_object();
$display_blog = get_term_meta( $queried_object->term_id, 'cam_portal_category_blog', true );

?>
<div class="container">
	<div class="row">
		<div class="col-lg-8">
			<!-- if display blog is Document -->
			<?php if( $display_blog == 'document' ) : ?>

			<?php
			$term_id = $queried_object->term_id;
			$taxonomy_name = $queried_object->taxonomy;
			$term_children = get_term_children( $term_id, $taxonomy_name );
			?>

			<form class="service-filter" method="GET" action="<?php echo home_url('/'); ?>">
				<div class="form-group row mb-0">
				<?php if ( $term_children ) : ?>
					<div class="col-sm-3 pr-sm-0">
						
						<select class="custom-select option-typeahead" id="">
							<option value="<?php echo $term_id; ?>" selected><?php echo __( 'ទាំងអស់', 'camportal' ); ?></option>
							<?php 
							foreach ( $term_children as $child ) {
								$term = get_term_by( 'id', $child, $taxonomy_name );
								echo '<option value="' . $child . '">' . $term->name . '</option>';
							}
							?>
						</select>
					</div>
				
					<div class="col-sm-9 pl-sm-0">
				<?php else : ?>
					<div class="col-sm-12">
					<input type="hidden" class="option-typeahead" value="<?php echo $term_id; ?>" />
				<?php endif; ?>
						<div class="relative">
							<input type="hidden" name="cat" value="<?php echo $term_id; ?>" />
							<input type="hidden" name="type" value="<?php echo $taxonomy_name; ?>" />
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

			<?php else: ?>

			<!-- if display blog is Default -->
			<div class="b-2">

			<?php if ( have_posts() ) : ?>

				<?php
				/* Start the Loop */
				while ( have_posts() ) :
					the_post();
					get_template_part( 'template-parts/content', 'archive' );
				endwhile;
				cam_portal_paginations();
			else :
				get_template_part( 'template-parts/content', 'none' );
			endif;
			?>

			</div>
			<!--End b-2 -->

		<?php endif; ?>


		</div>
		<!--End col-lg-8 -->

		<?php get_sidebar(); ?>

	</div>
	<!-- End row -->
</div>
<!-- End container -->

<?php
get_footer();
