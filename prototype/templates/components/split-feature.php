<?php
    $align       = (empty($align))   ? 'left' : $align;
    $color       = (empty($color))   ? ''     : " box--{$color}";
    $band        = (empty($band))    ? ''     : " band--{$band}";
    $modifier    = (empty($modifier))    ? ''     : "$modifier";


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
<section class="band<?=$band; ?> split-feature -<?=$align; ?> grid">
    <div class="split-feature__main box<?=$color; ?> gc l1-2">
        <div class="split-feature__content">
            <?=$content; ?>
        </div>
    </div>
    <aside class="split-feature__secondary gc l1-2">
        <?=$second; ?>
    </aside>
</section>
