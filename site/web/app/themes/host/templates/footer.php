<footer class="content-info">
  <div class="container">

    <?php wp_nav_menu( array( 'menu' => 'footer_about' ) ); ?>

    <br /><br />

    <?php wp_nav_menu( array( 'menu' => '7' ) ); ?>

  </div>
</footer>

<?php get_template_part('templates/partials/corejs'); ?>

<?php get_template_part('templates/partials/third-party-tools'); ?>
