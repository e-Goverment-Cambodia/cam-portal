<?php
get_header();
the_cam_portal_breadcrumbs();
?>

<div class="container">
    <div class="row">
        <div class="col-lg-12">
			<?php
			get_template_part( 'template-parts/content', 'organization-filter' );
			$args = array(
				'post_type' => 'organization',
				'orderby'	=> 'title',
				'order'		=> 'ASC',
				'paged'		=> get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1
			);
			$query = new WP_Query( $args );
			if ( $query -> have_posts() ) :?>
            <section class="section">
                <div class="collapsible">
                    <ul>
                    <?php
                    /* Start the Loop */
                    while ( $query -> have_posts() ) : 
                        $query -> the_post();
                        get_template_part( 'template-parts/content', 'organization' );
                    endwhile;
                    ?>
                    </div>
                </ul>
            </section> 
            <?php
			cam_portal_paginations();
			else :
			get_template_part( 'template-parts/content', 'none' );
			endif;
			?>
		</div>
    </div><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
