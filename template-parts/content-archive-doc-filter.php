<?php

$queried_object = get_queried_object();
$term_id = $queried_object->term_id;
$taxonomy_name = $queried_object->taxonomy;
$term_children = get_term_children( $term_id, $taxonomy_name );
$column = 12;

?>

<form class="service-filter" method="GET" action="<?php echo home_url('/'); ?>">
	<div class="form-group row mb-0">
	
	<?php 
	if ( $term_children ) { 
	?>
		<div class="col-sm-3 pr-sm-0">
			<select class="custom-select option-typeahead" id="">
				<option value="<?php echo $term_id; ?>" selected><?php echo __( 'ទាំងអស់', 'camportal' ); ?></option>
				<?php 
				foreach ( $term_children as $child ) {
					$term = get_term_by( 'id', $child, $taxonomy_name );
					echo '<option value="' . $child . '">' . $term->name . '</option>';
				}
				?>
			</select>
		</div>
	<?php $column -= 3; $pl = 'pl-sm-0'; } ?>
		<div class="<?php echo isset( $pl ) ? $pl : ''; ?> col-sm-<?php echo $column; ?>">
			<input type="hidden" class="option-typeahead" value="<?php echo $term_id; ?>" />
			<div class="relative">
				<input type="hidden" name="cat" value="<?php echo $term_id; ?>" />
				<input type="hidden" name="type" value="<?php echo $taxonomy_name; ?>" />
				<input name="s" placeholder="<?php echo __( 'ស្វែងរកតាមពាក្យ', 'cam-portal' ); ?>" type="text" id="inputTypehead" class="typeahead form-control" data-provide="typeahead" autocomplete="off" />
				<button class="btn btn-secondary" type="submit"><?php echo __( 'ស្វែងរក', 'cam-portal' ); ?></button>
			</div>
		</div>
	</div>
</form>
