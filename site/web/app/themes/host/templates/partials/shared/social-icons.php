<?php
    $modifier = ( !empty($modifier) ? $modifier : null );
    $icon_color = ( !empty($icon_color) ? $icon_color : null );
?>

<ul class="social-media-icons-list <?php echo esc_attr( $modifier ); ?>">
    <li class="social-media-icons-list__item">
        <a href="https://twitter.com/xxx/" class="social-media-icons-list__link">
            <?php $this->insert('partials::shared/icon', [
                'icon'      => 'twitter',
                'classnames' => 'social-media-icons-list__icon social-media-icons-list__icon--twitter ' . $icon_color
            ]); ?>
        </a>
    </li>
    <li class="social-media-icons-list__item">
        <a href="https://www.facebook.com/yourxxx" class="social-media-icons-list__link">
            <?php $this->insert('partials::shared/icon', [
                'icon'      => 'facebook',
                'classnames' => 'social-media-icons-list__icon social-media-icons-list__icon--facebook ' . $icon_color
            ]); ?>
        </a>
    </li>
    <li class="social-media-icons-list__item">
        <a href="https://www.linkedin.com/company/xxx" class="social-media-icons-list__link">
            <?php $this->insert('partials::shared/icon', [
                'icon'      => 'linked-in',
                'classnames' => 'social-media-icons-list__icon social-media-icons-list__icon--linked-in ' . $icon_color
            ]); ?>
        </a>
    </li>
</ul>
