<?php
    /**
     * BUILDING INTRO.
     **/
    use Roots\Sage\Titles;

    $sStyle = '';
    if (has_post_thumbnail()) {
        $sUrl = wp_get_attachment_image_url(get_post_thumbnail_id(), 'full');
    }
?>
<section class="band billboard -left box box--red -bg-actual-size">
    <div class="container billboard__inner grid lazyload" data-bg="<?php echo esc_attr($sUrl);?>">
        <div class="billboard__main l2-5">
            <?=Titles\split_line_header('h1', get_field('title'), 'h2'); ?>
            <?=apply_filters('the_content', get_field('description')); ?>
        </div>
    </div>
</section>
