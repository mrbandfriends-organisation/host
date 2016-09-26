<?php
    Use Roots\Sage\Utils;
    use Roots\Sage\ajaxLoadPosts;

    $page_id = get_option( 'page_for_posts' );


    // Getting the query
    $the_query = ajaxLoadPosts\blog_post_query(get_query_var('paged'));

    // Temp for stlying page purposes before get ajax sorted
    $blog_posts = $the_query;

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

<?php if ($blog_posts->have_posts()): ?>
    <section class="article-list-section band box box--padded box--off-white">
        <div class="container">
            <ul class="article-list js-posts-loader-container" data-columns>
                <?php echo Utils\ob_load_template_part('templates/partials/listing/article-loop', [
                    'query' => $blog_posts
                ]); ?>
            </ul>
        </div>

        <?php if ($curr_page < $max_pages): ?>
            <a href="<?=str_replace('%s', ($curr_page + 1), $sBaseUrl); ?>" class="article-list-button btn btn--sky js-posts-loader-trigger"
                data-posts-loader-max-pages="<?php echo esc_attr( $max_pages ); ?>"
                data-posts-loader-curr-page="<?php echo esc_attr( $curr_page ); ?>">
                Load more articles
            </a>
        <?php endif; ?>
    </section>
<?php endif; ?>


<?php
//echo Utils\ob_load_template_part('templates/partials/listing/pagination', array(
//    'query' => $the_query
//)); ?>
