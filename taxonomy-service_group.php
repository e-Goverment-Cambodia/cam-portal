<?php
get_header();
the_cam_portal_breadcrumbs();
?>

<div class="container">
        <div class="row">
                <div class="col-lg-8">
                        <div class="b-2">

		        <?php if ( have_posts() ) : ?>

			<?php
			/* Start the Loop */
			while ( have_posts() ) :
                                the_post();
                        ?>
                                <div class="b-item-wrap">
                                        <div class="b-item">
                                                <div class="b-title-wrap">
                                                        <div class="b-title margin-bottom-15"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
                                                        <div class="b-cat">
                                                        <?php 
                                                        if ( get_the_terms ( $post->ID, 'sector' ) ) {
                                                                $term_obj_list = get_the_terms ( $post->ID, 'sector' );
                                                                $terms_string = join ( ', ', wp_list_pluck ( $term_obj_list, 'name' ) );
                                                                printf( '<span class="oi oi-paperclip"></span><span>%s</span>', $terms_string );
                                                        }
                                                        ?>
                                                                <?php if ( get_post_meta( $post->ID, 'cam_portal_service_form', true ) ) { ?>
                                                                        <a href="<?php echo get_post_meta( $post->ID, 'cam_portal_service_form', true ); ?>"><span class="oi oi-cloud-download"></span><?php echo __( 'ទម្រង់បែបបទ' ); ?></a>
                                                                <?php } ?>
                                                                <?php if ( get_post_meta( $post->ID, 'cam_portal_service_pro_form', true ) ) { ?>
                                                                        <a href="<?php echo get_post_meta( $post->ID, 'cam_portal_service_pro_form', true ); ?>"><span class="oi oi-eye"></span><?php echo __( 'និតិវិធី' ); ?></a>
                                                                <?php } ?>
                                                                
                                                        </div>
                                                </div>
                                        </div>
                                </div>
                        <?php

			endwhile;
			cam_portal_paginations();

		endif;
		?>

			</div>
		</div>
			
                <div class="col-lg-4 widget-area">
                        <?php dynamic_sidebar( 'sidebar-4' ); ?>
                </div>
        </div><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
