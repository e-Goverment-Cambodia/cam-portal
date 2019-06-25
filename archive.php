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

			<div class="service-filter">
				<div class="form-group row mb-0">
					<label class="col-sm-3 col-form-label" for="inputTypehead"><?php echo __( 'ស្វែងរកតាមពាក្យ', 'cam-portal' ); ?> :</label>
					<div class="col-sm-9">
						<div style="position:relative;">
							<input type="text" id="inputTypehead" class="form-control typeahead" data-provide="typeahead" autocomplete="off" />
						</div>
					</div>
				</div>
			</div>

			<div class="b-2">

			<?php if ( have_posts() ) : ?>

				<?php
				/* Start the Loop */
				while ( have_posts() ) :
					the_post();
				?>
				<div class="b-item-wrap">
					<div class="b-item">
						<div class="b-title-wrap">
							<div class="b-title margin-bottom-15"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
							<div class="b-cat">
								<span class="oi oi-calendar"></span>
								<?php  cam_portal_posted_on(); ?>

								<?php 
								$pdf_arr = get_post_meta( get_the_ID(), 'cam_group_pdf_items', true ); 
								if ( is_array( $pdf_arr ) && count( $pdf_arr ) ) {
								?>
								<a href="<?php echo $pdf_arr[0]['pdf_url'];?>"><span class="oi oi-cloud-download"></span><?php echo __( 'ទាញយកឯកសារ', 'cam-portal' ); ?></a>
								<?php }?>

								<a href="<?php the_permalink(); ?>"><span class="oi oi-eye"></span><?php echo __( 'ចូលមើល', 'cam-portal' ); ?></a>
							</div>
						</div>
					</div>
				</div>

				<?php
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
				?>

				<div class="b-item-wrap">
					<div class="b-item row">
						<div class="b-thumnail-wrap col-5">
							<div class="b-thumnail"><?php cam_portal_the_post_thumbnail(); ?></div>
						</div>
						<div class="b-title-wrap col-7">
							<div class="b-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
							<div class="b-date"><?php  cam_portal_posted_on(); ?></div>
						</div>
					</div>
				</div>
				<!-- End b-item-wrap -->

			<?php
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
