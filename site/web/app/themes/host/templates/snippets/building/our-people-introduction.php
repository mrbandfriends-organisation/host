<?php
    use Roots\Sage\Utils;
 ?>

<?php if ( !empty($people_title) ): ?>
    <h2>
        <?= esc_html($people_title);?>
    </h2>
<?php endif; ?>

<?=Utils\esc_textarea__($people_description);?>
