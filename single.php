<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Cambodia_Portal
 */

get_header();
?>
	<!-- breadcrum -->
	<div class="container">
		<div class="breadcrum">
			<ul>
				<li><a href="#">ទំព័រដើម</a></li>
				<li><a href="#">ព័ត៌មានថ្មីៗ</a></li>
			</ul>
		</div>
	</div>
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-lg-8">
		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', get_post_type() );

			the_post_navigation( array(
				'prev_text'                  => __( 'prev chapter: %title' ),
				'next_text'                  => __( 'next chapter: %title' ),
				'in_same_term'               => true,
				'taxonomy'                   => __( 'category' ),
				'screen_reader_text' => __( 'Continue Reading' ),
			) );

			// If comments are open or we have at least one comment, load up the comment template.
			// if ( comments_open() || get_comments_number() ) :
			// 	comments_template();
			// endif;

		endwhile; // End of the loop.
		?>
			</div>
			<?php
				get_sidebar();
			?>
		</div>
	</div><!-- #primary -->

<?php
get_footer();
