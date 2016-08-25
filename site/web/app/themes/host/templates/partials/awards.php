<?php
    /**
    * GLOABL AWARDS
    **/
    use Roots\Sage\Utils;

    $awards_title = get_field('awards_title','option');
    $awards_description = get_field('awards_description','option');
?>


<section class="band split-feature grid">

  <div class="split-feature__main box--red gc l1-2">
      <div class="split-feature__content">
          <h2><?php echo esc_html( $awards_title ); ?></h2>
          <?php echo $awards_description; ?>
      </div>
  </div>

  <aside class="split-feature__secondary gc l1-2">
          <ul class="awards">
            <?php
              $award_logos = get_field('award_logos','option');
              foreach ($award_logos as $logo_item) :
            ?>
                <li class="awards__item">
                    <img src="<?php echo esc_html( $logo_item['logo']['url'] ); ?>" alt="<?php echo esc_html( $logo_item['title'] ); ?>" class="awards__image" />
                </li>
            <?php endforeach; ?>
          </ul>
  </aside>
  
</section>
