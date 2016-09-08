<?php
    use Roots\Sage\Utils;

    $image_1 = ( !empty($image_1) ? $image_1 : null );
    $image_2 = ( !empty($image_2) ? $image_2 : null );
?>

<?php if ( !empty($image_1) && !empty($image_2) ): ?>
    <div class="grid grid--vertical-l">
        <div class="gc t1-2 l1-2">
            <?php echo Utils\ob_load_template_part('templates/components/bleed-image', [ 'image' => $image_1] ); ?>
        </div>
        <div class="gc t1-2 l1-2">
            <?php echo Utils\ob_load_template_part('templates/components/bleed-image', [ 'image' => $image_2] ); ?>
        </div>
    </div>
<?php endif; ?>
