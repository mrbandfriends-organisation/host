<?php
	$this->layout('layouts::component');
?>

<main id="main-content" role="main" class="main-content">
	<div class="band <?php if ( !empty($classnames) ): echo $classnames; endif; ?>">
        <?php $this->insert('components::'.$component); ?>
	</div>
</main>
