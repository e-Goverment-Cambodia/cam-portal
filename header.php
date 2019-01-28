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
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
		<!-- options -->
		<style>
			.primary-color, .tab-collapse > li.active > a::before, .pagination a, .breadcrum a, .category a { color: #2082c3; }
			.primary-background-color, .lg-nav .dropdown-menu, .tab-collapse > li.active > a, .pagination ul li.active span { background-color: #2082c3; }
			.fill { fill: #2082c3; }
			.non-responsive .container, .non-responsive .wrapper { min-width: 1024px; }
		</style>
</head>
<body>
		<!-- Get Logo image -->
		<?php
			$custom_logo_id = get_theme_mod( 'custom_logo' );
			$image = wp_get_attachment_image_src( $custom_logo_id , 'full' );
		?>
		<!-- wrap all content container instead of body -->
		<div class="wrapper">
		
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
					
					<!-- top menu bar -->
					<ul class="short-link">
						<li><a class="primary-color" href="#">ជជែកផ្ទាល់ -</a></li>
						<li><a class="primary-color" href="#">ទំនាក់ទំនង -</a></li>
						<li><a class="primary-color" href="#">ផ្តល់មតិយោបល់</a></li>
						<li><a class="primary-color" href="#">សំនួរ ចម្លើយ </a></li>
					</ul>
				</div>
				
				<!-- main navigation -->
				<nav class="sm-navbar-wrap animated bounceInDown">
					<ul class="sm-navbar primary-background-color">
						<li><a href="#">ទំព័រដើម</a></li>
						<li class="sub-menu current-menu-ancestor "><a href="#">អំពីខេត្តកំពត</a>
							<ul>
								<li class="sub-menu current-menu-ancestor"><a href="#">ចក្ខុវិស័យ</a><span class="oi oi-chevron-bottom right"></span>
									<ul>
										<li><a href="#">រចនាសម្ព័ន្ធ</a></li>
										<li><a href="#">ថ្នាក់ដឹកនាំខេត្ត</a></li>
										<li class="current-menu-item"><a href="#">មន្ទី-អង្គភាពជុំវិញខេត្ត</a></li>
										<li><a href="#">រដ្ឋបាលក្រុង-ស្រុក</a></li>
										<li><a href="#">ក្របខ័ណ្ឌអភិវឌ្ឍន៍ខេត្ត</a></li>
									</ul>
								</li>
								<li class="sub-menu"><a href="#">រចនាសម្ព័ន្ធ</a><span class="oi oi-chevron-bottom right"></span>
									<ul>
										<li><a href="#">រចនាសម្ព័ន្ធ</a></li>
										<li><a href="#">ថ្នាក់ដឹកនាំខេត្ត</a></li>
										<li><a href="#">មន្ទី-អង្គភាពជុំវិញខេត្ត</a></li>
										<li><a href="#">រដ្ឋបាលក្រុង-ស្រុក</a></li>
										<li><a href="#">ក្របខ័ណ្ឌអភិវឌ្ឍន៍ខេត្ត</a></li>
									</ul>
								</li>
								<li><a href="#">ថ្នាក់ដឹកនាំខេត្ត</a></li>
								<li><a href="#">មន្ទី-អង្គភាពជុំវិញខេត្ត</a></li>
								<li><a href="#">រដ្ឋបាលក្រុង-ស្រុក</a></li>
								<li><a href="#">ក្របខ័ណ្ឌអភិវឌ្ឍន៍ខេត្ត</a></li>
							</ul>
						</li>
						<li class="sub-menu"><a href="#">អំពីសេវា</a>
							<ul>
								<li><a href="#">សេវាសាធារណៈ</a></li>
								<li><a href="#">សេវារដ្ឋបាល</a></li>
							</ul>
						</li>
						<li class="sub-menu"><a href="#">ព័ត៌មាន និងសេចក្តីប្រកាស</a>
							<ul>
								<li><a href="#">ព័ត៌មានថ្មីៗ</a></li>
								<li><a href="#">បទដ្ឋានគតិយុត្តិ</a></li>
							</ul>
						</li>
						<li class="sub-menu"><a href="#">តំបន់ទេសចរណ៍</a>
							<ul>
								<li><a href="#">រមណីដ្ឋានប្រវត្តសាស្រ្ត</a></li>
								<li><a href="#">រមណីដ្ឋានធម្មជាតិ</a></li>
							</ul>
						</li>
						<li><a href="#">ព្រឹត្តិការណ៍</a></li>
					</ul>
				</nav>
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
									<img src="<?php echo $image[0]; ?>">
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
								<h1 class="font-moul khmer-title primary-color inline-block">ព្រះរាជាណាចក្រកម្ពុជា <br/>ជាតិសាសនាព្រះមហាក្សត្រ</h1>
								<img class="khmer-logo inline-block" src="<?php header_image(); ?>" />
								<br/>
								
								<!-- search form -->
								<form class="form-inline inline-block">
									<div class="input-group input-group-sm mb-3">
										<div class="input-group-prepend primary-background-color">
											<button class="btn btn-outline" type="submit" id="button-addon1"><span class="oi oi-magnifying-glass"></span></button>
										</div>
										<input type="text" class="form-control" placeholder="ស្វែងរក" aria-label="Example text with button addon" aria-describedby="button-addon1">
									</div>
								</form>
								
								<!-- top menu -->
								<ul class="short-link">
									<li><a class="primary-color" href="#">ជជែកផ្ទាល់ |</a></li>
									<li><a class="primary-color" href="#">ទំនាក់ទំនង |</a></li>
									<li><a class="primary-color" href="#">ផ្តល់មតិយោបល់ |</a></li>
									<li><a class="primary-color" href="#">សំនួរ ចម្លើយ </a></li>
								</ul>
							</div>
						</div>
					</div>
					
					<!-- main navigation -->
					<div class="primary-background-color lg-nav">	
						<div class="container">	
							<div class="row">	
								<ul class="nav">
									<li><a href="#">ទំព័រដើម</a></li>
									<li class="dropdown current-menu-ancestor">
										<a href="#">អំពីខេត្តកំពត</a>
										<ul class="dropdown-menu dropdown-menu-left multi-level">
											<li><a href="#">ចក្ខុវិស័យ</a></li>
											<li><a href="#">រចនាសម្ព័ន្ធ</a></li>
											<li class="dropdown-submenu current-menu-ancestor">
												<a href="#">ថ្នាក់ដឹកនាំខេត្ត</a>
												<ul class="dropdown-menu">
													<li><a href="#">មន្ទី-អង្គភាពជុំវិញខេត្ត</a></li>
													<li class="dropdown-submenu current-menu-ancestor">
														<a href="#">រដ្ឋបាលក្រុង-ស្រុក</a>
														<ul class="dropdown-menu">
															<li class="current-menu-item"><a href="#">ក្របខ័ណ្ឌអភិវឌ្ឍន៍ខេត្ត</a></li>
														</ul>
													</li>
													<li><a href="#">រដ្ឋបាលក្រុង-ស្រុក</a></li>
													<li><a href="#">ក្របខ័ណ្ឌអភិវឌ្ឍន៍ខេត្ត</a></li>
												</ul>
											</li>
										</ul>
									</li>
									<li><a href="#">អំពីសេវា</a></li>
									<li><a href="#">ព័ត៌មាន និងសេចក្តីប្រកាស</a></li>
									<li><a href="#">តំបន់ទេសចរណ៍</a></li>
									<li><a href="#">ព្រឹត្តិការណ៍</a></li>	
								</ul>
							</div>
						</div>
					</div>
				</div>

<!-- <body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'cam-portal' ); ?></a>

	<header id="masthead" class="site-header">
		<div class="site-branding">
			<?php
			the_custom_logo();
			if ( is_front_page() && is_home() ) :
				?>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<?php
			else :
				?>
				<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
				<?php
			endif;
			$cam_portal_description = get_bloginfo( 'description', 'display' );
			if ( $cam_portal_description || is_customize_preview() ) :
				?>
				<p class="site-description"><?php echo $cam_portal_description; /* WPCS: xss ok. */ ?></p>
			<?php endif; ?>
		</div> -->
		<!-- .site-branding -->

		<!-- <nav id="site-navigation" class="main-navigation">
			<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'cam-portal' ); ?></button>
			<?php
			wp_nav_menu( array(
				'theme_location' => 'menu-1',
				'menu_id'        => 'primary-menu',
			) );
			?>
		</nav> -->
		<!-- #site-navigation -->
	<!-- </header>#masthead -->

	<div id="content" class="site-content">
