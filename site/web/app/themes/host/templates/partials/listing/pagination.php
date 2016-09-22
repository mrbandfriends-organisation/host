<?php
    $pagination_query = $query;
    if ( !empty( $pagination_query ) ) {

        $big = 999999999; // need an unlikely integer

        $pagination_args = array (
            'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
            'format'    => '?paged=%#%',
            'current'   => max( 1, get_query_var('paged') ),
            'total'     => $pagination_query->max_num_pages,
            'type'      => 'array',
            'prev_text' => __('Previous'),
            'next_text' => __('Next')
        );

        $pagination = paginate_links( $pagination_args );

    }

    if ( !empty( $pagination ) ) {
        $prev = array_shift( $pagination );
        $next = array_pop( $pagination );
    }
?>


<?php if ( !empty( $pagination ) ): ?>
    <div class="pagination-container">
        <ul class="pagination">
            <li class=" pagination__item--prev">
                <?php echo $prev; ?>
            </li>

            <?php foreach ( $pagination as $link ): ?>
                <li class="pagination__item pagination__item--number">
                    <?php echo $link; ?>
                </li>
            <?php endforeach; ?>

            <li class="pagination__item pagination__item--next">
                <?php echo $next; ?>
            </li>
        </ul>
    </div>
<?php endif; ?>
