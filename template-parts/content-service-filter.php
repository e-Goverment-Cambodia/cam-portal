<form class="service-filter" method="GET" action="<?php echo home_url('/'); ?>">
	<div class="form-goup row">

		<div class="col-sm-4 pr-sm-0">
			<div class="form-group">
				<label for="exampleFormControlSelect1"><?php echo __( 'ស្វែងរកតាមវិស័យ' , 'cam-portal' )?></label>
				<select class="custom-select" id="exampleFormControlSelect1" onchange="location = this.value;">
					<option value="#"><?php echo __( 'សូមជ្រើសរើស' , 'cam-portal' )?></option>
				
					<?php 
					$terms = get_terms( array(
						'taxonomy' => 'sector',
						'hide_empty' => false
					) );
					foreach ( $terms as $term ) {
						
						// get specific term by post type
						$args = array(
							'post_type'		=> 'service',
							'post_status'	=> 'publish',
							'tax_query'		=> array(
								array(
									'taxonomy' => 'sector',
									'field'    => 'slug',
									'terms'    => array( $term->slug ),
								)
							),
						);
						$query = new WP_Query( $args );
						$active = ( get_query_var( 'term' ) == $term->slug ) ? 'selected' : '';
						echo '<option '. $active .' value=" ' . get_term_link( $term->term_id, $term->taxonomy ) . ' ">' . $term->name . ' ('. $query->post_count .')</option>';
					}
					?>                
				</select>
			</div>
		</div>
		
		<div class="col-sm-4 pl-sm-0 pr-sm-0">
			<div class="form-group">
				<label for="exampleFormControlSelect2"><?php echo __( 'ស្វែងរកតាមក្រុម' , 'cam-portal' )?></label>
				<select class="custom-select" id="exampleFormControlSelect2" onchange="location = this.value;">
					<option value="#"><?php echo __( 'សូមជ្រើសរើស' , 'cam-portal' )?></option>
					<?php 
					$terms = get_terms( array(
							'taxonomy' => 'service_group',
							'hide_empty' => false,
						) );
					foreach ( $terms as $term ) {
						$active = ( get_query_var( 'term' ) == $term->slug ) ? 'selected' : '';
						echo '<option '. $active .' value=" ' . get_term_link( $term->term_id, $term->taxonomy ) . ' ">' . $term->name . ' ('. $term->count .')</option>';
					}
					?>
				</select>
			</div>
		</div>
		
		<div class="col-sm-4 pl-sm-0">
			<div class="form-group">
				<label for="exampleFormControlSelect3"><?php echo __( 'ស្វែងរកតាមពាក្យ' , 'cam-portal' )?></label>
				<input type="hidden" name="post_type" value="service" />
				<div style="position:relative;">
				<input name="s" placeholder="<?php echo __( 'សូមវាយឈ្មោះសេវា', 'cam-portal' ); ?>" type="text" class="typeahead form-control" id="exampleFormControlSelect3" data-provide="typeahead" autocomplete="off" />
				<button class="btn btn-secondary" type="submit"><?php echo __( 'ស្វែងរក', 'cam-portal' ); ?></button>
				</div>
			</div>
		</div>
	</div>
</form>	