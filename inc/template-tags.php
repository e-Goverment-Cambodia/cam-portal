<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Cambodia_Portal
 */

if ( ! function_exists( 'cam_portal_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function cam_portal_posted_on() {

		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() )
		);

		$posted_on = sprintf(
			/* translators: %s: post date. */
			esc_html_x( '%s', 'post date', 'cam-portal' ), $time_string 
		);

		echo '<span class="mr-2">' . $posted_on . '</span>'; // WPCS: XSS OK.

	}
endif;

if ( ! function_exists( 'cam_portal_posted_by' ) ) :
	
	function cam_portal_posted_by() {

		$html = '<span class="mr-2">%s <a href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>';
		printf( $html, __( 'ដោយ', 'cam-portal' ) );

	}
endif;

if ( ! function_exists( 'cam_portal_the_posted_view_count' ) ) :
	function cam_portal_the_posted_view_count() {
		$html = '<span class="mr-2">%s ('. cam_portal_get_the_posted_view_count().')</span>';
		printf( $html, __( 'ចំនួនទស្សនា', 'cam-portal' ) );
	}
endif;

if ( ! function_exists( 'cam_portal_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function cam_portal_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ', ', 'cam-portal' ) );
			if ( $categories_list ) {
				/* translators: 1: list of categories. */
				printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'cam-portal' ) . '</span>', $categories_list ); // WPCS: XSS OK.
			}

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'cam-portal' ) );
			if ( $tags_list ) {
				/* translators: 1: list of tags. */
				printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'cam-portal' ) . '</span>', $tags_list ); // WPCS: XSS OK.
			}
		}

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link(
				sprintf(
					wp_kses(
						/* translators: %s: post title */
						__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'cam-portal' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				)
			);
			echo '</span>';
		}

		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Edit <span class="screen-reader-text">%s</span>', 'cam-portal' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
endif;

if ( ! function_exists( 'cam_portal_post_thumbnail' ) ) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function cam_portal_post_thumbnail() {
		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}

		if ( is_singular() ) :
			?>

			<div class="post-thumbnail">
				<?php the_post_thumbnail(); ?>
			</div><!-- .post-thumbnail -->

		<?php else : ?>

		<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
			<?php
			the_post_thumbnail( 'post-thumbnail', array(
				'alt' => the_title_attribute( array(
					'echo' => false,
				) ),
			) );
			?>
		</a>

		<?php
		endif; // End is_singular().
	}
endif;


if ( ! function_exists( 'the_cam_portal_breadcrumbs' ) ) :
	function the_cam_portal_breadcrumbs(){
		echo '<div class="container">
				<div class="breadcrum">
					<ul>';
					if(function_exists('cam_portal_breadcrumbs')): 
						echo cam_portal_breadcrumbs();
					endif;
		echo '</ul></div></div>';
	}
endif;

if( !function_exists( 'cam_portal_the_post_thumbnail' ) ) {
	
	function cam_portal_the_post_thumbnail( $size = 'post-thumbnail' ) {
		echo '<img src="'.cam_portal_get_the_post_thumbnail( $size ).'">';
	}
}

if ( !function_exists( 'cam_portal_the_last_modified_date' ) ) {
	
	function cam_portal_last_modified_date(){
		$args = array(
					'numberposts' => 1,
					'orderby' => 'modified',
					'order' => 'DESC',
					'post_type' => array( 'post', 'page', 'section_data' ),
					'post_status' => 'publish'
				);
		$arrs = wp_get_recent_posts( $args );
		foreach ( $arrs as $arr ){
			printf( __( '%sមុន ', 'cam-portal' ), human_time_diff( strtotime( $arr['post_modified'] ), current_time('timestamp') ) );
		}
	}
}
if ( ! function_exists( 'cam_portal_paginations' ) ) :
	/**
	 * Displays an optional post paginations.
	 *
	 * Wraps the post paginations in an anchor element on index views, or a div
	 */

	function cam_portal_paginations(){
		the_posts_pagination( array( 
			'prev_text'	=> '<span class="oi oi-media-skip-backward"></span>',
			'next_text'	=>	'<span class="oi oi-media-skip-forward"></span>',
			'mid_size' 	=> 2,
			'type'	  	=> 'list'
			) );
	}
