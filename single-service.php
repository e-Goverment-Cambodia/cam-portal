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
						<span class="oi oi-star"></span><span><b><?php echo __( 'គោលបំណង៖' ); ?></b></span>
					</div>
					<div>
						<?php echo get_post_meta( $post->ID, 'cam_portal_service_purpose', true ); ?>
					</div>
				</section>
				<section class="section">
					<div class="block-title-2 primary-color">
						<span class="oi oi-book"></span><span><b><?php echo __( 'មូលដ្ឋានគតិយុត្ត៖' ); ?></b></span>
					</div>
					<div>
						<?php echo get_post_meta( $post->ID, 'cam_portal_service_regulation', true ); ?>
					</div>
				</section>
				<section class="section">
					<div class="block-title-2 primary-color">
						<span class="oi oi-person"></span><span><b><?php echo __( 'អតិថិជនដែលមានសិទ្ធទទួលសេវា៖' ); ?></b></span>
					</div>
					<div>
						<?php echo get_post_meta( $post->ID, 'cam_portal_service_customer', true ); ?>
					</div>
				</section>
				<section class="section">
					<div class="block-title-2 primary-color">
						<span class="oi oi-document"></span><span><b><?php echo __( 'ស្តង់ដារសេវា៖' ); ?></b></span>
					</div>
					<div>
						<?php echo get_post_meta( $post->ID, 'cam_portal_service_standart', true ); ?>
					</div>
				</section>
				<section class="section">
					<div class="block-title-2 primary-color">
						<span class="oi oi-circle-check"></span><span><b><?php echo __( 'តម្រូវការឯកសារ ដើម្បីទទួលបានសេវា៖' ); ?></b></span>
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
						<span class="oi oi-compass"></span><span><b><?php echo __( 'នីតិវិធីនៃការផ្ដល់សេវា៖' ); ?></b></span>
					</div>
					<div>
						<?php echo get_post_meta( $post->ID, 'cam_portal_service_process', true ); ?>
						<?php if ( get_post_meta( $post->ID, 'cam_portal_service_pro_form', true ) ) { ?>
							<a href="<?php echo get_post_meta( $post->ID, 'cam_portal_service_pro_form', true ); ?>"><span class="oi oi-eye"></span><span><?php echo __( 'បង្ហាញនីតិវិធី' ); ?></span></a>
						<?php } ?>
					</div>
				</section>




				<?php 
				if ( get_the_terms ( $post->ID, 'sector' ) ) {
					$term_obj_list = get_the_terms ( $post->ID, 'sector' );
					$term_obj_arrays = wp_list_pluck ( $term_obj_list, 'name' );
					if ( count ( $term_obj_arrays ) ) {
						foreach ( $term_obj_arrays as $term  ) {
							?>
							<section class="section">
								<div class="block-title-2 primary-color">
									<span class="oi oi-map-marker"></span><span class="text"><b><?php echo $term ?></b></span>
								</div>
							<?php
							$args = array(
								'post_type'              => array( 'organization' ),
								'post_status'            => array( 'publish' ),
								'posts_per_page'         => -1,
								'tax_query'              => array(
									array(
										'taxonomy'         => 'sector',
										'terms'            => $term,
										'field'            => 'name',
									),
								),
							);
							$organization_query = get_posts( $args );
							if ( count ( $organization_query ) ) {
								?>
								<div class="collapsible">
									<ul>
									<?php
									$i = 0;
									foreach ( $organization_query as $org ) {
										// echo $org->post_title;
										// echo get_post_meta( $org->ID, 'cam_portal_dept_address', true );
										// echo get_post_meta( $org->ID, 'cam_portal_dept_address_maps', true );
										// print_r( get_post_meta( $org->ID, 'cam_portal_dept_contact_group', true ) );
										?>
										<li>
											<div class="collapse-title d-flex justify-content-between">
												<div class="collapsible-action"><span class="oi <?php echo $i > 0 ? 'oi-chevron-right' : 'oi-chevron-bottom'; ?>"></span><span><?php echo $org->post_title; ?></span></div>
											</div>
										
											<ul>
											<?php
											if ( get_post_meta ( $org->ID, 'cam_portal_dept_address', true ) ) {
											?>
												<li class="item-wrap"><span class="item-title primary-color"><?php echo __( 'អាសយដ្ឋាន ៖ ' ); ?></span>
													<ul>
														<li><?php echo get_post_meta ( $org->ID, 'cam_portal_dept_address', true ); ?></li>
													</ul>
												</li>
											<?php
											}

											if ( get_post_meta ( $org->ID, 'cam_portal_dept_address_maps', true ) ) {
											?>
												<li class="item-wrap"><span class="item-title primary-color"><?php echo __( 'ទីតាំងនៅលើផែនទី ៖ ' ); ?></span>
													<div class="map"><?php echo get_post_meta ( $org->ID, 'cam_portal_dept_address_maps', true ); ?></div>
												</li>
											<?php
											}

											if ( count ( get_post_meta( $org->ID, 'cam_portal_dept_contact_group', true ) ) ) {
											?>
												<li class="item-wrap"><span class="item-title primary-color"><?php echo __( 'ទំនាក់ទំនង ៖ '); ?></span>
													<ul>
													<?php
													foreach ( get_post_meta( $org->ID, 'cam_portal_dept_contact_group', true ) as $contact ) {
													?>
														<li class="item">
															<div class="row">
																<div class="col-sm-12 col-md-6">
																	<div><span><?php echo $contact['contact_position']; ?></span></div>
																	<div><span class="oi oi-person"></span><span><?php echo $contact['contact_name']; ?></span></div>
																</div>
																<div class="col-sm-12 col-md-6">
																	<div><span class="oi oi-phone"></span><span><?php echo $contact['contact_number']; ?></span></div>
																	<div><span class="oi oi-envelope-closed"></span><span><?php echo $contact['contact_email']; ?></span></div>
																</div>
															</div>
														</li>
													<?php
													}
													?>
														
													</ul>
												</li>
											<?php
											}
											?>
											</li>
										</ul>
										<?php
										$i ++;
									}
									?>
									</ul>
								</div>
								<?php
							}
							?>
							</section>
							<?php
						}
					}
				}
				?>
				<?php
				endwhile; // End of the loop.
				?>
			</div>
		</div>
		<div class="col-lg-4 widget-area">
		<?php
			/*if ( isset( $_GET['widget'] ) ) {
				switch ( $_GET['widget'] ) {
					case 'sector':
						dynamic_sidebar( 'sidebar-3' );
						break;
					case 'group':
						dynamic_sidebar( 'sidebar-4' );
						break;
					default:
						dynamic_sidebar( 'sidebar-3' );
				}
			}else{
				dynamic_sidebar( 'sidebar-2' );
			}*/
		?>
		</div>
	</div><!-- end row-->
</div><!-- #primary -->

<?php
get_footer();
