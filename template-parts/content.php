<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Cambodia_Portal
 */

?>
<div class="detail-wrap" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="head">
		<?php
		if ( is_singular() ) :
			the_title( '<div class="title primary-color"><h4>', '</h4></div>' );
		else :
			the_title( '<div class="title primary-color"><h4><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h4></div>' );
		endif;

		if ( 'post' === get_post_type() ) :
			?>
			<div class="meta">
				<?php
				cam_portal_the_facebook_share();
				cam_portal_posted_on();
				cam_portal_posted_by();
				cam_portal_the_posted_view_count();
				?>
			</div><!-- .entry-meta -->
		<?php endif; ?>
		</div><!-- .entry-header -->

	
	<div class="detail-content">
		<?php
		
		cam_portal_the_pdf_items();
		the_content();

		
		?>
	</div><!-- .entry-content -->
</div>


