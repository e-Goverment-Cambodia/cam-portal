<?php
/**
 * Cambodia Portal functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Cambodia_Portal
 */

if ( ! function_exists( 'cam_portal_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function cam_portal_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Cambodia Portal, use a find and replace
		 * to change 'cam-portal' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'cam-portal', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 300, 200, true );
		// add_image_size( 'block-thumb', 300, 200 );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'cam-portal' ),
			'menu-2' => esc_html__( 'Top Menu', 'cam-portal' )
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );
		
		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 140,
			'width'       => 140,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'cam_portal_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function cam_portal_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'cam_portal_content_width', 640 );
}
add_action( 'after_setup_theme', 'cam_portal_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function cam_portal_widgets_init() {
	register_sidebar( array(
		'name'          => 'Sidebar',
		'id'            => 'sidebar-1',
		'description'   => 'Add widgets here.',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<div class="widget-title"><div class="block-title primary-color"><span class="primary-color font-moul">',
		'after_title'   => '</span></div></div>',
	) );
	register_sidebar( array(
		'name'          => 'Footer',
		'id'            => 'footer',
		'description'   => 'Add footer widgets here.',
		'before_widget' => '<div class="col-sm-6">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="font-moul footer-brand">',
		'after_title'   => '</h4>',
	) );
	register_sidebar( array(
	 	'name'          => 'Copyright',
	 	'id'            => 'copyright',
	 	'description'   => 'Add copyright text here.',
	 	'before_widget' => '<span class="d-inline-block">',
		'after_widget'  => '</span>',
		'before_title'  => '<h4 class="font-moul footer-brand">',
		'after_title'   => '</h4>'
	 ) );
	register_sidebar( array(
		'name'          => 'Sector & Group',
		'id'            => 'sidebar-2',
		'description'   => 'Add widgets here.',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<div class="widget-title"><div class="block-title primary-color"><span class="primary-color font-moul">',
		'after_title'   => '</span></div></div>',
	) );
	register_sidebar( array(
		'name'          => 'Sector',
		'id'            => 'sidebar-3',
		'description'   => 'Add widgets here.',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<div class="widget-title"><div class="block-title primary-color"><span class="primary-color font-moul">',
		'after_title'   => '</span></div></div>',
	) );
	register_sidebar( array(
		'name'          => 'Group',
		'id'            => 'sidebar-4',
		'description'   => 'Add widgets here.',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<div class="widget-title"><div class="block-title primary-color"><span class="primary-color font-moul">',
		'after_title'   => '</span></div></div>',
	) );
}
add_action( 'widgets_init', 'cam_portal_widgets_init' );


/**
 * Enqueue scripts and styles.
 */
require get_template_directory() . '/inc/script.php';

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

require_once get_template_directory() . '/inc/custom-post.php';

require_once get_template_directory() . '/inc/cmb2.php';

require_once get_template_directory() . '/inc/shortcode.php';

require_once get_template_directory() . '/inc/breadcrumbs.php';

require_once get_template_directory() . '/inc/services/function-post-type.php';
/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';



/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}


function wpdev_filter_login_head() {
 
    if ( has_custom_logo() ) :
 
        $image = wp_get_attachment_image_src( get_theme_mod( 'custom_logo' ), 'full' );
        ?>
        <style type="text/css">
            .login h1 a {
                background-image: url(<?php echo esc_url( $image[0] ); ?>);
                background-size: contain;
                height: 200px;
                width: 200px;
            }
        </style>
        <?php
    endif;
}
 
add_action( 'login_head', 'wpdev_filter_login_head', 100 );


//temp disable this feature
//add_filter( 'the_title', 'wpse165333_the_title', 10, 2 );
function wpse165333_the_title( $title, $post_ID = null ) {
    if ( 'nav_menu_item' == get_post_type( $post_ID ) ) {
        if ( 'taxonomy' == get_post_meta( $post_ID, '_menu_item_type', true) ) {
		if ( 'service_group' == get_post_meta( $post_ID, '_menu_item_object', true ) ) {
			$category = get_term( get_post_meta( $post_ID, '_menu_item_object_id', true ) );
			$title .= sprintf( ' (%d)', $category->count );
		}
		if ( 'sector' == get_post_meta( $post_ID, '_menu_item_object', true ) ) {  
			$args = array(
				'post_type' => 'service',
				'post_status'=>'publish',
				'tax_query' => array(
					array(
						'taxonomy' => 'sector',
						'field'    => 'slug',
						'terms'    => array( get_term( get_post_meta( $post_ID, '_menu_item_object_id', true ) )->slug ),
					)
				),
			);
			$query = new WP_Query( $args );
			$img_icon = get_term_meta ( get_term( get_post_meta( $post_ID, '_menu_item_object_id', true ) )->term_id, 'cam_portal_sector_logo', true );
			$title = sprintf( '<img height="30" src="%s"> <span> '. $title .'</span> <span>(%d)</span>', $img_icon, $query->post_count );
		}
		
        }
    }
    return $title;
}
