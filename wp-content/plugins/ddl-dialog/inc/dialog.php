<div class="ddl-dialog ddl-dialog--<?php echo $ddl_dialog_post_Id ?>"role="dialog" aria-modal="false" id="ddlDialog">
  
  <div class="ddl-dialog__backdrop" data-dialog-close></div>
  
  <div class="ddl-dialog__inner">
    
    <div class="ddl-dialog__body">

      <button class="ddl-dialog__close" data-dialog-close>
        <span class="ddl-dialog__icon">
          <svg role="img"><use xlink:href="#cross" href="#cross"></use></svg> <!-- change to backgroung img -->
        </span>
        <span class="hidden">Close</span>
      </button>

      <?php the_content(); ?>

    </div>

  </div>

</div>