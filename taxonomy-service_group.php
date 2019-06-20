<?php
get_header();
the_cam_portal_breadcrumbs();
?>

<div class="container">
        <div class="row">
                <div class="col-lg-12">
                        
                        <div class="form-group row service-filter">
                                  
                                <label for="exampleFormControlSelect" class="col-md-2 col-form-label"><?php echo __( 'ទម្រង់ស្វែងរក' , 'cam-portal' )?></label>
                                <div class="col-md-5">
                                        <select class="form-control selection-option" id="exampleFormControlSelect">
                                                <option value="0"><?php echo __( 'ស្វែងរកតាមវិស័យ' , 'cam-portal' )?></option>
                                                <option selected value="1"><?php echo __( 'ស្វែងរកតាមក្រុម' , 'cam-portal' )?></option>
                                                <option value="2"><?php echo __( 'ស្វែងរកតាមពាក្យ' , 'cam-portal' )?></option>
                                        </select>
                                </div>
                                <div class="selection-option-item option-0 hide col-md-5">      
                                        
                                        <select class="form-control" id="exampleFormControlSelect1" onchange="location = this.value;">
                                                <option value="#"><?php echo __( 'សូមជ្រើសរើសវិស័យ' , 'cam-portal' )?></option>
                                        
                                        <?php 
                                        $terms = get_terms( array(
                                                'taxonomy' => 'sector',
                                                'hide_empty' => false,
                                        ) );
                                        
                                        $queried_object = get_queried_object();
                                        
                                        
                                        foreach ( $terms as $term ) {

                                                $args = array(
                                                        'post_type' => 'service',
                                                        'post_status'=>'publish',
                                                        'tax_query' => array(
                                                                array(
                                                                        'taxonomy' => 'sector',
                                                                        'field'    => 'slug',
                                                                        'terms'    => array( $term->slug ),
                                                                )
                                                        ),
                                                );
                                                $query = new WP_Query( $args );
                                                
                                                if ( function_exists( 'pll_home_url' ) ) {
                                                        $home_url = pll_home_url().'sector/'.$term->slug;
                                                }else{
                                                        $home_url = esc_url( home_url( 'sector/'.$term->slug ) );
                                                }
                                                
                                                $active = ( $queried_object->slug == $term->slug ) ? "selected" : "";

                                                echo '<option ' . $active . ' value=" ' . $home_url . ' ">' . $term->name . ' ('. $query->post_count .')</option>';
                                        }
                                        
                                        
                                        ?>
                                        
                                        
                                        
                                                
                                        </select>
                                        
                                </div>
                                
                                <div class="selection-option-item option-1 show col-md-5">
                                        <select class="form-control" id="exampleFormControlSelect2" onchange="location = this.value;">
                                                <option value="#"><?php echo __( 'សូមជ្រើសរើសក្រុម' , 'cam-portal' )?></option>
                                        <?php 
                                        $terms = get_terms( array(
                                                'taxonomy' => 'service_group',
                                                'hide_empty' => false,
                                        ) );

                                        foreach ( $terms as $term ) {


                                                $args = array(
                                                        'post_type' => 'service',
                                                        'post_status'=>'publish',
                                                        'tax_query' => array(
                                                                array(
                                                                        'taxonomy' => 'service_group',
                                                                        'field'    => 'slug',
                                                                        'terms'    => array( $term->slug ),
                                                                )
                                                        ),
                                                );
                                                
                                                $query = new WP_Query( $args );
                                                
                                                if ( function_exists( 'pll_home_url' ) ) {
                                                        $home_url = pll_home_url().'service_group/'.$term->slug;
                                                }else{
                                                        $home_url = esc_url( home_url( 'service_group/'.$term->slug ) );
                                                }

                                                $active = ( $queried_object->slug == $term->slug ) ? "selected" : "";

                                                echo '<option ' . $active . ' value=" ' . $home_url . ' ">' . $term->name . ' ('. $query->post_count .')</option>';
                                        }
                                        
                                        
                                        ?>
                                        </select>
                                </div>
                                <div class="selection-option-item option-2 hide col-md-5">
                                        <div style="position:relative;" class="">
                                                <input placeholder="<?php echo __( 'សូមវាយឈ្មោះសេវាដែលអ្នកត្រូវការស្វែងរក', 'cam-portal' ); ?>" type="text" class="typeahead form-control" id="exampleFormControlSelect3" data-provide="typeahead" autocomplete="off" />
                                        </div>
                                </div>
                        </div>
                        
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
                                                        <div class="b-title margin-bottom-15"><a href="<?php echo get_the_permalink().'?widget=group'; ?>"><span style="color: #ccc;font-size: 14px;" class="oi oi-chevron-right"></span> <?php the_title(); ?></a></div>
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
                        <?php //dynamic_sidebar( 'sidebar-4' ); ?>
                </div>
        </div><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
