<?php
    use Roots\Sage\Utils;
    use Roots\Sage\GravityForms;
?>

<section id="contact-form-section" class="contact-form-section box box--sky-dark">
    <div class="container">

        <h2>
            Let's talk!
            <br>
            How can we help?
        </h2>

        <?php if ( GravityForms\gravity_form_exists( 1 ) ): ?>
            <?php gravity_form(1); ?>
        <?php endif ?>
    </div>
</section>
