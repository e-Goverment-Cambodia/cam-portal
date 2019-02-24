<?php
// Add Shortcode
function sidebar_post_shortcode( $atts , $content = null ) {
	ob_start();
	// Attributes
	$atts = shortcode_atts(
		array(
			'type_slug' => '',
			'title' 	=> '',
			'date'		=> false,
			'link'		=> '',
		),
		$atts,
		'sidebar-post'
	);

	// WP_Query arguments
	$args = array(
		'post_type'              => array( 'section_data' ),
		'post_status'            => array( 'publish' ),
		'posts_per_page'         => '1',
		'tax_query'              => array(
			array(
				'taxonomy'         => 'types',
				'terms'            => $atts['type_slug'],
				'field'            => 'slug',
			),
		),
	);
	
	// The Query
	$section_query = new WP_Query( $args );
	// The Loop
	if ( $section_query -> have_posts() ) {
		while ( $section_query -> have_posts() ) :
		
		
			// To display the block title use the_block_title() function in 'inc\template-functions.php'
			if( $atts['title'] != '' ){
				$arr = [
					'type_slug'	=> $atts['type_slug'], 
					'taxonomy'	=> 'types', 
					'title'	=> $atts['title'],
				];
				the_block_title( $arr );
			}	
		
		
			$section_query -> the_post();
			$items = get_post_meta( get_the_ID(), 'cam_group_items', true );
			if( is_array( $items ) ) : 
			echo '<div class="widget-body-inner"><table class="table table-bordered">';
				foreach ( $items as $item ) {
					$item_name = $item['title'];
					$item_val = $item['value'];	
					echo '<tr>';			
					echo '<td>' . $item_name . '</td>';
					echo '<td>' . $item_val . '</td>';
					echo '</tr>';
				}
			echo '</table></div>';
			endif;
			if($atts['date']){ ?>
			<div class="widget-footer d-flex justify-content-between">
				<span><?php echo __('កែប្រែចុងក្រោយ', 'cam-portal'); ?></span><span>:</span><span class="primary-color"><?php the_modified_date(); ?> </span>
			</div>
			<?php
			}
			if($atts['link'] != ''){ ?>
				<div class="widget-footer d-flex justify-content-between">
					<span><?php echo __('ប្រភពមកពី', 'cam-portal'); ?></span><span>:</span><a href="<?php echo $atts['link']; ?>"><?php echo $atts['link']; ?></a>
				</div>
			<?php
			}
		endwhile;
	}
	// Restore original Post Data
	wp_reset_postdata();
	// Return code
	return ob_get_clean();
}
add_shortcode( 'sidebar-post', 'sidebar_post_shortcode' );