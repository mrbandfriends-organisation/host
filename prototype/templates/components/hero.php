<?php
    $color = (empty($color)) ? '' : " box--{$color}";
?>
<section class="band hero box<?=$color; ?>">
    <div class="container hero__inner">
        <img src="<?=$image; ?>" alt="" class="hero__image">
    </div>
</section>
