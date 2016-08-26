<?php
    $aNav = [
        [
            'text' => '<span>Locations</span> around the UK.',
            'url'  => '/city.php'
        ],
        [
            'text' => '<span>About</span> Host Students.',
            'url'  => '/about.php'
        ],
        [ 'text' => '<span>News</span> and views.' ],
        [ 'text' => '<span>Contact</span> Host here.' ]
    ];
?>
<nav class="menu-primary menu-primary--<?php echo $modifier; ?>">
	<ul class="nav-primary nav-primary--<?php echo $modifier; ?> js-nav-primary">
	<?php foreach ($aNav AS $aN): ?>
		<li class="nav-primary__item">
			<a href="<?=(empty($aN['url']) ? '#' : $aN['url']); ?>" class="nav-primary__link"><?=$aN['text']; ?></a>
		</li>
	<?php endforeach; ?>
        <li class="nav-primary__item">
            <a href="#" class="btn btn--small btn--narrow">Choose language</a>
        </li>
	</ul>
</nav>
