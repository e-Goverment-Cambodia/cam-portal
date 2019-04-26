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


function my_register_menu_metabox() {
	$custom_param = array( 0 => 'This param will be passed to my_render_menu_metabox' );
	
	add_meta_box( 'my-menu-test-metabox', 'Test Menu Metabox', 'my_render_menu_metabox', 'nav-menus', 'side', 'default', $custom_param );
}
add_action( 'admin_head-nav-menus.php', 'my_register_menu_metabox' );
/**
 * Displays a menu metabox 
 *
 * @param string $object Not used.
 * @param array $args Parameters and arguments. If you passed custom params to add_meta_box(), 
 * they will be in $args['args']
 */
function my_render_menu_metabox( $object, $args ) {
	global $nav_menu_selected_id;
	// Create an array of objects that imitate Post objects
	$my_items = array(
		(object) array(
			'ID' => 1,
			'db_id' => 0,
			'menu_item_parent' => 0,
			'object_id' => 1,
			'post_parent' => 0,
			'type' => 'my-custom-type',
			'object' => 'my-object-slug',
			'type_label' => 'My Cool Plugin',
			'title' => 'Custom Link 1',
			'url' => home_url( '/custom-link-1/' ),
			'target' => '',
			'attr_title' => '',
			'description' => '',
			'classes' => array(),
			'xfn' => '',
		),
		(object) array(
			'ID' => 2,
			'db_id' => 0,
			'menu_item_parent' => 0,
			'object_id' => 2,
			'post_parent' => 0,
			'type' => 'my-custom-type',
			'object' => 'my-object-slug',
			'type_label' => 'My Cool Plugin',
			'title' => 'Custom Link 2',
			'url' => home_url( '/custom-link-2/' ),
			'target' => '',
			'attr_title' => '',
			'description' => '',
			'classes' => array(),
			'xfn' => '',
		),
		(object) array(
			'ID' => 3,
			'db_id' => 0,
			'menu_item_parent' => 0,
			'object_id' => 3,
			'post_parent' => 0,
			'type' => 'my-custom-type',
			'object' => 'my-object-slug',
			'type_label' => 'My Cool Plugin',
			'title' => 'Custom Link 3',
			'url' => home_url( '/custom-link-3/' ),
			'target' => '',
			'attr_title' => '',
			'description' => '',
			'classes' => array(),
			'xfn' => '',
		),
	);
	$db_fields = false;
	// If your links will be hieararchical, adjust the $db_fields array bellow
	if ( false ) {
		$db_fields = array( 'parent' => 'parent', 'id' => 'post_parent' );
	}
	$walker = new Walker_Nav_Menu_Checklist( $db_fields );
	$removed_args = array(
		'action',
		'customlink-tab',
		'edit-menu-item',
		'menu-item',
		'page-tab',
		'_wpnonce',
	); ?>
	<div id="my-plugin-div">
		<div id="tabs-panel-my-plugin-all" class="tabs-panel tabs-panel-active">
		<ul id="my-plugin-checklist-pop" class="categorychecklist form-no-clear" >
			<?php echo walk_nav_menu_tree( array_map( 'wp_setup_nav_menu_item', $my_items ), 0, (object) array( 'walker' => $walker ) ); ?>
		</ul>

		<p class="button-controls">
			<span class="list-controls">
				<a href="<?php
					echo esc_url(add_query_arg(
						array(
							'my-plugin-all' => 'all',
							'selectall' => 1,
						),
						remove_query_arg( $removed_args )
					));
				?>#my-menu-test-metabox" class="select-all"><?php _e( 'Select All' ); ?></a>
			</span>

			<span class="add-to-menu">
				<input type="submit"<?php wp_nav_menu_disabled_check( $nav_menu_selected_id ); ?> class="button-secondary submit-add-to-menu right" value="<?php esc_attr_e( 'Add to Menu' ); ?>" name="add-my-plugin-menu-item" id="submit-my-plugin-div" />
				<span class="spinner"></span>
			</span>
		</p>
	</div>
	<?php
}
