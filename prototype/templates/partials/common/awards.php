<?php $this->insert('component::split-feature', [
    'band'    => 'inset',
    'color'   => 'fg-mint',
    'content' => 'content::common/awards',
    'second'  => $this->fetch('partials::common/awards-icons')
]);
