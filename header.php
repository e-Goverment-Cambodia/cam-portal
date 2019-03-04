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
<html class="responsive" <?php //language_attributes(); ?>>
<head>
	<!-- Required meta tags -->
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<!-- initial-scale=1 : responsive default -->
	<meta id="viewport" name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=yes">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<!-- icon -->
	<link rel="icon" type="image/png" href="asset/img/logo-16x16.png" sizes="16x16" />
	<link rel="icon" type="image/png" href="asset/img/logo-32x32.png" sizes="32x32" />
	<link rel="icon" type="image/png" href="asset/img/logo-96x96.png" sizes="96x96" />
	<?php wp_head(); 
	$theme_color = get_theme_mod('theme_color_setting', '#4bc598');
	?>
	<style>
			a, a:hover, .primary-color, .short-link li a, .tab-collapse > li.active > a::before, .pagination a, .breadcrum a, .category a { color: <?php echo $theme_color; ?>; }
			.primary-background-color, .lg-main-nav ul ul, .pagination ul li span.current, .nav-sidebar-2 ul li.active, .nav-sidebar-3 ul li.active, .languages ul li.current-lang { background-color: <?php echo $theme_color; ?>; }
			.fill { fill: <?php echo $theme_color; ?>; }
			.non-responsive .container, .non-responsive .wrapper { min-width: 1024px; }
	</style>
</head>

<body>
	<div id="page" class="site wrapper">
		<?php
			$custom_logo_id = get_theme_mod( 'custom_logo' );
			$image = wp_get_attachment_image_src( $custom_logo_id , 'full' );
		?>
		<!-- display for mobile menu in left sidebar -->
		<div class="nav-sidebar d-md-block d-lg-none primary-background-color">
				<div class="nav-sidebar-header">
					
					<!-- Cambodia sign -->
					<object class="khmer-logo" class="d-inline-block" type="image/svg+xml" data="<?php echo get_template_directory_uri() . '/asset/img/Royal_Cambodia.svg'; ?>" width="" height=""></object>
					<h1 class="font-moul khmer-title primary-color">
					<?php get_template_part('template-parts/header/header', 'text'); ?>
					</h1>
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
							<?php if (function_exists('pll_the_languages')){
									pll_the_languages();
								}else{
									
									echo '<li class="active"><a href="#">ភាសាខ្មែរ</a></li>';
								}
							?>
						</ul>
					</div>
					<!-- mobile top menu bar -->
					<nav class="short-link mobile-top-menu">
						<ul>
						</ul>
					</nav>
				</div>
				
				<!-- main navigation -->
				<nav class="sm-navbar">
					<ul></ul>
				</nav>
			</div>
			
			<!-- this content contain all container -->
			<div class="content">
			
				<!-- small screen header in responsive mode -->
				<div class="sm-header d-md-block d-lg-none">
					<div class="nav-button inline-block vertical-align-middle hamberger">
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
						<div class="d-flex justify-content-between">
							
							<!-- logo and site title -->
							<div class="logo-wrap">
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
							<div class="cam-logo-wrap text-right">
								
								<!-- logo and title -->
								<h1 class="font-moul khmer-title primary-color inline-block">
								<?php get_template_part('template-parts/header/header', 'text'); ?>
								</h1>
								<object class="khmer-logo" class="d-inline-block" type="image/svg+xml" data="<?php echo get_template_directory_uri() . '/asset/img/Royal_Cambodia.svg'; ?>" width="" height=""></object>
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
										
										echo '<li class="active"><a href="#">ភាសាខ្មែរ</a></li>';
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
										'container_class' => 'short-link desktop-top-menu'
									) );
								?>
							</div>
						</div>
					</div>
					
					<!-- main navigation -->
					<div class="primary-background-color">	
						<div class="container">
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

