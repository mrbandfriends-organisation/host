<?php
    use Roots\Sage\Utils;
?>

<h2><?=esc_html($facilities_title); ?></h2>

<p>
    <strong><?=esc_html($facilities_location); ?>:</strong>
</p>

<?= Utils\esc_textarea__($facilities_overview); ?>

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
