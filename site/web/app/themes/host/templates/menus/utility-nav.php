<?php
use Roots\Sage\Utils;

$container_class = 'menu-primary menu-primary--' . $modifier;
$menu_class 	 = 'nav-primary nav-primary--' . $modifier;

if ( has_nav_menu('primary_navigation') ):
	$menu = wp_nav_menu( array(
		'menu'				=>'9',
		'menu_class' 		=> $menu_class,
		'container' 		=> 'nav',
		'container_class' 	=> $container_class,
        'depth'             => 1,
		'echo'				=> 1
	) );
endif;
?>
