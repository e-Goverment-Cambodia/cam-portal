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
													<div class="map">
														<div class="google-map-api" data-latlng="<?php echo get_post_meta ( $org->ID, 'cam_portal_dept_address_maps', true ); ?>" style="height:300px;"></div>
													</div>
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
