<?php
  /**
  * BUILDING PEOPLE
  **/
    use Roots\Sage\Utils;
?>


<?php
    $people_title = get_field('people_title');
    $people_description = get_field('people_description');
?>

<?php
    // People Gallery
    if( have_rows('people_photos') ):

        while ( have_rows('people_photos') ) : the_row();
            $photo       = ( !empty(get_sub_field('photo')) ? get_sub_field('photo') : null );
            $photo_title = ( !empty($photo) ? $photo['title'] : null );
            $photo_url   = ( !empty($photo) ? $photo['url'] : null );
        endwhile;
    endif;
?>

<?php
$main_content = Utils\ob_load_template_part('templates/snippets/building/our-people-introduction', compact('people_title', 'people_description'));

if ( !empty($photo_url) ) {
    $aside_content = Utils\ob_load_template_part('templates/components/bleed-image', array(
        'image'  => $photo_url
    ));
} else {
    $aside_content = null;
}
?>

<?php
echo Utils\ob_load_template_part('templates/components/split-feature', [
    'color'   	 => 'red',
    'content' 	 => $main_content,
    'second'  	 => $aside_content
]);
 ?>
