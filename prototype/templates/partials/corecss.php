<?php
    /**
     * CORE CSS
     * for production environment serve the built minified files
     */
    $cssSuffix =  ( $environment === "production" ) ? 'min.' : '';
?>
    <link rel="stylesheet" href="<?=$this->asset("/assets/css/main.{$cssSuffix}css"); ?>">
    <style><?=file_get_contents(ROOT_DIR.'/assets/css/critical.min.css'); ?></style>
    <noscript><style><?=file_get_contents(ROOT_DIR.'/assets/css/critical.no-js.min.css'); ?></style></noscript>
