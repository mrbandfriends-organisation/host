<?php
	global $post;
	use Roots\Sage\Utils;

    // Variables
    $modifier = ( !empty($modifier) ? $modifier : null );
?>

<?php while ( $query->have_posts() ): $query->the_post(); ?>
    <li class="article-list__item">
		<?php echo Utils\ob_load_template_part('templates/partials/listing/article-loop-item', array(
			'posts_query' 	=> $query,
			'modifier'		=> $modifier
		)); ?>
    </li>
<?php endwhile; ?>
