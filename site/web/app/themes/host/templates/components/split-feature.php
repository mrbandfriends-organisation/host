<?php
    Use Roots\Sage\Utils;

    $align               = (empty($align))   ? 'left' : $align;
    $color               = (empty($color))   ? ''     : " box--{$color}";
    $band                = (empty($band))    ? ''     : " band--{$band}";
    $modifier            = (empty($modifier))    ? ''     : "$modifier";
    $main_modifier       = (empty($main_modifier) ? '' : "split-feature__main--{$main_modifier}" );
    $secondary_modifier  = (empty($secondary_modifier) ? '' : "split-feature__secondary--{$secondary_modifier}" );

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
<section class="band<?= esc_attr($band); ?> split-feature -<?= esc_attr($align); ?> grid">
    <div class="split-feature__main <?php echo esc_attr($main_modifier) ?> box<?= esc_attr($color); ?> gc l1-2">
        <div class="split-feature__content">
            <?= $content; ?>
        </div>
    </div>
    <aside class="split-feature__secondary <?php echo esc_attr($secondary_modifier) ?> gc l1-2">
        <?= $second; ?>
    </aside>
</section>
