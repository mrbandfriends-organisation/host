<?php
    use Roots\Sage\Utils;
?>

<?php while (have_posts()) : the_post(); ?>
      <?php echo the_post_thumbnail(); ?>
      <?php the_content(); ?>
<?php endwhile; ?>


<?php //echo Utils\ob_load_template_part('templates/partials/building/'); ?>

<?php //echo Utils\ob_load_template_part('templates/partials/awards'); ?>


<?php //echo esc_html(); ?>
