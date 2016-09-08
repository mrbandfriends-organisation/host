<?php
  /**
  * HOME INVESTORS
  **/
    use Roots\Sage\Utils;
?>

<?php
  $investors_title_1 = get_field('investors_title_1');
  $investors_title_2 = get_field('investors_title_2');
  $investors_content = get_field('investors_content');
  $investors_button_text = get_field('investors_button_text');
  $investors_button_link = get_field('investors_button_link');
  $investors_image = get_field('investors_image');
  $investors_image = $investors_image['url'];
?>

<img src="<?php //echo esc_html($investors_image); ?>" />

<h2>
  <?php //echo esc_html($investors_title_1); ?><br />
  <?php //echo esc_html($investors_title_2); ?>
</h2>

<?php //echo $investors_content; ?>

<a href="<?php //echo $investors_button_link; ?>" class="btn"><?php //echo $investors_button_text; ?></a>

<?php echo Utils\ob_load_template_part('templates/components/split-feature', array(
    'align' => 'right',
    'color' => 'grape',
    

)); ?>
