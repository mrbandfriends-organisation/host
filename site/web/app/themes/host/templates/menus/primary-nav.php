<?php
	use Roots\Sage\Utils;

    $container_class = 'menu-primary menu-primary--' . $modifier;
    $menu_class 	 = 'nav-primary nav-primary--' . $modifier;

    if ( has_nav_menu('primary_navigation') ):    	
		$menu = wp_nav_menu( array(
			'menu'				=>'primary-navigation',
			'menu_class' 		=> $menu_class,
			'container' 		=> 'nav',
			'container_class' 	=> $container_class,
			'echo'				=> 0,
		) );  

	    echo $menu;
    endif;
?>