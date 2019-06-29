<?php

function popular_post_shortcode_function( $atts , $content = null ) {
	ob_start();
	// Attributes
	$a = shortcode_atts(
		array(
			'posts_per_page'=> '', // number of posts per page
			'title'			=> '', // title of block title
			'link_cat_id'	=> '',  // the block title's link to a category list
            'char'			=> 75,
            'day'           => 0,
            'post_type'     => 'post',
            'date'          => true,
            'author'        => true,
            'view'          => true,
            'thumbnail'     => true
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
        
    $args = array(
        'posts_per_page'    => $a['posts_per_page'],
        'offset'            => 0,
        'cat'               => '',
        'category_name'     => '',
        'orderby'           => 'meta_value_num',
        'order'             => 'DESC',
        'include'           => '',
        'exclude'           => '',
        'meta_key'          => 'post_views_count',
        'meta_value'        => '',
        'post_type'         => $a['post_type'],
        'post_mime_type'    => '',
        'post_parent'       => '',
        'author'	        => '',
        'author_name'	    => '',
        'post_status'       => 'publish',
        'suppress_filters'  => true,
        'fields'            => '',
        'date_query' => array(
            array(
                'after' => $a['day'] ? date('Y-m-d', strtotime( '-'.$a['day'].' days')) : ''
            )
        )
    );

    // The Query
    $the_query = new WP_Query( $args );

    // The Loop
    if ( $the_query->have_posts() ) {
        echo '<ul class="sidebar-block">';
        while ( $the_query->have_posts() ) {
            $the_query->the_post();
            ?>

            <li>
                <?php $a['thumbnail'] ? the_post_thumbnail( 'thumbnail' ) : '' ?>
                <div class="side-text">
                    <a href="<?php the_permalink() ?>"><?php echo mb_strimwidth( get_the_title(), 0, $a['char'], '...' ) ?></a>
                    <?php if( $a['date'] || $a['author'] || $a['view'] ){?>
                    <div class="meta">
                        <?php
                        $a['date'] ? cam_portal_posted_on() : '';
                        $a['author'] ? cam_portal_posted_by() : '';
                        $a['view'] ? cam_portal_the_posted_view_count() : '';
                        ?>
                    </div>
                    <?php } ?>
                </div>
            </li>



            <?php
        }
       
        /* Restore original Post Data */
        wp_reset_postdata();
        echo '</ul>';
    }
    
    // echo '<li><pre>';
    // print_r( $posts_array );
    // echo '</pre></li>';
   
	// Return code
	return ob_get_clean();
}
add_shortcode( 'popular-post', 'popular_post_shortcode_function' );

/*

Example :
[popular-post posts_per_page="5" post_type="post" title="Blog Title" link_cat_id="" char="75" day="0" date=true author=true view=true thumbnail=true ]


*/