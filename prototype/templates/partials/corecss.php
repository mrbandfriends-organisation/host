<?php 
    /**
     * CORE CSS
     * for production environment serve the built minified files
     */
    $cssSuffix =  ( $environment === "production" ) ? 'min.' : '';
?>  
<!--[if lte IE 8]>
    <link rel="stylesheet" href="<?=$this->asset("/assets/css/main-oldie.{$cssSuffix}css"); ?>">
<![endif]-->
<!--[if gt IE 8]><!-->
    <link rel="stylesheet" href="<?=$this->asset("/assets/css/main.{$cssSuffix}css"); ?>">
<!--<![endif]-->