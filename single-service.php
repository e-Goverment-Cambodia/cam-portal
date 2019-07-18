<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Cambodia_Portal
 */

get_header();
// the_cam_portal_breadcrumbs();
?>
<div class="mb-15 mb-xs-15 mb-sm-15"></div>
<div class="container">
	<div class="row">
		<div class="col-lg-12">
			<?php get_template_part( 'template-parts/content', 'service-filter' ); ?>
			<div class="detail-wrap">
			<?php
			while ( have_posts() ) :
				the_post();
			?>
				<div class="head">
					<div class="title primary-color"><h4><?php the_title(); ?></h4></div>
					<div class="meta">
					<?php
					cam_portal_posted_on();
					cam_portal_posted_by();
					cam_portal_the_posted_view_count();
					?>
					</div>
				</div>

				

				<section class="section">
					<div class="block-title-2 primary-color">
						<span class="oi oi-star"></span><span><?php echo __( 'គោលបំណង៖' ); ?></span>
					</div>
					<div>
						<?php echo get_post_meta( $post->ID, 'cam_portal_service_purpose', true ); ?>
					</div>
				</section>
				<section class="section">
					<div class="block-title-2 primary-color">
						<span class="oi oi-book"></span><span><?php echo __( 'មូលដ្ឋានគតិយុត្ត៖' ); ?></span>
					</div>
					<div>
						<?php echo get_post_meta( $post->ID, 'cam_portal_service_regulation', true ); ?>
					</div>
				</section>
				<section class="section">
					<div class="block-title-2 primary-color">
						<span class="oi oi-person"></span><span><?php echo __( 'អតិថិជនដែលមានសិទ្ធទទួលសេវា៖' ); ?></span>
					</div>
					<div>
						<?php echo get_post_meta( $post->ID, 'cam_portal_service_customer', true ); ?>
					</div>
				</section>
				<section class="section">
					<div class="block-title-2 primary-color">
						<span class="oi oi-document"></span><span><?php echo __( 'ស្តង់ដារសេវា៖' ); ?></span>
					</div>
					<div>
						<?php echo get_post_meta( $post->ID, 'cam_portal_service_standart', true ); ?>
					</div>
				</section>
				<section class="section">
					<div class="block-title-2 primary-color">
						<span class="oi oi-circle-check"></span><span><?php echo __( 'តម្រូវការឯកសារ ដើម្បីទទួលបានសេវា៖' ); ?></span>
					</div>
					<div>
						<?php echo get_post_meta( $post->ID, 'cam_portal_service_doc', true ); ?>
						<?php if ( get_post_meta( $post->ID, 'cam_portal_service_form', true ) ) { ?>
							<a href="<?php echo get_post_meta( $post->ID, 'cam_portal_service_form', true ); ?>"><span class="oi oi-data-transfer-download"></span><span><?php echo __( 'ទាញយកទម្រង់បែបបទស្នើសុំ' ); ?></span></a>
						<?php } ?>
					</div>
				</section>
				<section class="section">
					<div class="block-title-2 primary-color">
						<span class="oi oi-compass"></span><span><?php echo __( 'នីតិវិធីនៃការផ្ដល់សេវា៖' ); ?></span>
					</div>
					<div>
						<?php echo get_post_meta( $post->ID, 'cam_portal_service_process', true ); ?>
						<?php if ( get_post_meta( $post->ID, 'cam_portal_service_pro_form', true ) ) { ?>
							<a href="<?php echo get_post_meta( $post->ID, 'cam_portal_service_pro_form', true ); ?>"><span class="oi oi-eye"></span><span><?php echo __( 'បង្ហាញនីតិវិធី' ); ?></span></a>
						<?php } ?>
					</div>
				</section>




				<?php 
				
				// Get the single terms
				$terms = [];
				foreach( get_the_terms ( get_the_id(), 'sector' ) as $term ){
					$terms[] = $term->term_id;
				}
				
				// WP_Query arguments
				$or_args = array(
					'post_type'				=> 'organization',
					'post_status'			=> array( 'publish' ),
					'posts_per_page'		=> -1,
					'orderby'				=> 'date',
					'order'   				=> 'DESC',
					'tax_query'             => array(
						array(
							'taxonomy'	=> 'sector',
							'terms'		=> $terms,
							'field'		=> 'id',
						),
					),
				);
				
				// The Query
				$query = new WP_Query( $or_args );
				if ( $query->have_posts() ) :
				?>
				<div class="block-title-2 primary-color">
						<span class="oi oi-map-marker"></span><span class="text"><?php echo __('កន្លែងផ្តល់សេវា', 'cam-portal'); ?></span>
					</div>
				<section class="section">
					<div class="collapsible">
						<ul>
				<?php
					while ( $query->have_posts() ) :
						$query->the_post();
						get_template_part( 'template-parts/content', 'organization' );
						
					endwhile;
				?>
						</ul>
					</div>
				</section>
				<?php
				endif;
				
				endwhile; // End of the loop.
				?>
			</div>
		</div>
	</div><!-- end row-->
</div><!-- #primary -->

<?php
get_footer();
