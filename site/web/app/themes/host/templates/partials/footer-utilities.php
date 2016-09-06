
<?php
    $container_class = 'menu-footer-utilities';
    $menu_class 	 = 'js-nav-footer-utilities nav-footer-utilities';

	$menu = wp_nav_menu( array(
		'menu'				=>'7',
		'menu_class' 		=> $menu_class,
		'container' 		=> 'nav',
		'container_class' 	=> $container_class,
        'depth'             => 1,
		'echo'				=> 1
	) );
?>
