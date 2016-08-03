<?php
    $aCities = [
        'Aberdeen',
        'Bristol',
        'Cambridge',
        'Cardiff',
        'Coventry',
        'Exeter',
        'Leeds',
        'Leicester',
        'Liverpool',
        'London',
        'Manchester',
        'Nottingham',
        'Oxford',
        'Plymouth',
        'Sheffield',
        'Southampton'
    ];
?>

<section class="checkerboard js-checkerboard" data-checkerboard-selector=".checkerboard-item">
    <header class="checkerboard__header">
        <h1>Need a student home?<br>Let’s take a look.</h1>
    </header>
    <ul class="checkerboard__list grid">
    <?php foreach ($aCities AS $sCity): ?>
        <li class="checkerboard__item gc">
            <?php $this->insert('component::checkerboard-item', [ 'label' => $sCity ]); ?>
        </li>
    <?php endforeach; ?>
        <li class="checkerboard__sell gc">
            <div class="box box--ink">
                <h3>Featured home<br>Our latest or greatest</h3>

                <p>
                    <a href="#" class="btn btn--white btn--small">Show me featured homes</a>
                </p>
            </div>
        </li>
    </ul>
</section>
