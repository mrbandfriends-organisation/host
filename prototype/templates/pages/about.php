<?php
	$this->layout('layouts::default');
?>

<main id="main-content" role="main" class="main-content">
    <?php
        $this->insert('component::hero', [
            'image' => '/_dummy/key-bars.jpg'
        ]);

        $this->insert('component::billboard', [
            'color'      => 'mint-alt',
            'content'    => 'content::about/hi-there',
            'background' => '/_dummy/dude-alpha.png'
        ]);

        $this->insert('component::split-feature', [
            'color'   => 'fg-red',
            'content' => 'content::about/hassle-free'
        ]);

        $this->insert('component::split-feature', [
            'color'   => 'red',
            'content' => 'content::about/never-hidden',
            'second'  => $this->fetch('component::bleed-image', [ 'image' => '/_dummy/staff-phot.jpg' ])
        ]);
    ?>
</main>
