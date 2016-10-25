<?php
    Use Roots\Sage\Utils;

    $align           = (empty($align))   ? 'left' : $align;
    $color           = (empty($color))   ? ''     : " box--{$color}";
    $band            = (empty($band))    ? ''     : " band--{$band}";
    $modifier        = (empty($modifier))    ? ''     : "split-feature--{$modifier}";
    $main_modifier   = (empty($main_modifier) ? '' : "split-feature__main--{$main_modifier}" );
    $second_modifier = (empty($second_modifier) ? '' : "split-feature__secondary--{$second_modifier}" );

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
?>
<section class="band<?= esc_attr($band); ?> split-feature -<?= esc_attr($align); ?> <?= esc_attr($modifier); ?> grid">
    <div class="split-feature__main <?php echo esc_attr($main_modifier) ?> box<?= esc_attr($color); ?> gc l1-2">
        <div class="split-feature__content">
            <?= $content; ?>
        </div>
    </div>
    <aside class="split-feature__secondary <?php echo esc_attr($second_modifier) ?> gc l1-2">
        <?=$second; ?>
    </aside>
</section>
