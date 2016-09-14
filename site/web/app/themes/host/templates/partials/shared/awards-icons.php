<?php
    $awards = ( !empty($awards) ? $awards : null );
?>

<?php if ( !empty($awards) ): ?>
    <ul class="awards">
    <?php foreach ($awards as $award): ?>
        <li class="awards__item ">
            <img src="<?=esc_url($award['logo']['url']); ?>" alt="<?=esc_attr($award['logo']['alt']); ?>" class="awards__image">
        </li>
    <?php endforeach; ?>
    </ul>
<?php endif; ?>
