<?php

function blog_function_shortcode( $atts , $content = null ) {
	ob_start();
	// The default attributes
	$a = shortcode_atts(
		array(
            'template'          => 'list', // or grid : get template part
            'post_type'         => 'post',
            'taxonomy'          => 'category',
            'terms'             => '', // default all 
            'field'             => 'slug',
            'posts_per_page'	=> '4',
            'post_view_count'   => true,
            'title_length'      => 75,
            'excerpt'           => true,
            'excerpt_length'    => 100,
            'date'              => true,
			'author'            => true,
			'blog_title'		=> '',
			'blog_title_terms'	=> '', // id or slug
			'blog_title_taxonomy' => 'category',
			'orderby'			=> 'date',
			'order'   			=> 'DESC',
			'column'			=> 4
		),
		$atts
	);

	if( $a['blog_title'] ){
		$arr = [
			'terms'		=> $a['blog_title_terms'], 
			'taxonomy'	=> $a['blog_title_taxonomy'],
			'title'		=> $a['blog_title']
		];
		
		the_blog_title( $arr );
		
	}	

	// WP_Query arguments
	$args = array(
		'post_type'				=> $a['post_type'],
		'post_status'			=> array( 'publish' ),
		'posts_per_page'		=> $a['posts_per_page'],
		'orderby'				=> $a['orderby'],
		'order'					=> $a['order'],
		'tax_query'             => array(
			array(
				'taxonomy'	=> $a['taxonomy'],
				'terms'		=> $a['terms'],
				'field'		=> $a['field'],
			),
		),
	);
	
	// The Query
	$query = new WP_Query( $args );
	// The Loop
	if ( $query->have_posts() ) :
		set_query_var( 'a', $a );
		if( $a['template'] == 'grid' ) : ?>
		<div class="row b-1">
			<?php 
			while ( $query->have_posts() ) :
				$query->the_post();
				get_template_part( 'inc/shortcode/template-parts/content', 'grid' );
			?>
			<?php		
			endwhile;
			?>
		</div>
		<?php 
		endif; 
		if( $a['template'] == 'list' ) : ?>
		<div class="b-2">
			<?php 
			while ( $query->have_posts() ) :
				$query->the_post();
				get_template_part( 'inc/shortcode/template-parts/content', 'list' );
			?>
			<?php		
			endwhile;
			?>
		</div>
		<?php 
		endif; 
	endif;
    


	// Restore original Post Data
	wp_reset_postdata();
	// Return code
	return ob_get_clean();
}
add_shortcode( 'blog', 'blog_function_shortcode' );

// [blog blog_title="" blog_title_terms="" blog_title_taxonomy="category" blog_title_field="slug" template="list" post_type="post" taxonomy="category" terms="" field="slug" posts_per_page=4 excerpt=false date=true post_view_count=true author=true title_length=75 excerpt_length=100]