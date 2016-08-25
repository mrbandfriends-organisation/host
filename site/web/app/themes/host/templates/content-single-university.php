<?php
    use Roots\Sage\Utils;
?>


  <main id="main-content" role="main" class="main-content">

      <?php while (have_posts()) : the_post(); ?>

        <section class="band split-feature grid">
          <div class="split-feature__main box--red gc l1-2">
              <div class="split-feature__content">
                  <?php the_content(); ?>
              </div>
          </div>
          <aside class="split-feature__secondary gc l1-2">
              <?php echo the_post_thumbnail(); ?>
          </aside>
        </section>

      <?php endwhile; ?>


      <?php echo Utils\ob_load_template_part('templates/partials/university/featured-building'); ?>

      <?php echo Utils\ob_load_template_part('templates/partials/awards'); ?>

  </main>
