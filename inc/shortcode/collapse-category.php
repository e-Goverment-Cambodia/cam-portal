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
    if ( $a['cat_id'] ) {
    ?>

    <ul>

    <?php
        $cat_arr = explode( ',', $a['cat_id'] );
        for ( $i=0; $i < count( $cat_arr ); $i++ ) {
            $term_obj = get_term( $cat_arr[$i] );
            echo '<li><pre>';
            print_r( $term_obj );
            echo '</pre></li>';
            echo( '<li><span class="oi oi-chevron-right"></span><span>' . $term_obj->name . '<span class="badge badge-info">' . $term_obj->count . '</span></span>' );
            $args = array(
                'posts_per_page'    => 5,
                'offset'            => 0,
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
                echo '<li><a href="' . $post->guid . '">'.mb_strimwidth( $post->post_title, 0, $a['char'], '...' ).'</a></li>';
            }
            echo '<li><a href="'.get_term_link( $term_obj->term_id ).'">មានបន្ត<span class="oi oi-external-link"></span></a></li>';
            echo '</ul>';
            echo '</li>';

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