<?php

function collapse_catagory_shortcode_function( $atts , $content = null ) {
	ob_start();
	// Attributes
	$a = shortcode_atts(
		array(
			'cat_id' 		=> '', // category name ( multi category seperate by coma ',')
			'posts_per_page'=> '', // number of posts per page
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
            // echo '<li><pre>';
            // print_r( $term_obj );
            // echo '</pre></li>';
            echo( '<li class="action"><div class="action-group"><span class="oi oi-plus"></span><span class="title">' . $term_obj->name . '</span><span class="right badge badge-info">' . $term_obj->count . '</span></div>' );
            $args = array(
                'posts_per_page'    => $a['posts_per_page'],
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
            echo '<ul>';
            foreach( $posts_array as $post ) {
                echo '<li><span class="oi oi-chevron-right"></span><a href="' . $post->guid . '">'.mb_strimwidth( $post->post_title, 0, $a['char'], '...' ).'</a></li>';
            }
            ?>
            <li><a href="<?php echo get_term_link( $term_obj->term_id ); ?>"><strong><?php echo __( 'មានបន្ត', 'cam-portal' ); ?></strong></a> <span class="oi oi-external-link"></span></li>
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