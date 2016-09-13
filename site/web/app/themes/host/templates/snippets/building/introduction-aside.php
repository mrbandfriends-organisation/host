<?php
    use Roots\Sage\Utils;
?>

<?php
  // check if the repeater field has rows of data
  if( have_rows('links_downloads') ):?>

    <h3 class="plain inherit-fg">Cant wait to get settled in? You’ll need these downloads</h3>

      <?php while ( have_rows('links_downloads') ) : the_row();
          // display a sub field value
          $button_text = get_sub_field('button_text');
          $link = get_sub_field('link');
          $button_type = get_sub_field('button_type');
    ?>

          <a href="<?php echo esc_html($link); ?>" class="btn <?php if ($button_type === 'outline'): echo esc_html('btn--outline-only'); endif; ?>">
            <?php echo esc_html($button_text); ?>
          </a>

<?php
      endwhile;
  else :
      // no rows found
  endif;
?>
