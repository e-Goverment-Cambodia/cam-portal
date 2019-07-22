<?php 
get_header();
the_cam_portal_breadcrumbs();
?>
<div class="container">
	<div class="row">
		<div class="col-lg-8">
			
			<?php	get_template_part( 'template-parts/content', 'none' ); ?>
				
		</div>
		<!--End col-lg-8 -->

		<?php get_sidebar(); ?>

	</div>
	<!-- End row -->
</div>
<!-- End container -->

<?php
get_footer();
