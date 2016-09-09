<?php
use Roots\Sage\Utils;
 ?>

<h2>
  <?php echo esc_html($featured_building_title); ?><br />
  <?php echo esc_html($featured_building_name); ?>
</h2>

<?php echo Utils\esc_textarea__($featured_building_description); ?>

<a href="<?php echo esc_html($featured_building_url) ?>" class="btn split-feature__btn">Show me this property</a>
