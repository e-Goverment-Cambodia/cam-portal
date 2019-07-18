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
	
	if( isset( $arr['link'] ) ) {
		$link = '<a class="primary-color font-moul" href="'. $arr['link'] .'">'.$arr['title'].'</a>';
	}
	
	
    $html =     '<div class="block-title primary-color">%s</div>';
    printf( $html, $link );
}

if( ! function_exists( 'the_blog_title' ) ) {
	function the_blog_title( $arr ) {
		$title = '<span class="primary-color font-moul" >'.$arr['title'].'</span>';
		$link = get_term_link( $arr['terms'], $arr['taxonomy'] );
		if( ! is_wp_error( $link ) ) 
		$title = '<a class="primary-color font-moul" href="'. esc_url( $link ) .'">'.esc_html( $arr['title'] ).'</a>';
		$html =     '<div class="block-title primary-color">%s</div>';
		printf( $html, $title );
	}
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
		function cam_portal_kilo_mega_giga( $number ) {
			$number_format = number_format_i18n( $number );
			$exploded = explode( ',', $number_format );
			$count = count( $exploded );

			switch ( $count ) {
				case 2:
					$value = number_format_i18n( $number/1000, 1 ).'K';
					break;
				case 3:
					$value = number_format_i18n( $number/1000000, 1 ).'M';
					break;
				case 4:
					$value = number_format_i18n( $number/1000000000, 1 ).'G';
					break;
				default:
					$value = $number;
			}
			return $value;
		}
}


function cam_portal_fb_opengraph() {

	if( is_single() ) {
		
		//display the first meta org image of the thumbnail
		echo '<meta property="og:image" content="'.cam_portal_get_the_post_thumbnail( 'full' ).'"/>';


		$attachments = get_attached_media( 'image' );
		foreach( $attachments as $attachment ) {
				echo '<meta property="og:image" content="'.$attachment->guid.'"/>';
		}
	?>
	<!--  Essential META Tags -->
	
	<meta property="og:title" content="<?php the_title(); ?>"/>
	<meta property="og:description" content="<?php the_excerpt(); ?>"/>
	<meta property="og:type" content="website"/>
	<meta property="og:url" content="<?php the_permalink(); ?>"/>
	<meta property="og:image:type" content="image/jpeg" />
	<meta property="og:image:alt" content="<?php the_title(); ?>" />
	
	<!--  Non-Essential, But Recommended -->
	
	<meta property="og:site_name" content="<?php bloginfo('description'); echo '-'; bloginfo('name') ?>"/>
	<meta name="twitter:image:alt" content="<?php bloginfo('description'); echo '-'; bloginfo('name') ?>">
	

	<?php
}

}
add_action('wp_head', 'cam_portal_fb_opengraph', 5);



function get_ajax_posts( $post_type = 'post', $term_id = '' ) {
    // Query Arguments
    $args = array(
		'post_type' => $post_type,
		'cat'		=> $term_id,
        'post_status' => array('publish'),
        'posts_per_page' => -1,
        'nopaging' => true,
        'order' => 'DESC',
        'orderby' => 'date'
    );

	$arr = get_posts( $args );

	$new_arr = [];
	foreach( $arr as $item ) {
		$new_arr[] = [
			'id'	=> $item->ID,
			'link' 	=> htmlspecialchars_decode($item->guid, ENT_QUOTES),
			'name' 	=> $item->post_title
		];
	}
	return $new_arr;
}

// get all posts group by term id
function get_all_posts( $term_id, $tax = 'category' ) {

	$term_id_arr[] = $term_id;
	$term_children = get_term_children( $term_id, $tax );
	foreach( $term_children as $child ) {
		$term_id_arr[] = $child;
	}

	$data = [];
	foreach ( $term_id_arr as $id ) {
		$args = array(
			'posts_per_page'    => -1,
			'offset'            => 0,
			'cat'               => $id,
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
		foreach( $posts_array as $item ) {
			$data[$id][] = [
				'id'	=> $item->ID,
				'link' 	=> htmlspecialchars_decode($item->guid, ENT_QUOTES),
				'name' 	=> $item->post_title
			];
		}

	}
	// echo '<pre>';
	// print_r($data);
	// echo '</pre>';
	return $data;
}

function template_chooser( $template ) {   
	global $wp_query; 
	
  	if( $wp_query->is_search && isset( $_GET['type'] ) && $_GET['type'] == 'category' ) {
    	return locate_template('archive.php');
	}
	if( $wp_query->is_search && isset( $_GET['post_type'] ) && $_GET['post_type'] == 'service' ) {
    	return locate_template('archive-service.php');
	}
	if( $wp_query->is_search && isset( $_GET['type'] ) && $_GET['type'] == 'organization_type' ) {
    	return locate_template('taxonomy-organization_type.php');
  	}
  	return $template;   
}
add_filter('template_include', 'template_chooser'); 

/**
 * Filter the except length to 20 words.
 *
 * @param int $length Excerpt length.
 * @return int (Maybe) modified excerpt length.
 */
function wpdocs_custom_excerpt_length( $length ) {
    return 150;
}
add_filter( 'excerpt_length', 'wpdocs_custom_excerpt_length', 999 );
