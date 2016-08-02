<?php
    $aCities = [
        'Aberdeen', 'Bristol', 'Cambridge', 'Cardiff', 'Coventry', 'Exeter', 'Leeds', 'Leicester', 'Liverpool', 'London',
        'Manchester', 'Nottingham', 'Oxford', 'Plymouth', 'Sheffield', 'Southampton'
    ];
?>

<section class="checkerboard">
    <header class="checkerboard__header">
        <h1>Need a student home?<br>Let’s take a look.</h1>
    </header>
    <ul class="checkerboard__list grid">
    <?php foreach ($aCities AS $sCity): ?>
        <li class="checkerboard__item gc l1-6 m1-4 s1-2">
            <?php $this->insert('component::checkerboard-item', [ 'label' => $sCity ]); ?>
        </li>
    <?php endforeach; ?>
    </ul>
</section>
