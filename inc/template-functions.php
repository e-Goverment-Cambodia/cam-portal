<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Cambodia_Portal
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function cam_portal_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'cam_portal_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function cam_portal_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'cam_portal_pingback_header' );

function the_block_title( $arr ){
	
	$link = '<span class="primary-color font-moul" >'.$arr['title'].'</span>';
	
	if ( isset( $arr['cat_id'] ) && $arr['cat_id'] != '' ) {
		
		// Get the URL of this category
		$category_link = get_category_link( $arr['cat_id'] );
	}
		
	if ( isset( $category_link ) && $category_link != '' ) {
		$link = '<a class="primary-color font-moul" href="'. esc_url( $category_link ) .'">'.$arr['title'].'</a>';
	}
	
	if ( isset( $arr['taxonomy'] ) && $arr['taxonomy'] != '' ) {
		$link = '<a class="primary-color font-moul" href="'. esc_url( get_term_link( $arr['type_slug'], $arr['taxonomy'] ) ) .'">'.esc_html( $arr['title'] ).'</a>';
	}
	
	
    $html =     '<div class="block-title primary-color">%s</div>';
    printf( $html, $link );
}


if( !function_exists( 'cam_portal_get_the_post_thumbnail' ) ) {
	
	function cam_portal_get_the_post_thumbnail( $size = 'post-thumbnail' ) {
		
		if( has_post_thumbnail() ) {
			$url = get_the_post_thumbnail_url( '', $size );
		}else{
			$url = get_template_directory_uri().'/asset/img/'.$size.'.png';
		}
		
		return $url;
	}
}
# ---------------------------------------------------
# REMOVE SCREEN READER TEXT FROM POST PAGINATION
# ---------------------------------------------------



function sanitize_pagination($content) {
    // Remove h2 tag
    $content = preg_replace('#<h2.*?>(.*?)<\/h2>#si', '', $content);
    return $content;
}
 
add_action('navigation_markup_template', 'sanitize_pagination');

if( !function_exists( 'cam_portal_get_the_related_post' ) ) {
	function cam_portal_get_the_related_post() {
	
		global $post;
		$last_id = $post->ID;
		$cat_id = wp_get_post_categories( $post->ID, array( 'fields' => 'ids' ) );
		$data = array();
		$args = array(
			'category__in'	 	=> $cat_id,
			'posts_per_page'	=> 8,
		);
		
		$query = new WP_Query( $args );
		
		if( $query->have_posts() ) {

			$min = 4;
		
			while( $query -> have_posts() ) {
				$query->the_post();
				if( $last_id != get_the_id() ) {
					array_push( 
						$data, 
						array(
							'title'		=> get_the_title(),
							'permalink'	=> get_the_permalink(),
							'date'		=> get_the_date(),
							'post_thumbnail'	=> cam_portal_get_the_post_thumbnail()
						)
					);
					$min --;
				}
			}
		}
		if( $min > 0 ) {
			while( $min > 0 ) {
				array_push( 
					$data, 
					array(
						'title' 	=> '',
						'permalink'	=> '',
						'date'		=> '',
						'post_thumbnail'	=> get_template_directory_uri().'/asset/img/post-thumbnail.png'
					)
				);
				$min --;
			}
		}
		wp_reset_postdata();
		return $data;
	}
}

if ( ! function_exists( 'cam_portal_get_the_posted_view_count' ) ) {

	function cam_portal_get_the_posted_view_count() {
		$view = get_post_meta( get_the_ID(), 'post_views_count' );
		if( $view ) {
			return cam_portal_kilo_mega_giga( $view[0] );
		}
		return 0;
	}
}

/*
 * Set post views count using post meta
 */

if( !function_exists( 'camb_portal_track_post_views' ) ) {
	function camb_portal_track_post_views ($post_id) {

		if ( is_singular() ) {

			if ( empty ( $post_id) ) {
				global $post;
				$post_id = $post->ID;    
			}

			$countKey = 'post_views_count';
			$count = get_post_meta( $post_id, $countKey, true );
			if( $count == '' ){
				$count = 0;
				delete_post_meta( $post_id, $countKey );
				add_post_meta( $post_id, $countKey, '0' );
			}else{
				$count++;
				update_post_meta( $post_id, $countKey, $count );
			}
		}
	}
}
add_action( 'wp_head', 'camb_portal_track_post_views');


if( !function_exists('cam_portal_kilo_mega_giga') ) {
	function cam_portal_kilo_mega_giga($n) {    

		if($n >= 1000 && $n < 1000000)
		{
			if($n%1000 === 0)
			{
				$formatted = ($n/1000);
			}
			else
			{
				$formatted = substr($n, 0, -3).'.'.substr($n, -3, 1);
				 if(substr($formatted, -1, 1) === '0')
				 {
				   $formatted = substr($formatted, 0, -2);
				 }
			}
		
			$formatted.= 'k';
		
		} else 
		
		if($n >= 1000000 && $n < 1000000000)
		{
			if($n%1000000 === 0)
			{
				$formatted = ($n/1000000);
			}
			else
			{
				$formatted = substr($n, 0, -6).'.'.substr($n, -6, 1);
				 if(substr($formatted, -1, 1) === '0')
				 {
				   $formatted = substr($formatted, 0, -2);
				 }
			}
		
			$formatted.= 'M';
		} else 
		
		if($n >= 1000000000 && $n < 1000000000000)
		{
			if($n%1000000000 === 0)
			{
				$formatted = ($n/1000000000);
			}
			else
			{
				$formatted = substr($n, 0, -9).'.'.substr($n, -9, 1);
				 if(substr($formatted, -1, 1) === '0')
				 {
				   $formatted = substr($formatted, 0, -2);
				 }
			}
		
			$formatted.= 'G';
		} else
		
		if($n >= 0 && $n < 1000)
		{ 
		
			$formatted= $n;
		} 
		
		return $formatted;
	}
}

if( !function_exists( 'cam_portal_get_layout' ) ) {
	function cam_portal_get_layout( $tag_type ) {
		$layout_opt = get_theme_mod( 'cam_portal_resonsive_option', 0 );
		if(($layout_opt == 0 ) && ( $tag_type == 'html' )) { $value = 'class="responsive"'; }else{ $value = 'class="non-responsive"'; }
		if(( $layout_opt == 0 ) && ( $tag_type == 'scale' )) { $value = 'initial-scale=1'; }else { $value = 'initial-scale=0'; }
		if(( $layout_opt == 0 ) && ( $tag_type == 'footer' )) { $value = 'active'; }else{ $value = '';}
		return $value;
	}
}