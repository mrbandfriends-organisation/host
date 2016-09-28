<?php
	$this->layout('layouts::default');
?>

<main id="main-content" role="main" class="main-content">
    <?php
        $this->insert('component::checkerboard');

        $this->insert('component::split-feature', [
            'color'   => 'orange',
            'align'   => 'right',
            'content' => 'content::home/best-reasons',
            'second'  => '<img src="_dummy/clock-bars.jpg" alt="">'
        ]);

        $this->insert('component::split-feature', [
            'color'   => 'sky',
            'content' => 'content::home/featured-home',
            'second'  => 'content::home/featured-home-imgs'
        ]);

        $this->insert('partials::common/awards');

        $this->insert('component::split-feature', [
            'color'   => 'grape',
            'align'   => 'right',
            'content' => 'content::home/investors',
            'second'  => 'content::home/investors-imgs'
        ]);
    ?>
</main>
