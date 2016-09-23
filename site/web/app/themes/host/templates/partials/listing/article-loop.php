<?php
	global $post;
	use Roots\Sage\Utils;

    // Vartiables
    $modifier = ( !empty($modifier) ? $modifier : null );
?>

<?php while ( $query->have_posts() ): $query->the_post(); ?>

	<?php //var_dump( $query->get_posts() ); ?>

	    <li class="flex gc s1-1 m1-2">
			<?php echo Utils\ob_load_template_part('templates/partials/listing/article-loop-item', array(
				'posts_query' 	=> $query,
				'modifier'		=> $modifier
			)); ?>
	    </li>

<?php endwhile; ?>
