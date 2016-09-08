<?php
  /**
  * FEATURED BUILING
  **/
    use Roots\Sage\Utils;
?>

<?php
  $featured_building_title = get_field('featured_building_title');
  $featured_building = get_field('featured_building');

?>

<?php if( $featured_building ): ?>

<?php $featured_building_id = $featured_building->ID;
$featured_building_name = $featured_building->post_title;
$featured_building_url = $featured_building->guid;
$featured_building_description = get_field('description', $featured_building_id);
$featured_building_carousel_images = get_field('carousel_images', $featured_building_id); ?>

  <h2>
    <?php echo esc_html($featured_building_title); ?><br />
    <?php echo esc_html($featured_building_name); ?>
  </h2>

  <?php echo $featured_building_description; ?>

  <a href="<?php echo esc_html($featured_building_url); ?>" class="btn">Show me this property</a>


  <?php
  if( $featured_building_carousel_images ): ?>
    <?php $images =  ?>
      <ul>
          <?php foreach( $featured_building_carousel_images as $image ): ?>
              "<a href=\"<?php echo $image['url']; ?>\">
                   <img src=\"<?php echo $image['sizes']['medium']; ?>\" alt=\"<?php echo $image['alt']; ?>\" />
              </a>"
          <?php endforeach; ?>
      </ul>
  <?php endif; ?>


<?php
  wp_reset_postdata();
  endif;
?>

<?php $content_stuff = "
<h2>{$reasons_title_1}<br>{$reasons_title_2}</h2>

{$reasons_content}

<ul class=\"divided-list\">
    <li class=\"divided-list__item\">
        <svg class=\"svg-icon svg-icon--id-card\" role=\"img\">
            <use xmlns:xlink=\"http://www.w3.org/1999/xlink\" xlink:href=\"#icon-id-card\"></use>
        </svg>
        Feature about Host here
    </li>
    <li class=\"divided-list__item\">
        <svg class=\"svg-icon svg-icon--imac\" role=\"img\">
            <use xmlns:xlink=\"http://www.w3.org/1999/xlink\" xlink:href=\"#icon-imac\"></use>
        </svg>
        Feature about Host here
    </li>
    <li class=\"divided-list__item\">
        <svg class=\"svg-icon svg-icon--id-card\" role=\"img\">
            <use xmlns:xlink=\"http://www.w3.org/1999/xlink\" xlink:href=\"#icon-id-card\"></use>
        </svg>
        Feature about Host here
    </li>
    <li class=\"divided-list__item\">
        <svg class=\"svg-icon svg-icon--imac\" role=\"img\">
            <use xmlns:xlink=\"http://www.w3.org/1999/xlink\" xlink:href=\"#icon-imac\"></use>
        </svg>
        Feature about Host here
    </li>
    <li class=\"divided-list__item\">
        <svg class=\"svg-icon svg-icon--id-card\" role=\"img\">
            <use xmlns:xlink=\"http://www.w3.org/1999/xlink\" xlink:href=\"#icon-id-card\"></use>
        </svg>
        Feature about Host here
    </li>
</ul>

<p>
    <a href=\"{$reasons_button_link}\" class=\"btn\">{$reasons_button_text}</a>
</p>
"
?>

<?php echo Utils\ob_load_template_part('templates/components/split-feature.php', array(
    'second' => "<img src=\"{$reasons_image}\" />",
    'content' => $content_stuff,
    'color'   => "sky"
)); ?>
