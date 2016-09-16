<?php
    use Roots\Sage\Utils;

    // variables
    $title   = ( !empty($title) ? $title : null );
    $image   = ( !empty($image) ? $image : null );
    $url     = ( !empty($url) ? $url : null );
    $address = ( !empty($address) ? $address : null );
?>

<?php  ?>
<div class="grid">
    <div class="gc t1-1 s1-2 m2-3 l3-4">
        <img src="<?php echo esc_url($image) ?>" alt="<?php echo esc_html($title); ?>" />
    </div>
    <div class="gc t1-1 s1-2 m1-3 l1-4">
        <?php echo Utils\ob_load_template_part('templates/partials/shared/icon', array(
            'icon'       => "twitter",
            "classnames" => "separated-list__icon"
        )); ?>

        <address class="text-center">
            <strong>Address:</strong>
            <p>
                <?=str_replace("\n", '<br>', esc_html($address)); ?>
            </p>
        </address>
    </div>
</div>
