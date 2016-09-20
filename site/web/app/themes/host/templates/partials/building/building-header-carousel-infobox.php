<?php
    use Roots\Sage\Utils;

    //$snippet = ( !empty($snippet) ? $snippet : null );
    $snippet = 'building/building-carousel-infobox';
?>

<?php if ( !empty($snippet) ): ?>
    <div class="carosel-infobox carosel-infobox--building slideshow-infobox box box--mint text-left">
        <?php echo Utils\ob_load_template_part('templates/snippets/' . $snippet); ?>
    </div>
<?php endif; ?>
