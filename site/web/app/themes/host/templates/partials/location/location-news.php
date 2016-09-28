<?php
    use Roots\Sage\Utils;
    use Roots\Sage\Titles;

    // 1. get things
    $sTitle   = get_field('news_title');
    $sContent = get_field('news_content');

    // 2. if there’s nothing, bail
    if (empty($sTitle) || empty($sContent))
    {
        return;
    }

    // 3. base params
    $aParam = [ 'color' => 'grape' ];

    // 4. build content
    $aParam['content'] = Titles\split_line_header('h2', $sTitle)."\n\n"
                        .apply_filters('the_content', $sContent);

    // 5. background image
    if (($iImageId = get_field('news_image')) !== null)
    {
        $aParam['background'] = wp_get_attachment_image_url($iImageId, 'full');
    }

    // 6. output
    echo Utils\ob_load_template_part('templates/components/billboard', $aParam);
