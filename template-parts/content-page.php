<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Cambodia_Portal
 */

?>

	<div class="head">
		<?php the_title( '<div class="title primary-color"><h4>', '</h4></div>' ); 

		if ( 'page' === get_post_type() ) :
				?>
				<div class="meta">
					<?php
					cam_portal_posted_on();
					cam_portal_posted_by();
					cam_portal_the_posted_view_count();
					?>
				</div><!-- .entry-meta -->
			<?php endif; ?>
	</div><!-- .entry-header -->

	<div class="detail-content">
		<?php
		the_content();

		wp_link_pages( array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'cam-portal' ),
			'after'  => '</div>',
		) );
		?>
	</div>

	<?php if ( get_edit_post_link() ) : ?>
		<footer class="entry-footer">
			<?php
			edit_post_link(
				sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers */
						__( 'Edit <span class="screen-reader-text">%s</span>', 'cam-portal' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				),
				'<span class="edit-link">',
				'</span>'
			);
			?>
		</footer><!-- .entry-footer -->
	<?php endif; ?>
