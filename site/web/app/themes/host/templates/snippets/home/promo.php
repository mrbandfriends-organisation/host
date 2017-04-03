<?php
use Roots\Sage\Utils;

?>

<h2>
    <?php echo esc_html($title_1);?>
  	<br />
  	<?php echo esc_html($title_2);?>
</h2>

<?php echo Utils\esc_textarea__($content);?>

<?php if ( !Utils\mempty( $cta_link, $cta_text ) ): ?>	
<a href="<?php echo esc_attr($cta_link); ?>" class="btn split-feature__btn">
	<?php echo esc_html($cta_text); ?>
</a>
<?php endif ?>