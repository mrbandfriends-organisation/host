<?php
    $aCity = [
        'Birmingham',
        'Cambridge',
        'Cardiff',
        'Chester',
        'Coventry',
        'Exeter',
        'Glasgow',
        'Leicester',
        'Liverpool',
        'London',
        'Manchester HCS',
        'Manchester UBS',
        'Newcastle',
        'Nottingham',
        'Oxford',
        'Plymouth',
        'Sheffield',
        'Wolverhampton'
    ];
?>
<nav class="menu-footer">
	<ul class="nav-footer js-nav-footer grid grid--divided">
        <li class="nav-footer__item nav-footer__section gc l4-6 m3-5">
            <strong class="nav-footer__section-header">
                <a href="#" class="nav-footer__link">Locations</a>
            </strong>

            <ul class="nav-footer__sublist">
            <?php foreach ($aCity AS $sCity): ?>
                <li class="nav-footer__item">
                    <a href="/city.php" class="nav-footer__link"><?=$sCity; ?></a>
                </li>
            <?php endforeach; ?>
            </ul>
        </li>
        <li class="nav-footer__item nav-footer__section gc t1-2 m1-5 l1-6">
            <strong class="nav-footer__section-header">
                <a href="/about.php" class="nav-footer__link">About Us</a>
            </strong>

            <ul class="nav-footer__sublist">
            <?php for ($i = 0; $i < 4; $i++): ?>
                <li class="nav-footer__item">
                    <a href="/about.php" class="nav-footer__link">Link here</a>
                </li>
            <?php endfor; ?>
            </ul>
        </li>
        <li class="nav-footer__item nav-footer__section gc t1-2 m1-5 l1-6">
            <strong class="nav-footer__section-header">
                <a href="#" class="nav-footer__link">Contact</a>
            </strong>

            <ul class="nav-footer__sublist">
            <?php for ($i = 0; $i < 4; $i++): ?>
                <li class="nav-footer__item">
                    <a href="#" class="nav-footer__link">Link here</a>
                </li>
            <?php endfor; ?>
            </ul>
        </li>
	</ul>
</nav>
