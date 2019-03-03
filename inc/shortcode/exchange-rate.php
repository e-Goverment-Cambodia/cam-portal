<?php

function cam_portal_exchange_rate_shortcode( $atts , $content = null ) {
	ob_start();
    
    // Attributes
	$atts = shortcode_atts(
		array(
			'title' 	=> '',
			'link'		=> '',
            'max'		=> 10,
            'lang'      => 'kh'
		),
		$atts,
		'exchange-rate'
	);

	 // To display the block title use the_block_title() function in 'inc\template-functions.php'
    if( $atts['title'] != '' ){
        $arr = array( 'title'	=> $atts['title'] );
        the_block_title( $arr );
    }	
    $data = get_transient( 'exchangerate'.$atts['lang'] ) ;
    
    if ( $data === false ) {

        $url = "http://exchange.kravanh.com/api/".$atts['lang']."/exchange";
        $json = file_get_contents( $url );
        $json_data = json_decode( $json, true );
        $data = json_encode( $json_data['data'], true );

        set_transient( 'exchangerate'.$atts['lang'], $data, '3600' );
   }

    $html = '<div class="widget-body-inner">
                <table class="table table-bordered">
                    <tr><th colspan="2">%s</th><th>%s</th><th>%s</th>';
    printf( $html, __( 'រូបិយប័ណ្ណ', 'cam-portal' ), __( 'ឯកតា', 'cam-portal' ), __( 'ទិញ', 'cam-portal' ) );
   

    $value = json_decode( $data );
    
    for( $i = 0; $i < count( $value ); $i ++ ) {
        
        if ( $i < ( $atts['max'] ) ) { 
            echo '<tr><td>'.$value[$i]->currency.'</td><td>'.$value[$i]->symbol.'</td><td>'.$value[$i]->unit.'</td><td>'.$value[$i]->bid.'</td>';
        } else {
            $i = count( $value ); 
        }
    }

    $html = '</table>
        </div>
        <div class="widget-footer d-flex justify-content-between">
            <span>%s</span><span>:</span><a href="%s">www.nbc.org.kh</a>
        </div>';
    printf( $html, __( 'ប្រភពមកពី', 'cam-portal' ), esc_url( 'www.nbc.org.kh/economic_research/exchange_rate.php' ) );
	
	return ob_get_clean();
}
add_shortcode( 'exchange-rate', 'cam_portal_exchange_rate_shortcode' );