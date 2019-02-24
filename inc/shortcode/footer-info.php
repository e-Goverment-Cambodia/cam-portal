<?php
if( !function_exists( 'cam_portal_footer_info_shortcode' ) ) {
	
	function cam_portal_footer_info_shortcode( $atts ) {
		ob_start();
		// Attributes
		$atts = shortcode_atts(
			array(
				'address'		=> '',
				'email' 		=> '',
				'phone_number'	=> '',
				'facebook'		=> '',
				'youtube'		=> '',
			),
			$atts,
			'footer-info'
		);
		$facebook ='';
		if( $atts['facebook'] != '' ) {
			$facebook = '<a href="'.esc_url( $atts['facebook'] ).'">
						<img src="'.get_template_directory_uri().'/asset/img/facebook-icon.jpg" />
					</a>';
		}
		$youtube = '';
		if( $atts['youtube'] != '' ) {
			$youtube = '<a href="'.esc_url( $atts['youtube'] ).'">
						<img src="'.get_template_directory_uri().'/asset/img/youtube-icon.jpg" />
					</a>';
		}
					
		$html = '<h4 class="font-moul footer-brand">%s</h4>
				<p>%s</p>
				<p>%s</p>
				<p>%s</p>
				<div class="footer-social">
					%s
				</div>';
		printf( $html, get_bloginfo( 'name' ), $atts['address'], __( 'អ៊ីមែល', 'cam-portal' ).' : '.$atts['email'], __( 'លេខទូរស័ព្ទ', 'cam-portal' ).' : '.$atts['phone_number'] , $facebook.''.$youtube );
		
		return ob_get_clean();
	}
}
add_shortcode( 'footer-info', 'cam_portal_footer_info_shortcode' );