<?php
use Roots\Sage\Utils;

 ?>

<h2>
    <?php echo esc_html($investors_title_1);?>
  <br />
  <?php echo esc_html($investors_title_2);?>
</h2>

<?php echo Utils\esc_textarea__($investors_content);?>

<a href="<?php echo esc_url($investors_button_link); ?>" class="btn"><?php echo esc_html($investors_button_text); ?></a>
