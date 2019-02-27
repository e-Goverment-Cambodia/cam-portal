<?php
/**
 * Template part for displaying single
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Cambodia_Portal
 */

?>
<div class="detail-wrap">
	<div class="head">
	<?php the_title( '<div class="title primary-color"><h4>', '</h4></div>' ); ?>
		<div class="meta">
			<?php
			cam_portal_posted_on();
			cam_portal_posted_by();
			cam_portal_the_posted_view_count();
			?>
		</div><!-- #meta -->
	</div><!-- #head -->

	<table class="table table-bordered">
		<?php
		$items = get_post_meta( get_the_ID(), 'cam_group_items', true );
		if( is_array( $items ) ) : 
			foreach ( $items as $item ) {
				$tr = '<tr><td>%s</td><td>%s</td></tr>';
				printf( $tr,  $item['title'], $item['value'] );
			}
	
		endif;
		

		
		?>
	</table><!-- #table -->
</div><!-- #detail-wrap -->


