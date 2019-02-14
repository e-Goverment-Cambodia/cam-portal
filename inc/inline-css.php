<?php
    $cam_portal_inlinestyle = get_theme_mod( 'theme_color_setting' );
?>
<style>
    a, a:hover, .primary-color, .short-link li a, .tab-collapse > li.active > a::before, .pagination a, .breadcrum a, .category a { color: <?php echo $cam_portal_inlinestyle ?>; }
    .primary-background-color, .lg-main-nav ul ul, .tab-collapse > li.active > a, .pagination ul li.active span, .nav-sidebar-2 ul li.active, .nav-sidebar-3 ul li.active, .languages ul li.active { background-color: <?php echo $cam_portal_inlinestyle ?>; }
    .non-responsive .container, .non-responsive .wrapper { min-width: 1024px; }
</style>