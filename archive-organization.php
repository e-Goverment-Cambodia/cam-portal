<?php
get_header();
the_cam_portal_breadcrumbs();
?>

<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <?php
			
				$taxonomy_name = 'organization_type';
				if( is_archive() ){
					$terms = get_terms( array(
						'taxonomy' => 'organization_type',
						'hide_empty' => false,
					) );
					$term_children = [];
					foreach( $terms as $child ) {
						if( !$child->parent ) {
							$term_children[] = $child->term_id;
						}
					}
				}
            ?>
            <form class="service-filter" method="GET" action="<?php echo home_url('/'); ?>">
				<div class="form-group row mb-0">
				<?php if ( isset( $term_children ) ) : ?>
					<div class="col-sm-3 pr-sm-0">
						
						<select class="custom-select option-typeahead" onchange="location = this.value;">
							<option value="#" selected><?php echo __( 'ទាំងអស់', 'camportal' ); ?></option>
							<?php 
							foreach ( $term_children as $child ) {
								$term = get_term_by( 'id', $child, $taxonomy_name );
								echo '<option value="' . get_term_link( $child, $taxonomy_name ) . '">' . $term->name . ' ('. $term->count .')</option>';
                            }
							?>
						</select>
					</div>
				
					<div class="col-sm-9 pl-sm-0">
				<?php else : ?>
					<div class="col-sm-12">
					<input type="hidden" class="option-typeahead" value="<?php echo $term_id; ?>" />
				<?php endif; ?>
						<div class="relative">
                            <input type="hidden" name="type" value="organization_type" />
							<!--input type="hidden" name="taxonomy" value="organization_type" /-->
                            <!--input type="hidden" name="tag_id" value="<?php //echo $term_id; ?>" /-->
                            <input type="hidden" name="post_type" value="organization" />
							<input name="s" placeholder="<?php echo __( 'ស្វែងរកតាមពាក្យ', 'cam-portal' ); ?>" type="text" id="inputTypehead" class="typeahead form-control" data-provide="typeahead" autocomplete="off" />
							<button class="btn btn-secondary" type="submit"><?php echo __( 'ស្វែងរក', 'cam-portal' ); ?></button>
						</div>
					</div>
				</div>
			</form>
            <?php if ( have_posts() ) :?>
            <section class="section">
                <div class="collapsible">
                    <ul>
                    <?php
                    /* Start the Loop */
                    while ( have_posts() ) : 
                        the_post();
                        get_template_part( 'template-parts/content', 'organization' );
                    endwhile;
                    ?>
                    </div>
                </ul>
            </section> 
            <?php
			cam_portal_paginations();
		endif;
		?>
		</div>
    </div><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
