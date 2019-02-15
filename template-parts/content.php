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
				cam_portal_posted_on();
				cam_portal_posted_by();
				?>
			</div><!-- .entry-meta -->
		<?php endif; ?>
		</div><!-- .entry-header -->

	<?php cam_portal_post_thumbnail(); ?>

	<div class="content">
		<?php
		the_content( sprintf(
			wp_kses(
				/* translators: %s: Name of current post. Only visible to screen readers */
				__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'cam-portal' ),
				array(
					'span' => array(
						'class' => array(),
					),
				)
			),
			get_the_title()
		) );

		wp_link_pages( array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'cam-portal' ),
			'after'  => '</div>',
		) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php cam_portal_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</div>
