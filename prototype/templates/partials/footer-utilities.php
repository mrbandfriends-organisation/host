<?php
    $aNav = [
        [ 'text' => 'Home',
          'url'  => '/'
        ],
        [ 'text' => 'Terms and Conditions',
          'url'  => '/about.php'
        ],
        [ 'text' => 'Partners',
          'url'  => '/about.php'
        ],
        [ 'text' => 'Privacy policy',
          'url'  => '/about.php'
        ],
        [ 'text' => 'Acceptable use policy',
          'url'  => '/about.php'
        ],
        [ 'text' => 'Careers',
          'url'  => '/about.php'
        ],
        [ 'text' => 'Agents',
          'url'  => '/about.php'
        ],
        [ 'text' => 'Sitemap',
          'url'  => '/about.php'
        ]
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
