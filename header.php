<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Cambodia_Portal
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=0, shrink-to-fit=yes">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<link rel="icon" type="image/png" href="asset/img/logo-16x16.png" sizes="16x16" />
	<link rel="icon" type="image/png" href="asset/img/logo-32x32.png" sizes="32x32" />
	<link rel="icon" type="image/png" href="asset/img/logo-96x96.png" sizes="96x96" />
	<?php wp_head(); ?>
	<style>
			.primary-color, .short-link li a, .tab-collapse > li.active > a::before, .pagination a, .breadcrum a, .category a { color: <?php echo get_theme_mod( 'theme_color_setting' ); ?>; }
			.primary-background-color, .lg-main-nav ul ul, .tab-collapse > li.active > a, .pagination ul li.active span, .nav-sidebar-2 ul li.active, .nav-sidebar-3 ul li.active, .languages ul li.active { background-color: <?php echo get_theme_mod( 'theme_color_setting' ); ?>; }
			.fill { fill: <?php echo get_theme_mod( 'theme_color_setting' ); ?>; }
			.non-responsive .container, .non-responsive .wrapper { min-width: 1024px; }
	</style>
</head>

<body <?php body_class(); ?>>
	<div id="page" class="site wrapper">
		<?php
			$custom_logo_id = get_theme_mod( 'custom_logo' );
			$image = wp_get_attachment_image_src( $custom_logo_id , 'full' );
		?>
		<!-- display for mobile menu in left sidebar -->
		<div class="nav-sidebar d-md-block d-lg-none primary-background-color">
				<div class="nav-sidebar-header">
					
					<!-- Cambodia sign -->
					<img class="khmer-logo" src="<?php header_image(); ?>" />
					<h1 class="font-moul khmer-title primary-color">ព្រះរាជាណាចក្រកម្ពុជា <br/>ជាតិសាសនាព្រះមហាក្សត្រ</h1>
					
					<!-- search form -->
					<form class="form-inline">
						<div class="input-group mb-3">
							<div class="input-group-prepend primary-background-color">
								<button class="btn btn-outline" type="submit" id="button-addon1"><span class="oi oi-magnifying-glass"></span></button>
							</div>
							<input type="text" class="form-control" placeholder="ស្វែងរក" aria-label="Example text with button addon" aria-describedby="button-addon1">
						</div>
					</form>	
					<div class="languages d-block text-center">
						<ul>
							<li class="active"><a href="#">ខ្មែរ</a></li>
							<li><a href="#">Eng</a></li>
						</ul>
					</div>
					
					<!-- top menu bar -->
					<?php
						wp_nav_menu( array(
							'theme_location' => 'menu-2',
							'menu_id'        => 'primary-menu',
							'container'		 => 'nav',
							'container_class' => 'short-link'
						) );
					?>
				</div>
				
				<!-- main navigation -->
				<?php
					wp_nav_menu( array(
						'theme_location' => 'menu-1',
						'menu_id'        => 'primary-menu',
						'container'		 => 'nav',
						'container_class' => 'sm-navbar'
					) );
				?>
			</div>
			
			<!-- this content contain all container -->
			<div class="content">
			
				<!-- small screen header in responsive mode -->
				<div class="sm-header d-md-block d-lg-none">
					<div class="nav-button inline-block vertical-align-middle">
						<span class="oi oi-menu nav-icon primary-color"></span>
					</div>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="sm-logo inline-block vertical-align-middle">
						<img src="<?php echo $image[0]; ?>" />
					</a>
					<div class="sm-title text-center inline-block vertical-align-middle primary-color">
						<h1 class="font-moul"><?php bloginfo( 'name' ); ?></h1>
						<?php $cam_portal_description = get_bloginfo( 'description', 'display' );
						if ( $cam_portal_description || is_customize_preview() ) : ?>
							<span><?php echo $cam_portal_description; /* WPCS: xss ok. */ ?></span>
						<?php endif; ?>
					</div>
				</div>
				
				<!-- desktop header -->
				<div class="lg-header d-none d-lg-block">
					
					<!-- contain Cambodia sign and logo site title -->
					<div class="container">
						<div class="row">
							
							<!-- logo and site title -->
							<div class="col-6 logo-wrap">
								<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="lg-logo inline-block vertical-align-middle">
									<img src="<?php echo $image[0]; ?>" />
								</a>
								<div class="lg-title text-center inline-block vertical-align-middle primary-color">
									<h1 class="font-moul"><?php bloginfo( 'name' ); ?></h1>
									<?php $cam_portal_description = get_bloginfo( 'description', 'display' );
									if ( $cam_portal_description || is_customize_preview() ) : ?>
										<span><?php echo $cam_portal_description; /* WPCS: xss ok. */ ?></span>
									<?php endif; ?>
								</div>
							</div>
							
							<!-- Cambodia sign -->
							<div class="col-6 logo-wrap text-right">
								
								<!-- logo and title -->
								<?php
									if ( function_exists( 'pll_register_string' ) ) :
										echo '<h1 class="font-moul khmer-title primary-color inline-block">';
										echo pll__(get_theme_mod('header_text'));
										echo '</h1>';
									else:
										echo '<h1 class="font-moul khmer-title primary-color inline-block">';
										echo __(get_theme_mod('header_text'));
										echo '</h1>';	
									endif;
								?>
								<img class="khmer-logo inline-block" src="<?php header_image(); ?>" />
								<br/>
								
								<!-- search form -->
								<form class="form-inline inline-block">
									<div class="input-group input-group-sm mb-2">
										<div class="input-group-prepend primary-background-color">
											<button class="btn btn-outline" type="submit" id="button-addon1"><span class="oi oi-magnifying-glass"></span></button>
										</div>
										<input type="text" class="form-control" placeholder="ស្វែងរក" aria-label="Example text with button addon" aria-describedby="button-addon1">
									</div>
								</form>
								<div class="languages d-inline-block">
									<ul>
									<?php if (function_exists('pll_the_languages')){
										pll_the_languages();
									}else{
										
										echo '<li class="active"><a href="#">ខ្មែរ</a></li>
										<li><a href="#">Eng</a></li>';
									}
									?>
									</ul>
								</div>
								
								<!-- top menu -->
								<?php
									wp_nav_menu( array(
										'theme_location' => 'menu-2',
										'menu_id'        => 'primary-menu',
										'container'		 => 'nav',
										'container_class' => 'short-link'
									) );
								?>
							</div>
						</div>
					</div>
					
					<!-- main navigation -->
					<div class="primary-background-color">	
						<div class="container">
							<div class="row">
							<?php
								wp_nav_menu( array(
									'theme_location' => 'menu-1',
									'menu_id'        => 'primary-menu',
									'container'		 => 'nav',
									'container_class' => 'lg-main-nav'
								) );
							?>
							</div>
						</div>
					</div>
				</div>

	<div id="content" class="site-content">
