<?php
    use Roots\Sage\Utils;
    use Roots\Sage\GravityForms;
?>

<?php if ( GravityForms\gravity_form_exists( 1 ) ): ?>
    <?php gravity_form(1); ?>
<?php endif ?>
