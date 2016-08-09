<?php
	$this->layout('layouts::default');
?>

<main id="main-content" role="main" class="main-content">
    <?php

        $this->insert('component::billboard', [
            'color'      => 'red',
            'content'    => 'content::city/billboard',
            'background' => '/_dummy/bus-bars-alpha.png',
            'add_class'  => '-bg-actual-size'
        ]);

        $this->insert('component::room-list', [
            'title' => 'Properties<br>in London',
            'rooms' => [
                [
                    'fg'          => 'sky',
                    'title'       => 'Kings Cross.',
                    'status'      => 'Rooms Available.',
                    'subtitle'    => '5 room types available.',
                    'description' => 'Victoria Hall King’s Cross is the perfect location to live in central London as a student. Located within Zone 1, minutes from King’s Cross International train station and underground station. Victoria Hall King’s Cross offers an exceptional living experience designed by award winning architects.',
                    'address'     => '25 Canal Reach<br>London<br>N1C 4DD',
                    'phone'       => '020 3475 5980',
                    'cta'         => 'Take me to the website',
                    'price'       => 412,
                    'photo'       => '/_dummy/properties/kings-cross.jpg'
                ],
                [
                    'fg'          => 'sky',
                    'title'       => 'Paul St. East.',
                    'status'      => 'Rooms Available.',
                    'subtitle'    => '1 room type available.',
                    'description' => 'Paul St. East is a new kind of student accommodation in the heart of London’s exciting East End. Featuring two floors of inspirational social, study and networking spaces, an urban garden, private courtyard and 24/7 fitness facilities – Paul St. East is the perfect home away from home',
                    'address'     => '16 Paul Street<br>London<br>EC2A 4JH',
                    'phone'       => '020 3475 5980',
                    'cta'         => 'Show me this property',
                    'price'       => 285,
                    'photo'       => '/_dummy/properties/paul-st.jpg'
                ],
                [
                    'fg'          => 'orange',
                    'title'       => 'Wembley.',
                    'status'      => 'Limited availability.',
                    'subtitle'    => '4 room types available.',
                    'description' => 'Situated less than 15 minutes from central London, close to the iconic Wembley Stadium and just minutes from Wembley Park underground station, Victoria Hall Wembley offers modern student accommodation in London that is comfortable, stylish and affordable. Deluxe, Studio and Penthouse Available.',
                    'address'     => 'North End Road<br>Wembley<br>Middlesex<br>HA9 0UU',
                    'phone'       => '020 3475 5980',
                    'cta'         => 'Show me this property',
                    'price'       => 277,
                    'photo'       => '/_dummy/properties/wembley.jpg'
                ],
                [
                    'fg'          => 'red',
                    'title'       => 'One Penrhyn Road.',
                    'status'      => 'Sold Out.',
                    'subtitle'    => 'No room types available.',
                    'description' => 'It offers modern student accommodation in London that is comfortable, stylish and affordable. Travelling distance of many of the Universities and Colleges as well as all the excitement offered in Central London.',
                    'address'     => '1 Penrhyn Road,<br>Kingston Upon Thames<br>KT1 2BT',
                    'phone'       => '020 3475 5980',
                    'cta'         => 'Add me to waiting list',
                    'price'       => 253,
                    'photo'       => '/_dummy/properties/penrhyn.jpg'
                ]
            ]
        ]);

        $this->insert('component::split-feature', [
            'color'   => 'ink',
            'content' => 'content::city/whats-it-like-left',
            'second'  => 'content::city/whats-it-like-right'
        ]);

        $this->insert('component::map', [
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
