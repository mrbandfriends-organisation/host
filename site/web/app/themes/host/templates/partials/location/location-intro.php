<?php
    /**
     * BUILDING INTRO
     **/
    use Roots\Sage\Utils;

    $sStyle = '';
    if (has_post_thumbnail())
    {
        $sUrl   = wp_get_attachment_image_url(get_post_thumbnail_id(), 'full');
        $sStyle = sprintf(' style="background-image: url(%s)"', $sUrl);
    }
?>
<section class="band billboard -left box box--red -bg-actual-size">
    <div class="container billboard__inner grid"<?=$sStyle; ?>>
        <div class="billboard__main l3-5">
            <h2>
                <?=get_field('title_1'); ?>
                <?=get_field('title_2'); ?>
            </h2>

            <?=get_field('description'); ?>
        </div>
    </div>
</section>
