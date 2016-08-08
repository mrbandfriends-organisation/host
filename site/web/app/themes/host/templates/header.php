<?php
    use Roots\Sage\Utils;
?>

<header class="banner">
  <div class="container">
    <?php 
        echo Utils\ob_load_template_part('templates/partials/site-logo.php');
    ?>
    
    <?php
        $banner_nav_args = array(
            'modifier' => 'banner'
        );

        echo Utils\ob_load_template_part('templates/menus/primary-nav.php', $banner_nav_args);
    ?>
    </div>
</header>
