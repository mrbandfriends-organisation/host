<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js <?php echo ($use_web_fonts) ? '' : 'no-webfonts'; ?> lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js <?php echo ($use_web_fonts) ? '' : 'no-webfonts'; ?> lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js <?php echo ($use_web_fonts) ? '' : 'no-webfonts'; ?> lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js <?php echo ($use_web_fonts) ? '' : 'no-webfonts'; ?>"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title><?=$this->e($site_name)?></title>
        <meta name="description" content="<?=$this->e($site_desc);?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <?php if ( $environment !== "production" ) : ?>
            <meta name="robots" content="index, follow">
        <?php endif; ?>
        
        <?php $this->insert('partials::meta-icons'); ?>

        <?php $this->insert('partials::fastboot-html-classes'); ?>

        <?php $this->insert('partials::corecss'); ?>

        <?php $this->insert('partials::polyfills'); ?>
    </head>
    <body>
        <?php $this->insert('partials::browserupgrade'); ?>