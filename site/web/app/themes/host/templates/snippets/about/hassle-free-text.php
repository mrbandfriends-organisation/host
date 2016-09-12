<?php
use Roots\Sage\Utils;
?>

<h2><?= esc_html($section_1_title_1);?><br><?= esc_html($section_1_title_2);?></h2>

<?=Utils\esc_textarea__($section_1_description);?>

<p>
    <a href="<?= esc_url($section_1_button_link);?>" class="btn"><?= esc_html($section_1_button_text);?></a>
</p>
