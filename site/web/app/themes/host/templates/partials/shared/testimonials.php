<?php
    /**
    * GLOABL TESTIMONIALS
    **/
    use Roots\Sage\Utils;

    $testimonial_feature    = get_field('feature_image','option');
    $student_testimonials   = get_field('student_testimonials','option');
?>


<?php if ( !empty($student_testimonials) ): ?>

<section class="band testimonial-wall" data-equality>
    <h2 class="vh">What our residents say</h2>

    <div class="grid">
        <div class="gc xxl1-3 grid grid--vertical-xxl">
            <?php echo Utils\ob_load_template_part('templates/snippets/shared/testimonial-grid-1', array(
                'location'  => $student_testimonials[0]['location']->post_title,
                'name'  => $student_testimonials[0]['name'],
                'testimonial'  => $student_testimonials[0]['testimonial'],
                'image'        => $student_testimonials[0]['image']['url']
            )); ?>

            <?php echo Utils\ob_load_template_part('templates/snippets/shared/testimonial-grid-2', array(
                'location'  => $student_testimonials[1]['location']->post_title,
                'name'  => $student_testimonials[1]['name'],
                'testimonial'  => $student_testimonials[1]['testimonial'],
            )); ?>
        </div>
        <article class="testimonial-wall__testimonial gc xxl3-6 grid">
            <?php echo Utils\ob_load_template_part('templates/snippets/shared/testimonial-grid-3', array(
                'location'  => $student_testimonials[2]['location']->post_title,
                'name'  => $student_testimonials[2]['name'],
                'testimonial'  => $student_testimonials[2]['testimonial'],
                'image'        => $student_testimonials[2]['image']['url']
            )); ?>

        </article>
        <article class="testimonial-wall__testimonial gc xxl1-6 grid grid--vertical-xxl">
            <?php echo Utils\ob_load_template_part('templates/snippets/shared/testimonial-grid-4', array(
                'location'     => $student_testimonials[3]['location']->post_title,
                'name'         => $student_testimonials[3]['name'],
                'testimonial'  => $student_testimonials[3]['testimonial'],
                'image'        => $student_testimonials[3]['image']['url']
            )); ?>

        </article>
    </div>
</section>
<?php endif; ?>
