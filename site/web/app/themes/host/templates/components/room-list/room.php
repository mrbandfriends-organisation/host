<?php
    $aSlideshowConf = [
        "selector" => "#r{$id}",
        "offset"   => -1
    ];
?>

<article id="r<?=$id; ?>" class="listed-room room-list__room">
    <div class="listed-room__content">
        <div class="listed-room__info box box--fg-grape box--less-padding">
            <!-- <h3 class="listed-room__title"><?=$title;?></h3>
            <h4 class="listed-room__price h3 plain">From £<?=$price; ?><abbr title="per week">pw</abbr></h4> -->

            <strong class="listed-room__avail box box--little-padding box--<?=$status['color']; ?> h4 plain">
                <!-- <span class="vh">Availability:</span><?=$status['text']; ?> -->
            </strong>
            <p>
                <!-- <?=$description; ?> -->
            </p>
            <p>
                <a href="#" class="btn btn--small btn--narrow">More information</a>
            </p>
        </div>
        <?php
          // Room Carousel
          if( have_rows('carousel_images') ):?>
        <aside class="listed-room__slideshow slideshow js-slideshow" data-pagination="pn dots" data-mirror-to="<?=esc_attr(json_encode($aSlideshowConf)); ?>">
            <ul class="slideshow__list js-slideshow__list">
            <?php  while ( have_rows('carousel_images') ) : the_row(); ?>
                <?php
                    $photo = get_sub_field('image');
                    $photo_title = $photo['title'];
                    $photo_url = $photo['url'];
                 ?>
                <li class="slideshow__item js-slideshow__item" style="background-image:url(<?=esc_url($photo_url); ?>);">
                    <img src="<?php echo esc_url($photo_url); ?>" alt="<?php echo esc_attr($photo_title); ?>" title ="<?php echo esc_attr($photo_title); ?>" class="slideshow__image js-slideshow__image" />
                </li>
                <?php
                  endwhile;
                ?>
            </ul>
            <?php
              // Facilities List
              if( have_rows('living_space') ):

                  while ( have_rows('living_space') ) : the_row();
                      $description = get_sub_field('description');
            ?>
                        <?php echo esc_html($description) . ". "; ?>
            <?php
                  endwhile;
              else :
                  // no rows found
              endif;
            ?>
        </aside>
        <?php
          endif;
        ?>
    </div>
</article>
