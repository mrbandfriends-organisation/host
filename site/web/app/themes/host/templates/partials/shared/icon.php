<?php
    if ( empty($icon) )
    {
        return "";
    }

    // get a class
    $class = (empty($classnames)) ? '' : ' '.esc_attr($classnames);

    // and also the current icon name
    $class = ' svg-icon--'.esc_attr($icon).$class;
?>
<svg class="svg-icon<?=$class; ?>" role="img">
    <use xlink:href="#icon-<?php echo esc_attr( $icon ); ?>"></use>
</svg>
