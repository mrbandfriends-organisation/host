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

    <div class="testimonial-wall__inner">
        <div class="testimonial-wall__unit testimonial-wall__unit--first">
            <?php echo Utils\ob_load_template_part('templates/snippets/shared/testimonial-grid-1', array(
                'location'  => $student_testimonials[0]['location']->post_title,
                'name'  => $student_testimonials[0]['name'],
                'testimonial'  => $student_testimonials[0]['testimonial'],
                'image'        => $student_testimonials[0]['image']['url'],
                'alt'        => $student_testimonials[0]['image']['alt']
            )); ?>

            <?php echo Utils\ob_load_template_part('templates/snippets/shared/testimonial-grid-2', array(
                'location'  => $student_testimonials[1]['location']->post_title,
                'name'  => $student_testimonials[1]['name'],
                'testimonial'  => $student_testimonials[1]['testimonial'],
            )); ?>
        </div>
        <article class="testimonial-wall__unit testimonial-wall__unit--second testimonial-wall__testimonial">
            <?php echo Utils\ob_load_template_part('templates/snippets/shared/testimonial-grid-3', array(
                'location'  => $student_testimonials[2]['location']->post_title,
                'name'  => $student_testimonials[2]['name'],
                'testimonial'  => $student_testimonials[2]['testimonial'],
                'image'        => $student_testimonials[2]['image']['url'],
                'alt'        => $student_testimonials[2]['image']['alt']
            )); ?>

        </article>
        <article class="testimonial-wall__unit testimonial-wall__unit--third testimonial-wall__testimonial">
            <?php echo Utils\ob_load_template_part('templates/snippets/shared/testimonial-grid-4', array(
                'location'     => $student_testimonials[3]['location']->post_title,
                'name'         => $student_testimonials[3]['name'],
                'testimonial'  => $student_testimonials[3]['testimonial'],
                'image'        => $student_testimonials[3]['image']['url'],
                'alt'        => $student_testimonials[3]['image']['alt']
            )); ?>

        </article>
    </div>
</section>
<?php endif; ?>
