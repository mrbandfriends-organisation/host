<?php
    use Roots\Sage\Utils;
    use Roots\Sage\GravityForms;
?>

<section class="contact-form-section box box--ink">
    <div class="container">
        <?php if ( GravityForms\gravity_form_exists( 1 ) ): ?>
            <?php gravity_form(1); ?>
        <?php endif ?>
    </div>
</section>
