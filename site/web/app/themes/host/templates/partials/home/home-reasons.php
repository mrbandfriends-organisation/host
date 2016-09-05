<?php
  /**
  * HOME REASONS
  **/
    use Roots\Sage\Utils;
?>

<?php
  $reasons_title_1 = get_field('reasons_title_1');
  $reasons_title_2 = get_field('reasons_title_2');
  $reasons_content = get_field('reasons_content');

  $reasons_image = get_field('reason_image');

  $reasons_items = get_field('reason_item');

  $reasons_button_text = get_field('reasons_button_text');
  $reasons_button_link = get_field('reasons_button_link');
?>


<img src="<?php echo esc_html($reasons_image['url']); ?>" alt="<?php echo esc_html($reasons_image['title']); ?>" />


<h2>
  <?php echo esc_html($reasons_title_1); ?><br />
  <?php echo esc_html($reasons_title_2); ?>
</h2>

<?php echo $reasons_content; ?>

<pre>
  <?php
  /*** NEED TO COMPLETE **/
  print_r($reasons_items); ?>
</pre>

<a href="<?php echo esc_html($reasons_button_link); ?>" class="btn"><?php echo esc_html($reasons_button_text); ?></a>
