<?php
    use Roots\Sage\Utils;
?>

<?php if ( !empty($locations) ):?>
<?php $locations_count = (count($locations)); ?>
    <div class="grid">
        <div class="gc s2-3 box box--ink-dark box--padded">

            <ul class="transport-list scrollable js-scrollable">
                <?php foreach( $locations as $location ): ?>
                    <?php if ( !empty($location['title']) ): ?>
                        <li class="transport-list__item">
                            <h3 class="transport-list__heading h3"><?= esc_html($location['title']); ?></h3>
                            <ul class="transport-list__listing">
                                <?php if ( !empty($location['transport_time']) ): ?>
                                    <li class="transport-list__listing-item">
                                        <?php echo Utils\ob_load_template_part('templates/partials/shared/icon', array(
                                            'icon'       => 'travel-public-bus',
                                            "classnames" => "transport-list__icon svg-icon--sky"
                                        )); ?>

                                        <div class="transport-list__content">
                                            <?= esc_html($location['transport_time']); ?> <br>
                                            Public transport
                                        </div>
                                    </li>
                                <?php endif; ?>

                                <?php if ( !empty($location['walking_time']) ): ?>
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
                                <?php endif; ?>
                            </ul>
                        </li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
        </div>

        <?php if ( !empty($location_image) ): ?>
            <div class="gc s1-3 flex">
                <?php echo Utils\ob_load_template_part('templates/components/bleed-image', [
                    'image'     => $location_image['url'],
                    'modifier'  => 'bleed-image--hide-small',
                    'alt'       => $location_image['alt']
                ]); ?>
            </div>
        <?php endif; ?>

    </div>
<?php endif; ?>
