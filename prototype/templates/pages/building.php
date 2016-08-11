<?php
	$this->layout('layouts::default');
?>

<main id="main-content" role="main" class="main-content">
    <?php

        $this->insert('component::billboard', [
            'color'      => 'sky',
            'content'    => 'content::building/billboard',
            'second'     => 'content::building/billboard-aside'
        ]);

        $this->insert('component::room-list/index', [
            'title' => 'Need a room<br>Let’s find you a place',
			'intro' => 'All our rooms have been designed to help you make the most of your time at university. They will be ultra modern, and include lots of little luxuries like high-tech kitchens and beautiful bathrooms. All pictures are indicative as all rooms slightly vary.',
            'rooms' => [
                [
                    'title' =>  'Premium Studio',
                    'status' => [
                        'color' => 'mint',
                        'text'  => 'Available'
                    ],
                    'description' => 'Double bed. Fitted wardrobe Plenty of storage. All en-suite. Shared kitchen. Appliances.',
                    'price'       => '412',
                    'images'      => [
                        '/_dummy/properties/room-ss1.jpg',
                        '/_dummy/properties/room-ss2.jpg',
                        '/_dummy/properties/room-ss3.jpg'
                    ]
                ],
                [
                    'title' =>  'Large studio room',
                    'status' => [
                        'color' => 'red',
                        'text'  => 'Sold out.'
                    ],
                    'description' => 'Double bed. Fitted wardrobe Plenty of storage. All en-suite. Shared kitchen. Appliances.',
                    'price'       => '386',
                    'images'      => [
                        '/_dummy/properties/room-ss1.jpg',
                        '/_dummy/properties/room-ss2.jpg',
                        '/_dummy/properties/room-ss3.jpg'
                    ]
                ],
                [
                    'title' =>  'En-suite room',
                    'status' => [
                        'color' => 'orange',
                        'text'  => 'Limited availability.'
                    ],
                    'description' => 'Double bed. Fitted wardrobe Plenty of storage. All en-suite. Shared kitchen. Appliances.',
                    'price'       => '309',
                    'images'      => [
                        '/_dummy/properties/room-ss1.jpg',
                        '/_dummy/properties/room-ss2.jpg',
                        '/_dummy/properties/room-ss3.jpg'
                    ]
                ]
            ]
        ]);

        $this->insert('component::split-feature', [
            'color'   => 'ink',
            'content' => 'content::city/whats-it-like-left',
            'second'  => 'content::city/whats-it-like-right'
        ]);

        $this->insert('component::map', [
            'fg'      => 'grape',
            'place'   => 'Victoria Hall King\'s Cross Student Accommodation',
            'centre'  => '51.5392,-0.1261',
            'filters' => true,
            'markers' => [
                'transport' => [
                    [ 'title' => 'Camden Road Overground',       'lat' => 51.5418, 'lng' => -0.1388 ],
                    [ 'title' => 'Angel Tube Station',           'lat' => 51.532,  'lng' => -0.106  ],
                    [ 'title' => 'St Pancras International',     'lat' => 51.5314, 'lng' => -0.1262 ],
                    [ 'title' => 'King’s Cross Station',         'lat' => 51.5317, 'lng' => -0.1243 ],
                    [ 'title' => 'King’s Cross St Pancras tube', 'lat' => 51.5302, 'lng' => -0.1241 ],
                    [ 'title' => 'Caledonian Road Overground',   'lat' => 51.5432, 'lng' => -0.1145 ]
                ],
                'shops' => [
                    [ 'title' => 'Nike Central King’s Cross',    'lat' => 51.5335, 'lng' => -0.1247 ]
                ],
                'food' => [
                    [ 'title' => 'German Gymnasium',             'lat' => 51.5324, 'lng' => -0.1254 ],
                    [ 'title' => 'Mildred’s',                    'lat' => 51.5404, 'lng' => -0.1450 ]
                ],
                'unis' => [
                    [ 'title' => 'Central St Martin’s',          'lat' => 51.5364, 'lng' => -0.1269 ]
                ]
            ]
        ]);

        $this->insert('component::billboard', [
            'color'      => 'grape',
            'content'    => 'content::city/second-billboard',
            'background' => '/_dummy/asian-girl-alpha.png'
        ]);

    ?>
</main>
