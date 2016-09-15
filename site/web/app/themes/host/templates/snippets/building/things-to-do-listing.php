<?php
    use Roots\Sage\Utils;
?>

<?php
  // Facilities List with icons
  if( have_rows('points_of_interest') ):?>
  <?php
    $locations = get_field_object('points_of_interest');
    $locations_count = (count($locations['value']));
   ?>
<div class="grid">
    <div class="gc s2-3 box box--ink-dark box--padded scrollable js-scrollable">

        <ul class="transport-list">
            <?php foreach($locations['value'] as $location): ?>
                <li class="transport-list__item">
                    <h3><?= esc_html($location['title']); ?></h3>
                    <p>
                        <?= esc_html($location['transport_time']); ?>
                        <?= esc_html($location['walking_time']); ?>
                    </p>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>

    <?php
        $photo = get_field('location_image');
    ?>


    <div class="gc s1-3">
        <?php echo Utils\ob_load_template_part('templates/components/bleed-image', [ 'image' => $photo['url'] ]); ?>
    </div>

</div>
<?php endif; ?>
