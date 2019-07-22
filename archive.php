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
$display_blog = '';
$display_blog = get_term_meta( $queried_object->term_id, 'cam_portal_category_blog', true );
?>
<div class="container">
	<div class="row">
		<div class="col-lg-8">
			<?php 
			switch ( $display_blog ) {
				case 'document' :
					get_template_part( 'template-parts/content', 'archive-doc-filter' );
					break;
				default:
			}
			?>
			<div class="b-2">

				<?php 
				
				if ( have_posts() ) :
					while ( have_posts() ) :
						the_post();
						switch ( $display_blog ) {
							case 'document' :
								get_template_part( 'template-parts/content', 'document' );
								break;
							default:
								get_template_part( 'template-parts/content', 'archive' );
						}
					endwhile;
					cam_portal_paginations();
				else :
					get_template_part( 'template-parts/content', 'none' );
				endif;
				
				?>

			</div>
			<!--End b-2 -->
		</div>
		<!--End col-lg-8 -->

		<?php get_sidebar(); ?>

	</div>
	<!-- End row -->
</div>
<!-- End container -->

<?php
get_footer();
