<?php
    $aNav = [
        [ 'text' => 'Home' ],
        [ 'text' => 'Terms and Conditions' ],
        [ 'text' => 'Partners' ],
        [ 'text' => 'Privacy policy'],
        [ 'text' => 'Acceptable use policy' ],
        [ 'text' => 'Careers' ],
        [ 'text' => 'Agents' ],
        [ 'text' => 'Sitemap' ]
    ];
?>
<nav class="menu-footer-utilities">
	<ul class="nav-footer-utilities js-nav-footer-utilities">
        <li class="nav-footer-utilities__item">© Host Students 2016</li>
	<?php foreach ($aNav AS $aN): ?>
		<li class="nav-footer-utilities__item">
			<a href="<?=(empty($aN['url']) ? '#' : $aN['url']); ?>" class="nav-footer-utilities__link"><?=$aN['text']; ?></a>
		</li>
	<?php endforeach; ?>
	</ul>
</nav>
