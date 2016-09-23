<?php
    use Roots\Sage\Utils;
?>

<div class="grid grid--vertical-l">
    <div class="gc t1-2 l1-2">
        <?php echo Utils\ob_load_template_part('templates/components/bleed-image', array(
            'image'   => "http://host.dev/app/uploads/cache/2016/08/room_placeholder/4012389868.jpg"
        )); ?>
    </div>
    <div class="gc t1-2 l1-2">
        <h3>holla</h3>
    </div>
</div>
