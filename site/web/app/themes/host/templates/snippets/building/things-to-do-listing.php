<?php
    use Roots\Sage\Utils;
?>

<?php
  // Facilities List with icons
  if( have_rows('points_of_interest') ):?>
  <?php
    $location = get_field_object('points_of_interest');
    $location_count = (count($location['value']));
   ?>
<div class="grid">
    <div class="gc s2-3 box box--ink-dark box--padded scrollable js-scrollable">

        <h3 class="plain">Top <?=esc_html($location_count); ?> things to do for students in <?=esc_html($location_location); ?></h3>

        <dl class="-horizontal">
            <?php $count = 1; ?>
            <?php while ( have_rows('points_of_interest') ) : the_row(); ?>
                <dt class="inherit-fg">No <?=esc_html($count); ?></dt>
                <dd><?=esc_html(get_sub_field('description')); ?></dd>
                <?php $count++ ?>
            <?php endwhile; ?>
        </dl>
    </div>

    <?php
      // Facilities Gallery
      if( have_rows('location_photos') ):

          while ( have_rows('location_photos') ) : the_row();

              $photo = get_sub_field('photo');
              $photo_title = $photo['title'];
              $photo_url = $photo['url'];
    ?>

    <?php
          endwhile;
      endif;
    ?>

    <div class="gc s1-3">
        <?php echo Utils\ob_load_template_part('templates/components/bleed-image', [ 'image' => $photo_url ]); ?>
    </div>

</div>
<?php endif; ?>
