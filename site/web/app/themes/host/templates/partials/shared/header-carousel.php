<?php
    /**
    * GLOABL - HEADER CAROUSEL PARTIAL
    **/
    use Roots\Sage\Utils;
?>

<?php
$carousel_images = get_field('carousel_images');

if( $carousel_images ): ?>
    <ul>
        <?php foreach( $carousel_images as $image ): ?>
            <li>
                <a href="<?php echo $image['url']; ?>">
                     <img src="<?php echo $image['sizes']['large']; ?>" alt="<?php echo $image['alt']; ?>" />
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>
