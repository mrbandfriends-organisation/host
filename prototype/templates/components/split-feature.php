<?php
    $align   = (empty($align))   ? 'left' : $align;
    $color   = (empty($color))   ? ''     : " box--{$color}";
    $band    = (empty($band))    ? ''     : " band--{$band}";


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
<div class="band<?=$band; ?> split-feature -<?=$align; ?>">
    <div class="split-feature__main box<?=$color; ?>">
        <div class="split-feature__content">
            <?=$content; ?>
        </div>
    </div>
    <aside class="split-feature__secondary">
        <?=$second; ?>
    </aside>
</div>
