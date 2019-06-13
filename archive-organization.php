<?php
get_header();
the_cam_portal_breadcrumbs();
?>

<div class="container">
    <div class="row">
        <div class="col-lg-12">
            
            <?php if ( have_posts() ) : $postCount = 0;?>
            <section class="section">
                <div class="collapsible">
                    <ul>
                    <?php
                    /* Start the Loop */
                    while ( have_posts() ) : $postCount++;
                        the_post();
                        
                        // if ( get_the_terms ( $post->ID, 'sector' ) ) {
                        //     $term_obj_list = get_the_terms ( $post->ID, 'sector' );
                        //     $terms_string = join ( ', ', wp_list_pluck ( $term_obj_list, 'name' ) );
                        //     printf( '<span class="oi oi-paperclip"></span><span>%s</span>', $terms_string );
                        // }
                                    
                        ?>
                        
                        <li>
                            <div class="collapse-title d-flex justify-content-between">
                                <div class="collapsible-action"><span class="oi <?php echo $postCount > 1 ? 'oi-chevron-right' : 'oi-chevron-bottom'; ?>"></span><span><?php the_title(); ?></span></div>
                            </div>

                            <ul>
                                <?php
                                if ( get_post_meta ( $post->ID, 'cam_portal_dept_address', true ) ) {
                                ?>
                                <li class="item-wrap"><span class="item-title primary-color"><?php echo __( 'អាសយដ្ឋាន ៖ ' ); ?></span>
                                    <ul>
                                        <li><?php echo get_post_meta ( $post->ID, 'cam_portal_dept_address', true ); ?></li>
                                    </ul>
                                </li>
                                <?php
                                }

                                if ( get_post_meta ( $post->ID, 'cam_portal_dept_address_maps', true ) ) {
                                ?>
                                <li class="item-wrap"><span class="item-title primary-color"><?php echo __( 'ទីតាំងនៅលើផែនទី ៖ ' ); ?></span>
                                    <div class="map"><?php echo get_post_meta ( $post->ID, 'cam_portal_dept_address_maps', true ); ?></div>
                                </li>
                                <?php
                                }

                                if ( count ( get_post_meta( $post->ID, 'cam_portal_dept_contact_group', true ) ) ) {
                                ?>
                                <li class="item-wrap"><span class="item-title primary-color"><?php echo __( 'ទំនាក់ទំនង ៖ '); ?></span>
                                    <ul>
                                    <?php
                                    foreach ( get_post_meta( $post->ID, 'cam_portal_dept_contact_group', true ) as $contact ) {
                                    ?>
                                        <li class="item">
                                            <div class="row">
                                                <div class="col-sm-12 col-md-6">
                                                    <div><span><?php echo $contact['contact_position']; ?></span></div>
                                                    <div><span class="oi oi-person"></span><span><?php echo $contact['contact_name']; ?></span></div>
                                                </div>
                                                <div class="col-sm-12 col-md-6">
                                                    <div><span class="oi oi-phone"></span><span><?php echo $contact['contact_number']; ?></span></div>
                                                    <div><span class="oi oi-envelope-closed"></span><span><?php echo $contact['contact_email']; ?></span></div>
                                                </div>
                                            </div>
                                        </li>
                                    <?php
                                    }
                                    ?>
                                        
                                    </ul>
                                </li>
                                <?php
                                }
                            ?>
                            </ul>
                        </li>
                    <?php
                    endwhile;
                    cam_portal_paginations();
                    ?>
                    </div>
                </ul>
            </section> 
            <?php
		endif;
		?>
		</div>
    </div><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
