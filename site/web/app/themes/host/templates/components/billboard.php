<?php
    $main_modifier   = (empty($main_modifier))  ? '' : 'billboard__main--' . $main_modifier;
    $second_modifier = (empty($second_modifier))  ? '' : $second_modifier;
    $align           = (empty($align))     ? 'left' : $align;
    $color           = (empty($color))     ? ''     : " box--{$color}";
    $add_class       = (empty($add_class)) ? ''     : ' '.esc_attr($add_class);

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

    $sBg = (empty($background)) ? null : ' style="background-image:url('.esc_attr($background).')"';
?>
<section class="band billboard -<?=$align; ?> box<?=$color.$add_class; ?>">
    <div class="container billboard__inner grid"<?=$sBg; ?>>
        <div class="billboard__main <?= esc_attr($main_modifier); ?> l3-5">
            <?=$content; ?>
        </div>
        <?php if (!empty($second)): ?>
        <aside class="billboard__secondary l-30pc <?= esc_attr($second_modifier); ?>">
            <?=$second; ?>
        </aside>
        <?php endif; ?>
    </div>
</section>
