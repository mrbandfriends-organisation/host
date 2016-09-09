<?php
    /**
    * GLOABL TESTIMONIALS
    **/
    use Roots\Sage\Utils;

    $testimonial_feature    = get_field('feature_image','option');
    $student_testimonials   = get_field('student_testimonials','option');
?>


<img src="<?php echo esc_html($testimonial_feature['url']); ?>" alt="<?php echo esc_html($testimonial_feature['name']); ?>" />


<?php if ( !empty($student_testimonials) ): ?>



    <?php foreach ($student_testimonials as $testimonials) {

          $location = $testimonials['location'];
          $location = $location->post_title;
          ?>

          <h3><?php echo esc_html($testimonials['name']); ?></h3>
          <h4><?php echo esc_html($location); ?></h4>
          <?php echo esc_html($testimonials['testimonial']); ?>

          <?php if ( !empty($testimonials['image']) ): ?>
            <img src="<?php echo esc_html($testimonials['image']['url']); ?>" alt="<?php echo esc_html($testimonials['image']['title']); ?>" />
          <?php endif; ?>

    <?php } ?>



<?php endif; ?>
