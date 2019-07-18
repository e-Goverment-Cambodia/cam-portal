<div class="b-item-wrap">
	<div class="b-item">
		<div class="b-title-wrap">
			<div class="b-title margin-bottom-15"><a href="<?php the_permalink(); ?>"><span style="color: #ccc;font-size: 14px;" class="oi oi-chevron-right"></span> <?php the_title(); ?></a></div>
			<div class="b-cat">
			<?php 
			if ( get_the_terms ( $post->ID, 'sector' ) ) {
				$term_obj_list = get_the_terms ( $post->ID, 'sector' );
				$terms_string = join ( ', ', wp_list_pluck ( $term_obj_list, 'name' ) );
				printf( '<span class="oi oi-paperclip"></span><span>%s</span>', $terms_string );
			}
			?>
				<?php if ( get_post_meta( $post->ID, 'cam_portal_service_form', true ) ) { ?>
					<a href="<?php echo get_post_meta( $post->ID, 'cam_portal_service_form', true ); ?>"><span class="oi oi-cloud-download"></span><?php echo __( 'ទម្រង់បែបបទ' ); ?></a>
				<?php } ?>
				<?php if ( get_post_meta( $post->ID, 'cam_portal_service_pro_form', true ) ) { ?>
					<a href="<?php echo get_post_meta( $post->ID, 'cam_portal_service_pro_form', true ); ?>"><span class="oi oi-eye"></span><?php echo __( 'និតិវិធី' ); ?></a>
				<?php } ?>
					
			</div>
		</div>
	</div>
</div>