<?php

function collapse_catagory_shortcode_function( $atts , $content = null ) {
	ob_start();
	// Attributes
	$a = shortcode_atts(
		array(
			'cat_id' 		=> '', // category name ( multi category seperate by coma ',')
			'posts_per_page'=> 4, // number of posts per page
			'offset'		=> 0, 
			'title'			=> '', // title of block title
			'link_cat_id'	=> '',  // the block title's link to a category list
			'char'			=> 75
		),
		$atts
    );
    // To display the block title use the_block_title() function in 'inc\template-functions.php'
    if( $a['title'] != '' ){
        $arr = [
            'cat_id'	=> $a['link_cat_id'], 
            'title'	=> $a['title'],
        ];
        the_block_title( $arr );
    }	
        
    if ( $a['cat_id'] ) {
    ?>

    <ul class="collapse-category">

    <?php
        $cat_arr = explode( ',', $a['cat_id'] );
        for ( $i=0; $i < count( $cat_arr ); $i++ ) {
            $term_obj = get_term( $cat_arr[$i] );
            $args = array(
                'posts_per_page'    => -1,
                'offset'            => $a['offset'],
                'cat'               => $cat_arr[$i],
                'category_name'     => '',
                'orderby'           => 'date',
                'order'             => 'DESC',
                'include'           => '',
                'exclude'           => '',
                'meta_key'          => '',
                'meta_value'        => '',
                'post_type'         => 'post',
                'post_mime_type'    => '',
                'post_parent'       => '',
                'author'	        => '',
                'author_name'	    => '',
                'post_status'       => 'publish',
                'suppress_filters'  => true,
                'fields'            => '',
            );
            $posts_array = get_posts( $args );
			$count = count( $posts_array );
			
            echo( '<li class="action"><div class="action-group"><span class="oi oi-plus"></span><span class="title">' . $term_obj->name . '</span><span class="right badge badge-info">' . $count . '</span></div>' );
			$count = ( $count < $a['posts_per_page'] ) ? $count : $a['posts_per_page'];
            echo '<ul>';
            for( $j = 0; $j < $count; $j++ ) {
                echo '<li><span class="oi oi-chevron-right"></span><a href="' . $posts_array[$j]->guid . '">'.mb_strimwidth( $posts_array[$j]->post_title, 0, $a['char'], '...' ).'</a></li>';
            }
			if( count( $posts_array ) > $a['posts_per_page'] ) {
            ?>
            <li><a href="<?php echo get_term_link( $term_obj->term_id ); ?>"><strong><?php echo __( 'មានបន្ត', 'cam-portal' ); ?></strong></a> <span class="oi oi-external-link"></span></li>
            <?php } ?>
			</ul>
            </li>
            <?php
            // echo '<li><pre>';
            // print_r( $posts_array );
            // echo '</pre></li>';
        }
    ?>

    </ul>

    <?php
    }
    
	// Return code
	return ob_get_clean();
}
add_shortcode( 'collapse-category', 'collapse_catagory_shortcode_function' );

/*

Example :
[collapse-category cat_id="1,2,3" posts_per_page="5" title="Blog Title" offset="0" link_cat_id="" char="75"]


*/