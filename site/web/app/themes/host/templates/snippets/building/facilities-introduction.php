<?php
    use Roots\Sage\Utils;
?>

<?php if ( !empty($facilities_title_1) && !empty($facilities_title_2) ): ?>
    <h2>
        <?=esc_html($facilities_title_1); ?>
        <br>
        <?=esc_html($facilities_title_2); ?>
    </h2>
<?php endif; ?>

<?php if ( !empty($facilities_location) ): ?>
    <p>
        <strong><?=esc_html($facilities_location); ?>:</strong>
    </p>
<?php endif; ?>

<?php if ( !empty($facilities_overview) ): ?>
    <?= Utils\esc_textarea__($facilities_overview); ?>
<?php endif; ?>

<?php
  // Facilities List with icons
  if( have_rows('facilities_list') ):?>
    <?php
        $facilities = get_field_object('facilities_list');
        $facilities_count = (count($facilities['value']));
    ?>
    <ul class="separated-list">
        <?php foreach ($facilities['value'] as $facility): ?>
            <li class="separated-list__item">
                <?php echo Utils\ob_load_template_part('templates/partials/shared/icon', array(
                    'icon'       => Utils\strip_file_format($facility['icon']),
                    "classnames" => "separated-list__icon"
                )); ?>
                <?php echo esc_html($facility['description']); ?>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>
