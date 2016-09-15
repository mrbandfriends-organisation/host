<?php
    use Roots\Sage\Utils;
?>

<?php
  // Facilities List with icons
  if( have_rows('facilities_list') ):?>
  <?php
    $facilities = get_field_object('facilities_list');
    $facilities_count = (count($facilities['value']));
   ?>
<div class="grid">
    <div class="gc s2-3 box box--ink-dark box--padded scrollable js-scrollable">

        <h3 class="plain">Top <?=esc_html($facilities_count); ?> things to do for students in <?=esc_html($facilities_location); ?></h3>

        <dl class="-horizontal">
            <?php $count = 1; ?>
            <?php while ( have_rows('facilities_list') ) : the_row(); ?>
                <dt class="inherit-fg">No <?=esc_html($count); ?></dt>
                <dd><?=esc_html(get_sub_field('description')); ?></dd>
                <?php $count++ ?>
            <?php endwhile; ?>
        </dl>
    </div>
    <div class="gc s1-3">
        <?php echo Utils\ob_load_template_part('templates/components/bleed-image', [ 'image' => '/_dummy/london-eye.jpg' ]); ?>
    </div>

</div>
<?php endif; ?>
