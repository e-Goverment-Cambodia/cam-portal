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
				if ( have_posts() ) : 
					/* Start the Loop */
					while ( have_posts() ) :
						the_post();
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
