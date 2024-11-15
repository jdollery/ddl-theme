<div class="dialog" role="dialog" id="dialog" aria-labelledby="dialogLabel" aria-modal="true">
  <span class="dialog__overlay" id="dialogClose" aria-label="Close dialog"></span>
  <div class="dialog__inner">
    <button class="dialog__close" id="dialogClose" aria-label="Close dialog"><span class="hidden">Close</span></button>
    <div class="dialog__slot">
      <h3 id="dialogLabel" class="hidden">Promotional advert</h3>
      <?php dynamic_sidebar('dialog-slot'); ?>
    </div>
  </div>
</div>  