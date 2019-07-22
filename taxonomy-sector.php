<?php
get_header();
the_cam_portal_breadcrumbs();
?>

<div class="container">
	<div class="row">
		<div class="col-lg-12">
		
			<?php get_template_part( 'template-parts/content', 'service-filter' ); ?>
				
			<div class="b-2">

				<?php
				$args = array(
					'post_type'	=> 'service',
					'tax_query' => array(
						array(
							'taxonomy' => get_query_var('taxonomy'),
							'field' => 'slug',
							'terms' => get_query_var('term')
						)
					),
					'paged'		=> get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1
				);
				$query = new WP_Query( $args );
				if ( $query -> have_posts() ) : 
					/* Start the Loop */
					while ( $query -> have_posts() ) :
						$query -> the_post();
						//if ( get_post_type () == 'service' )
						get_template_part( 'template-parts/content', 'service' );
					endwhile;
					cam_portal_paginations();
					else :
						get_template_part( 'template-parts/content', 'none' );
				endif;
				?>

			</div>
		</div>
	</div>
</div>

<?php
get_footer();
