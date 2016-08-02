<?php
    $aNav = [
        [ 'text' => 'FAQs' ],
        [ 'text' => 'Favourites '.$this->fetch('partials::shared/icon', [ 'icon' => 'heart' ]) ]
    ];
?>
<nav class="menu-utilities menu-utilities--<?php echo $modifier; ?>">
	<ul class="nav-utilities nav-utilities--<?php echo $modifier; ?> js-nav-primary">
	<?php foreach ($aNav AS $aN): ?>
		<li class="nav-utilities__item">
			<a href="<?=(empty($aN['url']) ? '#' : $aN['url']); ?>" class="nav-utilities__link"><?=$aN['text']; ?></a>
		</li>
	<?php endforeach; ?>
	</ul>
</nav>
