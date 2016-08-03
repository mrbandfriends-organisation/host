<?php
    if (!isset($label))
    {
        $label = 'My City';
    }

    $sPath = '/_dummy/checkerboard/'.strtolower($label).'-tile.jpg';
    $sAttr = (file_exists(ROOT_DIR.$sPath)) ? " style=\"background-image:url({$sPath});\"" : '';
?>
<article class="checkerboard-item js-checkerboard__item">
    <header class="checkerboard-item__title"<?=$sAttr;?>>
        <a href="#" class="checkerboard-item__link js-checkerboard__trigger"><?=$label; ?></a>
    </header>
    <div class="checkerboard-item__content">
        <p class="checkerboard-item__availability">
            <?=mt_rand(1, 20); ?> properties available
            <a href="#" class="btn btn--very-small btn--narrow">Show me homes</a>
        </p>
        <p class="checkerboard-item__feeling-lucky">
            I’m feeling lucky:
            <a href="#" class="btn btn--very-small btn--narrow btn--grape">Find me a student home</a>
        </p>
    </div>
</article>
