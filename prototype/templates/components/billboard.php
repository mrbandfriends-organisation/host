<?php
    $align   = (empty($align))   ? 'left' : $align;
    $color   = (empty($color))   ? ''     : " box--{$color}";

    if (empty($content))
    {
        $content = '';
    }
    elseif (preg_match('/^content::/', $content))
    {
        $content = $this->fetch($content);
    }

    if (empty($second))
    {
        $second = '';
    }
    elseif (preg_match('/^content::/', $second))
    {
        $second = $this->fetch($second);
    }

    $sBg = (empty($background)) ? '' : ' style="background-image:url('.esc_attr($background).')"';
?>
<section class="band billboard -<?=$align; ?> box<?=$color; ?>">
    <div class="container billboard__inner grid"<?=$sBg; ?>>
        <div class="billboard__main m3-5">
            <?=$content; ?>
        </div>
        <?php if (!empty($second)): ?>
        <aside class="billboard__secondary m2-5">
            <?=$second; ?>
        </aside>
        <?php endif; ?>
    </div>
</section>
