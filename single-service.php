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
			<div class="form-row service-filter">

				<div class="col-md-4">
					<div class="form-group">
						<label for="exampleFormControlSelect1"><?php echo __( 'ស្វែងរកតាមវិស័យ' , 'cam-portal' )?></label>
						<select class="form-control" id="exampleFormControlSelect1" onchange="location = this.value;">
							<option value="#"><?php echo __( 'សូមជ្រើសរើស' , 'cam-portal' )?></option>
							
							<?php 
							$terms = get_terms( array(
									'taxonomy' => 'sector',
									'hide_empty' => false,
							) );
							
							$queried_object = get_queried_object();
							
							
							foreach ( $terms as $term ) {

									$args = array(
											'post_type' => 'service',
											'post_status'=>'publish',
											'tax_query' => array(
													array(
															'taxonomy' => 'sector',
															'field'    => 'slug',
															'terms'    => array( $term->slug ),
													)
											),
									);
									$query = new WP_Query( $args );
									
									if ( function_exists( 'pll_home_url' ) ) {
											$home_url = pll_home_url().'sector/'.$term->slug;
									}else{
											$home_url = esc_url( home_url( 'sector/'.$term->slug ) );
									}
									
									$active = ( $queried_object->slug == $term->slug ) ? "selected" : "";

									echo '<option ' . $active . ' value=" ' . $home_url . ' ">' . $term->name . ' ('. $query->post_count .')</option>';
							}
							
							
							?>
							
							
							
									
						</select>
					</div>
				</div>
				<div class="col-md-4">
						<div class="form-group">
								<label for="exampleFormControlSelect2"><?php echo __( 'ស្វែងរកតាមក្រុម' , 'cam-portal' )?></label>
								<select class="form-control" id="exampleFormControlSelect2" onchange="location = this.value;">
										<option value="#"><?php echo __( 'សូមជ្រើសរើស' , 'cam-portal' )?></option>
								<?php 
								$terms = get_terms( array(
										'taxonomy' => 'service_group',
										'hide_empty' => false,
								) );

								foreach ( $terms as $term ) {


										$args = array(
												'post_type' => 'service',
												'post_status'=>'publish',
												'tax_query' => array(
														array(
																'taxonomy' => 'service_group',
																'field'    => 'slug',
																'terms'    => array( $term->slug ),
														)
												),
										);
										
										$query = new WP_Query( $args );
										
										if ( function_exists( 'pll_home_url' ) ) {
												$home_url = pll_home_url().'service_group/'.$term->slug;
										}else{
												$home_url = esc_url( home_url( 'service_group/'.$term->slug ) );
										}

										$active = ( $queried_object->slug == $term->slug ) ? "selected" : "";

										echo '<option ' . $active . ' value=" ' . $home_url . ' ">' . $term->name . ' ('. $query->post_count .')</option>';
								}
								
								
								?>
								</select>
						</div>
				</div>
				<div class="col-md-4">
						<div style="position:relative;" class="form-group">
								<label for="exampleFormControlSelect3"><?php echo __( 'ស្វែងរកតាមពាក្យ' , 'cam-portal' )?></label>
								<input placeholder="<?php echo __( 'សូមវាយឈ្មោះសេវាដែលអ្នកត្រូវការស្វែងរក', 'cam-portal' ); ?>" type="text" class="typeahead form-control" id="exampleFormControlSelect3" data-provide="typeahead" autocomplete="off" />
						</div>
				</div>
			</div>
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
