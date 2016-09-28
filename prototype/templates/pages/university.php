<?php
	$this->layout('layouts::default');
?>

<main id="main-content" role="main" class="main-content">
    <?php
        $this->insert('component::hero', [
            'image' => '/_dummy/laptop-bars.jpg'
        ]);

        $this->insert('component::split-feature', [
            'color'   => 'red',
            'align'   => 'right',
            'content' => 'content::university/ual',
            'second'  => '<img src="_dummy/ual.jpg" alt="">'
        ]);

        $this->insert('component::split-feature', [
            'color'   => 'sky',
            'content' => 'content::university/featured',
            'second'  => 'content::university/featured-imgs'
        ]);

        $this->insert('partials::common/awards');

    ?>
</main>
