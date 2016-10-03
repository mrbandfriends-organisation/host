<?php
    Use Roots\Sage\Utils;
?>

<?php echo Utils\ob_load_template_part('templates/components/hero', array(
    'post_id'  => get_the_id(),
    'modifier' => 'full-bleed',
    'srcset'   => true
)); ?>

<section class="generic-content-page band band--inset">
    <div class="generic-content-page__inner container">
        <?php get_template_part('templates/page', 'header'); ?>

        <?php the_content(); ?>
    </div>
</section>
