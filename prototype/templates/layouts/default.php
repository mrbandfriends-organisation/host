<?php $this->insert('head'); ?>        

    <div class="offcanvas__wrapper js-offcanvas__wrapper">
        <div id="page" class="page offcanvas__body js-offcanvas-body">  
            <?php $this->insert('banner'); ?>

                <?=$this->section('content')?> 

            <?php $this->insert('footer'); ?>                  
        </div>
        <?php $this->insert('partials::primary-offcanvas'); ?>
    </div>

<?php $this->insert('close'); ?> 
   


    
