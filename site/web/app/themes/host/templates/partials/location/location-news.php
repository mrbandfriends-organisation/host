<?php
    use Roots\Sage\Utils;
    use Roots\Sage\Titles;

    // 0. base params
    $aParam = [ 'color' => 'grape' ];

    // 1. build content
    $aParam['content'] = Titles\split_line_header('h2', get_field('news_title'))."\n\n"
                        .apply_filters('the_content', get_field('news_content'));

    // 2. background image
    if (($iImageId = get_field('news_image')) !== null)
    {
        $aParam['background'] = wp_get_attachment_image_url($iImageId, 'full');
    }

    // 3. output
    echo Utils\ob_load_template_part('templates/components/billboard', $aParam);
