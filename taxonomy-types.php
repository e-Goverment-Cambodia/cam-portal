<?php
/**
 * The template for displaying taxonomy types lists
 *
 *
 * @package Cambodia_Portal
 */

get_header();
the_cam_portal_breadcrumbs()
?>
<div class="container">
    <div class="row">
        <div class="col-lg-8">
            <div class="b-3">

		        <?php if ( have_posts() ) : 

                /* Start the Loop */
                while ( have_posts() ) :
                    the_post();
                    
                    $html = '<div class="b-item-wrap">
                                <div class="b-item">
                                    <div class="b-date-wrap">
                                        <div class="b-date primary-background-color">
                                            <div class="day">%s</div>
                                            <div class="month">%s</div>
                                            <div class="year">%s</div>
                                        </div>
                                    </div>
                                    <div class="b-title-wrap">
                                        <div class="b-title"><a href="%s">%s</a></div>
                                        <div class="b-meta"><div>%s</div><div>%s</div></div>
                                    </div>
                                </div>
                            </div>';
                    printf( $html, get_the_time( 'j' ),get_the_time( 'F' ), get_the_time( 'Y' ), get_the_permalink(), mb_strimwidth( get_the_title(), 0, 100, '...' ), __( 'កែរប្រែចុងក្រោយ', 'cam-portal' ).' '.get_the_modified_date(), __( 'ចំនួនទស្សនា', 'cam-portal' ).' ('.cam_portal_get_the_posted_view_count().')' );

                endwhile;
            

			    cam_portal_paginations();
		        else :

			    get_template_part( 'template-parts/content', 'none' );

		        endif;
		        ?>

			</div><!-- #b-2 -->
		</div><!-- #col-lg-8 -->

        <?php get_sidebar(); ?>

    </div><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
