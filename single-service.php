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
		<div class="col-lg-8">
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
									foreach ( $organization_query as $org ) {
										// echo $org->post_title;
										// echo get_post_meta( $org->ID, 'cam_portal_dept_address', true );
										// echo get_post_meta( $org->ID, 'cam_portal_dept_address_maps', true );
										// print_r( get_post_meta( $org->ID, 'cam_portal_dept_contact_group', true ) );
										?>
										<li>
											<div class="collapse-title d-flex justify-content-between">
												<div><span class="oi oi-chevron-right"></span><span><?php echo $org->post_title; ?></span></div>
												<div class="collapsible-action"><span><?php echo __( 'បង្ហាញ/លាក់' ); ?></span><span class="oi oi-minus"></span></div>
											</div>
										</li>
										<?php
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
				




				<section class="section">
					<div class="block-title-2 primary-color">
						<span class="oi oi-map-marker"></span><span class="text"><b><?php echo __( 'ការិយាល័យច្រកចេញចូលតែមួយ' ); ?></b></span>
					</div>
					<div class="collapsible">
						<ul>
							<li>
								<div class="collapse-title d-flex justify-content-between">
									<div><span class="oi oi-chevron-right"></span><span>ខណ្ឌពោធិ៍សែនជ័យ ៖</span></div>
									<div class="collapsible-action"><span>បង្ហាញ/លាក់</span><span class="oi oi-minus"></span></div>
								</div>
								<ul>
									<li class="item-wrap"><span class="item-title primary-color">អាសយដ្ឋាន ៖ </span>
										<ul>
											<li><span>លេខ៧៣៥ ភូមិ១ ឧសភា សង្កាត់កំពង់កណ្តាល ក្រុងកំពត ខេត្តកំពត</span></li>
											<li><span>Tel : info@kampot.gov.kh</span></li>
										</ul>
									</li>
									<li class="item-wrap"><span class="item-title primary-color">ទីតាំងនៅលើផែនទី ៖ </span>
										<div class="map"><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2763.84901396814!2d104.91688145244333!3d11.575323625672073!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xbd4e32a5eccddfb7!2sMinistry+of+Posts+and+Telecommunications!5e0!3m2!1sen!2skh!4v1550458133680" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe></div>
									</li>
									<li class="item-wrap"><span class="item-title primary-color">សមាជិកក្រុមប្រឹក្សាភិបាល ៖ </span>
										<ul>
											<li class="item">
												<div class="row">
													<div class="col-sm-12 col-md-6">
														<div><span>អភិបាលខណ្ឌ</span></div>
														<div><span class="oi oi-person"></span><span>លោក ហែម ដារិទ្ធិ</span></div>
													</div>
													<div class="col-sm-12 col-md-6">
														<div><span class="oi oi-phone"></span><span>077 927 777</span></div>
														<div><span class="oi oi-envelope-closed"></span><span>info@kampot.gov.kh</span></div>
													</div>
												</div>
											</li>
											<li class="item">
												<div class="row">
													<div class="col-sm-12 col-md-6">
														<div><span>អភិបាលខណ្ឌ</span></div>
														<div><span class="oi oi-person"></span><span>លោក ហែម ដារិទ្ធិ</span></div>
													</div>
													<div class="col-sm-12 col-md-6">
														<div><span class="oi oi-phone"></span><span>077 927 777</span></div>
														<div><span class="oi oi-envelope-closed"></span><span>info@kampot.gov.kh</span></div>
													</div>
												</div>
											</li>
										</ul>
									</li>
									<li class="item-wrap"><span class="item-title primary-color">មន្រ្តីក្រុមប្រឹក្សាធម្មនុញ្ញជាន់ខ្ពស់និងជំនួយការផ្ទាល់ ៖ </span>
										<ul>
											<li class="item">
												<div class="row">
													<div class="col-sm-12 col-md-6">
														<div><span>អភិបាលខណ្ឌ</span></div>
														<div><span class="oi oi-person"></span><span>លោក ហែម ដារិទ្ធិ</span></div>
													</div>
													<div class="col-sm-12 col-md-6">
														<div><span class="oi oi-phone"></span><span>077 927 777</span></div>
														<div><span class="oi oi-envelope-closed"></span><span>info@kampot.gov.kh</span></div>
													</div>
												</div>
											</li>
											<li class="item">
												<div class="row">
													<div class="col-sm-12 col-md-6">
														<div><span>អភិបាលខណ្ឌ</span></div>
														<div><span class="oi oi-person"></span><span>លោក ហែម ដារិទ្ធិ</span></div>
													</div>
													<div class="col-sm-12 col-md-6">
														<div><span class="oi oi-phone"></span><span>077 927 777</span></div>
														<div><span class="oi oi-envelope-closed"></span><span>info@kampot.gov.kh</span></div>
													</div>
												</div>
											</li>
										</ul>
									</li>
								</ul>
							</li>
							<li>
								<div class="collapse-title d-flex justify-content-between">
									<div><span class="oi oi-chevron-right"></span><span>ខណ្ឌចំការមន ៖</span></div>
									<div class="collapsible-action"><span>បង្ហាញ/លាក់</span><span class="oi oi-plus"></span></div>
								</div>
								<ul>
									<li class="item-wrap"><span class="item-title primary-color">អាសយដ្ឋាន ៖ </span>
										<ul>
											<li><span>លេខ៧៣៥ ភូមិ១ ឧសភា សង្កាត់កំពង់កណ្តាល ក្រុងកំពត ខេត្តកំពត</span></li>
											<li><span>Tel : info@kampot.gov.kh</span></li>
										</ul>
									</li>
									<li class="item-wrap"><span class="item-title primary-color">ទីតាំងនៅលើផែនទី ៖ </span>
										<div class="map"><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2763.84901396814!2d104.91688145244333!3d11.575323625672073!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xbd4e32a5eccddfb7!2sMinistry+of+Posts+and+Telecommunications!5e0!3m2!1sen!2skh!4v1550458133680" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe></div>
									</li>
									<li class="item-wrap"><span class="item-title primary-color">សមាជិកក្រុមប្រឹក្សាភិបាល ៖ </span>
										<ul>
											<li class="item">
												<div class="row">
													<div class="col-sm-12 col-md-6">
														<div><span>អភិបាលខណ្ឌ</span></div>
														<div><span class="oi oi-person"></span><span>លោក ហែម ដារិទ្ធិ</span></div>
													</div>
													<div class="col-sm-12 col-md-6">
														<div><span class="oi oi-phone"></span><span>077 927 777</span></div>
														<div><span class="oi oi-envelope-closed"></span><span>info@kampot.gov.kh</span></div>
													</div>
												</div>
											</li>
											<li class="item">
												<div class="row">
													<div class="col-sm-12 col-md-6">
														<div><span>អភិបាលខណ្ឌ</span></div>
														<div><span class="oi oi-person"></span><span>លោក ហែម ដារិទ្ធិ</span></div>
													</div>
													<div class="col-sm-12 col-md-6">
														<div><span class="oi oi-phone"></span><span>077 927 777</span></div>
														<div><span class="oi oi-envelope-closed"></span><span>info@kampot.gov.kh</span></div>
													</div>
												</div>
											</li>
										</ul>
									</li>
									<li class="item-wrap"><span class="item-title primary-color">មន្រ្តីក្រុមប្រឹក្សាធម្មនុញ្ញជាន់ខ្ពស់និងជំនួយការផ្ទាល់ ៖ </span>
										<ul>
											<li class="item">
												<div class="row">
													<div class="col-sm-12 col-md-6">
														<div><span>អភិបាលខណ្ឌ</span></div>
														<div><span class="oi oi-person"></span><span>លោក ហែម ដារិទ្ធិ</span></div>
													</div>
													<div class="col-sm-12 col-md-6">
														<div><span class="oi oi-phone"></span><span>077 927 777</span></div>
														<div><span class="oi oi-envelope-closed"></span><span>info@kampot.gov.kh</span></div>
													</div>
												</div>
											</li>
											<li class="item">
												<div class="row">
													<div class="col-sm-12 col-md-6">
														<div><span>អភិបាលខណ្ឌ</span></div>
														<div><span class="oi oi-person"></span><span>លោក ហែម ដារិទ្ធិ</span></div>
													</div>
													<div class="col-sm-12 col-md-6">
														<div><span class="oi oi-phone"></span><span>077 927 777</span></div>
														<div><span class="oi oi-envelope-closed"></span><span>info@kampot.gov.kh</span></div>
													</div>
												</div>
											</li>
										</ul>
									</li>
								</ul>
							</li>
						</ul>
					</div>
				</section>

			<?php
			endwhile; // End of the loop.
			?>
			</div>
		</div>
		<div class="col-lg-4 widget-area">
		<?php
			if ( isset( $_GET['widget'] ) ) {
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
			}
		?>
		</div>
	</div><!-- end row-->
</div><!-- #primary -->

<?php
get_footer();
