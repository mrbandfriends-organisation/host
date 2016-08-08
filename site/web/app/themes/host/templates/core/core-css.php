<?php

use Roots\Sage\Utils;

// Use minified versions for Production envs. 
$ext = ( WP_ENV === 'production' || WP_ENV === 'staging' ) ? 'min.' : '';

$main_css_buster = Utils\cache_bust_asset( get_stylesheet_directory() . '/assets/css/main.' . $ext . 'css' );

$oldie_css_buster = Utils\cache_bust_asset( get_stylesheet_directory() . '/assets/css/main-oldie.' . $ext . 'css' );
?>

<!--[if lte IE 8]>
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/main.<?php echo $ext;?><?php echo esc_attr( $oldie_css_buster ); ?>.css">
<![endif]-->
<!--[if gt IE 8]><!-->
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/main.<?php echo $ext;?><?php echo esc_attr( $main_css_buster ); ?>.css">
<!--<![endif]-->
