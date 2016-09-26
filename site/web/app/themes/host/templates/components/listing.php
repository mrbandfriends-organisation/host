<?php
    Use Roots\Sage\Utils;
    Use Roots\Sage\ajaxLoadPosts;

    Global $post;
    $gloabl_page_id = $post->ID;

    // Query deafults
    $page_id            = ( !empty($page_id) ? $page_id : $gloabl_page_id );
    $post_loader_class  = ( !empty($post_loader_class) ? $post_loader_class : null );
    $post_type          = ( !empty($post_type) ? $post_type : 'post' );
    $post_per_page      = ( !empty($post_per_page) ? $post_per_page : 6 );

    // Getting the query
    $the_query = ajaxLoadPosts\ajax_load_post_query( array(
        'paged'          => get_query_var('paged'),
        'posts_per_page' => $post_per_page,
        'post_type'      => $post_type
    ));



    // Template stuff
    // ========================================================================
    $modifier              = ( !empty($modifier) ? $modifier : null );
    $article_list_modifier = ( !empty($modifier) ? 'article-list--' . $modifier : null );



    // Ajax stuff
    // ========================================================================
    // Grab the current "Page" if we are on a paginated page
    $curr_page  = get_query_var('paged',       1);
    $curr_cat   = get_query_var('category', null);
    $curr_date  = get_query_var('date',     null);

    if (empty($curr_page) || ($curr_page === 0))
    {
        $curr_page = 1;
    }

    // Capture max pages (primarily in order to pass into the JS)
    $max_pages  = $the_query->max_num_pages;

    // next page link
    $aBaseUrl = explode('?', get_pagenum_link(), 2);
    $sBaseUrl = join('page/%s?', $aBaseUrl);
?>

<?php echo Utils\ob_load_template_part('templates/components/hero', array(
    'post_id'  => $page_id
)); ?>

<?php if ($the_query->have_posts()): ?>
    <section class="article-list-section band box box--padded box--off-white">
        <div class="container">
            <ul class="article-list <?php echo esc_attr($article_list_modifier); ?> js-posts-loader-container <?php echo esc_attr( $post_loader_class ); ?>" data-columns>
                <?php echo Utils\ob_load_template_part('templates/partials/listing/article-loop', [
                    'query'    => $the_query,
                    'modifier' => $modifier
                ]); ?>
            </ul>
        </div>

        <?php if ($curr_page < $max_pages): ?>
            <a href="<?=str_replace('%s', ($curr_page + 1), $sBaseUrl); ?>" class="article-list-button btn btn--sky js-posts-loader-trigger"
                data-posts-loader-max-pages="<?php echo esc_attr( $max_pages ); ?>"
                data-posts-loader-curr-page="<?php echo esc_attr( $curr_page ); ?>"
                >
                Load more articles
            </a>
        <?php endif; ?>
    </section>
<?php endif; ?>


<?php
    //echo Utils\ob_load_template_part('templates/partials/listing/pagination', array(
    //    'query' => $the_query
    //));
?>
