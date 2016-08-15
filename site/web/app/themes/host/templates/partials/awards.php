<?php
    /**
    * GLOABL AWARDS
    **/
    use Roots\Sage\Utils;
?>


<?php
  $awards_title = get_field('awards_title','option');
  $awards_description = get_field('awards_description','option');
?>

  <h2><?php echo esc_html( $awards_title ); ?></h2>
  <?php echo $awards_description; ?>


<ul>
  <?php
    $award_logos = get_field('award_logos','option');
    foreach ($award_logos as $logo_item) {
  ?>

    <li>
      <img src="<?php echo esc_html( $logo_item['logo']['url'] ); ?>" alt="<?php echo esc_html( $logo_item['title'] ); ?>" />
    </li>

  <?php } ?>
</ul>
