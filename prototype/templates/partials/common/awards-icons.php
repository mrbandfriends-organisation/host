<?php
    $aAward = [
        '2015 Best individual accommodation',
        '2015 Best value for money',
        '2015 Best value for money',
        'Quality mark',
        '2015 Best individual acommodation',
        'Quality mark for international accommodation'
    ];
?>

<ul class="awards">
<?php foreach ($aAward AS $idx => $sAlt): ?>
    <li class="awards__item">
        <img src="/_dummy/awards/<?=($idx+1); ?>.png" alt="<?=esc_attr($sAlt); ?>" class="awards__image">
    </li>
<?php endforeach; ?>
</ul>
