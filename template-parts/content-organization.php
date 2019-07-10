<li>
	<div class="collapse-title d-flex justify-content-between">
		<div class="collapsible-action"><span class="oi oi-chevron-right"></span><span><?php the_title(); ?></span></div>
	</div>

	<ul>
		<?php
		if ( get_post_meta ( get_the_id(), 'cam_portal_dept_address', true ) ) {
		?>
		<li class="item-wrap"><span class="item-title primary-color"><?php echo __( 'អាសយដ្ឋាន ៖ ' ); ?></span>
			<ul>
				<li><?php echo get_post_meta ( get_the_id(), 'cam_portal_dept_address', true ); ?></li>
			</ul>
		</li>
		<?php
		}

		if ( get_post_meta ( get_the_id(), 'cam_portal_dept_address_maps', true ) ) {
		?>
		<li class="item-wrap"><span class="item-title primary-color"><?php echo __( 'ទីតាំងនៅលើផែនទី ៖ ' ); ?></span>
			<div class="map">
				<div class="google-map-api" data-latlng="<?php echo get_post_meta ( get_the_id(), 'cam_portal_dept_address_maps', true ); ?>" style="height:300px;"></div>
			</div>
		</li>
		<?php
		}

		if ( is_array( get_post_meta( get_the_id(), 'cam_portal_dept_contact_group', true ) ) && count ( get_post_meta( get_the_id(), 'cam_portal_dept_contact_group', true ) ) ) {
		?>
		<li class="item-wrap"><span class="item-title primary-color"><?php echo __( 'ទំនាក់ទំនង ៖ '); ?></span>
			<ul>
			<?php
			foreach ( get_post_meta( get_the_id(), 'cam_portal_dept_contact_group', true ) as $contact ) {
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
	</ul>
</li>