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
    <div class="gc s2-3 box box--ink-dark box--padded">

        <ul class="transport-list scrollable js-scrollable">
            <?php foreach($locations['value'] as $location): ?>
                <li class="transport-list__item">
                    <h3 class="transport-list__heading h3"><?= esc_html($location['title']); ?></h3>
                    <ul class="transport-list__listing">
                        <li class="transport-list__listing-item">
                            <?php echo Utils\ob_load_template_part('templates/partials/shared/icon', array(
                                'icon'       => 'travel-public-bus',
                                "classnames" => "transport-list__icon svg-icon--sky"
                            )); ?>

                            <div class="transport-list__content">
                                <?= esc_html($location['transport_time']); ?> <br>

                                public transport
                            </div>

                        </li>
                        <li class="transport-list__listing-item">
                            <?php echo Utils\ob_load_template_part('templates/partials/shared/icon', array(
                                'icon'       => 'travel-walking',
                                "classnames" => "transport-list__icon svg-icon--sky"
                            )); ?>

                            <div class="transport-list__content">
                                <?= esc_html($location['walking_time']); ?><br>

                                Walking time
                            </div>
                        </li>
                    </ul>
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
