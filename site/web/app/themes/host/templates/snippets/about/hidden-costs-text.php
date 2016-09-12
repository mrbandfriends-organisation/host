<?php
use Roots\Sage\Utils;
?>

<h2><?= esc_html($section_2_title_1);?><br><?= esc_html($section_2_title_2);?></h2>

<?=Utils\esc_textarea__($section_2_description);?>

<?php if (!empty($section_2_disclaimer)):?>
<p class="small-copy">
    <?= esc_html($section_2_disclaimer);?>
</p>
<?php endif; ?>
