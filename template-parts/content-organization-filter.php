<?php

$term = get_query_var( 'term' ); // string current term slug
$taxonomy = 'organization_type'; // string current taxonomy slug
$term_obj = get_term_by( 'slug', $term, $taxonomy ); // current term object

$terms = get_terms( $taxonomy, array( 'hide_empty' => false ) ); // all terms array
$term_parent = []; 
$term_current = [];
$term_children = [];

// define id parent of parent
$term_parent_id = 0;
if ( !is_wp_error( $terms ) ) {
	foreach( $terms as $term ) {
		if( $term->term_id == $term_obj->parent ) {
			$term_parent_id = $term->parent;
		}
	}

	// define obj array of parent -> current -> child
	foreach( $terms as $term ) {
		if( $term->parent == $term_parent_id ) {
			$term_parent[] = $term;
		}
		if( $term->parent == $term_obj->parent ) {
			$term_current[] = $term;
		}
		if( $term->parent == $term_obj->term_id ) {
			$term_children[] = $term;
		}
	}
}

$column = 12;

?>
<form class="service-filter" method="GET" action="<?php echo home_url('/'); ?>">
	<div class="form-group row mb-0">		
	
		<!-- parent combobox if child not avaliable -->
		<?php if( count( $term_parent ) > 1 && !$term_children ) : ?>
		<div class="col-sm-3 pr-sm-0">
			<select class="custom-select option-typeahead" onchange="location = this.value;">
				<?php 
				foreach ( $term_parent as $parent ) {
					$active = ( $term_obj->parent == $parent->term_id ) ? 'selected' : '';
					$args = array(
						'posts_per_page'   	=> -1,
						'post_type'        	=> 'organization',
						'tax_query' 		=> array(
							array(
								'taxonomy' 	=> $taxonomy,
								'field' 	=> 'term_id',
								'terms' 	=> $parent->term_id
							)
						)
					);
					$count = count( get_posts( $args ) );
					//wp_reset_postdata();
					echo '<option '. $active .' value="' . get_term_link( $parent->term_id, $taxonomy ) . '">' . $parent->name . ' ('. $count .')</option>';
				}
				?>
			</select>
		</div>
		<?php $column -= 3; $child_pl = 'pl-sm-0'; endif; ?>
		
		
		<!-- sibling combobox if avaliable -->
		<?php if( count( $term_current ) > 1 && $term_obj->parent ) : ?>
		<div class="col-sm-3 pr-sm-0 <?php echo isset( $child_pl ) ? $child_pl : ''; ?>">
			<select class="custom-select option-typeahead" onchange="location = this.value;">
				<?php
				foreach ( $term_current as $sibling ) { 
					$active = ( $term_obj->term_id == $sibling->term_id ) ? 'selected' : '';
					$args = array(
						'posts_per_page'   	=> -1,
						'post_type'        	=> 'organization',
						'tax_query' 		=> array(
							array(
								'taxonomy' 	=> $taxonomy,
								'field' 	=> 'term_id',
								'terms' 	=> $sibling->term_id
							)
						)
					);
					$count = count( get_posts( $args ) );
					//wp_reset_postdata();
					echo '<option '. $active .' value="' . get_term_link( $sibling->term_id, $taxonomy ) . '"> ' . $sibling->name . ' ('. $count .')</option>';
				}
				?>
			</select>
		</div>
		<?php $column -= 3; $child_pl = 'pl-sm-0'; endif; ?>
	
	
		<!-- child combobox if avaliable -->
		<?php if ( count( $term_children ) > 1 ) : ?>
		<div class="col-sm-3 pr-sm-0 <?php echo isset( $child_pl ) ? $child_pl : ''; ?>">
			
			<select class="custom-select option-typeahead" onchange="location = this.value;">
				<option value="#" selected><?php echo __( 'សូមជ្រើសរើស', 'camportal' ); ?></option>
				<?php 
				foreach ( $term_children as $child ) {
					$args = array(
						'posts_per_page'   	=> -1,
						'post_type'        	=> 'organization',
						'tax_query' 		=> array(
							array(
								'taxonomy' 	=> $taxonomy,
								'field' 	=> 'term_id',
								'terms' 	=> $child->term_id
							)
						)
					);
					$count = count( get_posts( $args ) );
					//wp_reset_postdata();
					echo '<option value="' . get_term_link( $child->term_id, $taxonomy ) . '">' . $child->name . ' ('. $count .')</option>';
				}
				?>
			</select>
		</div>
		<?php $column -= 3; $child_pl = 'pl-sm-0'; endif; ?>
	
	
		<!-- search textbox -->
		<div class="<?php echo isset( $child_pl ) ? $child_pl : ''; ?> col-sm-<?php echo $column;?>">
			<input type="hidden" class="option-typeahead" value="<?php echo $term_obj->term_id; ?>" />
			<input type="hidden" name="term" value="<?php echo get_query_var( 'term' ); ?>" />
			<input type="hidden" name="type" value="organization_type" />
			<input type="hidden" name="post_type" value="organization" />
			
			<div class="relative">
				<input name="s" value="<?php echo get_search_query(); ?>" placeholder="<?php echo __( 'ស្វែងរកតាមពាក្យ', 'cam-portal' ); ?>" type="text" class="form-control" autocomplete="off" />
				<button class="btn btn-secondary" type="submit"><?php echo __( 'ស្វែងរក', 'cam-portal' ); ?></button>
			</div>
		</div>
	</div>
</form>