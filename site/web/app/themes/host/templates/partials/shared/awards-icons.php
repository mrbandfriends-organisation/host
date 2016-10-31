<?php
    use Roots\Sage\Assets;
    $awards = ( !empty($awards) ? $awards : null );
?>

<?php if ( !empty($awards) ): ?>
    <ul class="awards">
    <?php foreach ($awards as $award): ?>
        <li class="awards__item ">
        	<?php echo Assets\lazy_loaded_image(array(
				'src' => $award['logo']['url'],
				'alt' => $award['logo']['alt'],
				'classnames' => "awards__image"
        	)); ?>            
        </li>
    <?php endforeach; ?>
    </ul>
<?php endif; ?>
