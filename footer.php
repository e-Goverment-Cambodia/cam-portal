<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Cambodia_Portal
 */

?>
		
		<footer class="footer primary-background-color">
			<div class="container">
				<div class="row">
					<?php dynamic_sidebar( 'footer' ); ?>
				</div>
			</div>
			<div class="copy-right"><span class="d-inline-block">© <?php echo date('Y');?></span> <?php dynamic_sidebar( 'copyright' ); ?> <div><span><?php echo __( 'កែប្រែចុងក្រោយ : ' , 'cam-portal' ); cam_portal_last_modified_date(); ?></span></div></div>
		</footer>
		<!-- responsive switcher -->
		<div class="container text-center switch">
			<div class="btn-group btn-group-toggle" data-toggle="buttons">
				<!-- if set default mode from option to mobile -->
				<label class="btn btn-secondary btn-sm active" id="mobile-mode">
					<input type="radio" name="options" autocomplete="off"><span class="oi oi-phone"></span> <?php echo __( 'ទម្រង់ទូរស័ព្ទ', 'cam-portal' ); ?>
				</label>
				<label class="btn btn-secondary btn-sm" id="desktop-mode">
					<input type="radio" name="options" autocomplete="off"><span class="oi oi-monitor"></span> <?php echo __( 'ទម្រង់កុំព្យូទ័រ', 'cam-portal' ); ?>
				</label>
			</div>
		</div>
	</div><!-- close content -->
</div><!-- close wrap -->

<?php 
wp_footer(); 
cam_portal_the_typeahead();
?>
</body>
</html>
