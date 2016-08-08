<?php
	$this->layout('layouts::default');
?>

<main id="main-content" role="main" class="main-content">
    <?php

        $this->insert('component::billboard', [
            'color'      => 'red',
            'content'    => 'content::city/billboard'
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
        ])

    ?>
</main>