endif;


if( !function_exists( 'cam_portal_the_related_post' ) ) {
	function cam_portal_the_related_post() {
		?>
		<div class="block-30"></div>
		<div class="block-title primary-color">
			<span class="primary-color font-moul"><?php echo __( 'ព័ត៌មានជាប់ទាក់ទង', 'cam-portal' ); ?></span>
		</div>
		<div class="b-1 row slick-slideshow-responsive">	
		<?php
		
		$html = '<div class="b-item-wrap col-lg-4">
					<div class="b-item">
						<div class="b-thumnail"><img src="%s" /></div>
						<div class="b-title"><a href="%s">%s</a></div>
						<div class="b-date">%s</div>
					</div>
				</div>';
		foreach( cam_portal_get_the_related_post() as $arr ){
			printf( $html, $arr['post_thumbnail'], $arr['permalink'],  mb_strimwidth( $arr['title'], 0, 85, '...' ),  $arr['date'] );
		}

		?>
		</div><!-- close b-1 -->
		<?php
	}
}

if( !function_exists( 'cam_portal_the_pdf_items' ) ) {
	function cam_portal_the_pdf_items() {
		$items = get_post_meta( get_the_ID(), 'cam_group_pdf_items', true );
		if( is_array( $items ) )
		foreach( $items as $item ){
			echo '<iframe src="https://docs.google.com/gview?url='.$item['pdf_url'].'&embedded=true" style="width:100%; height:1000px;" frameborder="0"></iframe>';
		}
	}
}

if( !function_exists( 'cam_portal_the_facebook_video' ) ) {
	function cam_portal_the_facebook_video() {
		$items = get_post_meta( get_the_ID(), 'facebook_video_url', true );
		if( $items ) {
			$iframe = '<iframe class="w-100"  src="https://www.facebook.com/plugins/video.php?href=%s&show_text=0&width=267" width="600" height="400" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allowFullScreen="true"></iframe>';
			foreach( $items as $item ) {
				printf( $iframe, $item );
			}
		}
	}
	
}

if( !function_exists( 'cam_portal_the_facebook_share') ) {
	function cam_portal_the_facebook_share() {
		$html = '<span class="mr-2">
					<div id="fb-root"></div>
					<script>
						(function(d, s, id) {
							var js, fjs = d.getElementsByTagName(s)[0];
							if (d.getElementById(id)) return;
							js = d.createElement(s); js.id = id;
							js.src = "https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.2&appId=381409555706841&autoLogAppEvents=1";
							fjs.parentNode.insertBefore(js, fjs);
						}(document, "script", "facebook-jssdk"));
					</script>
					<div class="fb-share-button" data-href="'.get_the_permalink().'" data-layout="button_count" data-size="large" data-mobile-iframe="true"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Share</a></div>
				</span>';
		echo( $html );
	}
}

if ( !function_exists( 'cam_portal_the_typeahead' ) ) {
	function cam_portal_the_typeahead () {
		if ( is_post_type_archive( 'service' ) || is_tax( array('sector', 'service_group' ) ) || is_singular( 'service' ) ) {

			$data = get_transient( 'all_services_'.get_locale() ) ;

			if ( $data === false ) {
				$data = json_encode( get_ajax_posts('service') );
				set_transient( 'all_services_'.get_locale(), $data, '360' );
			}
			$script = '
						<script type="text/javascript">
						jQuery(".typeahead").typeahead({
							source: '.$data.',
							autoSelect: false,
							afterSelect: function(item){location = item.link;}
						});
						
						</script>
			';

			echo $script;
		}
	}
}