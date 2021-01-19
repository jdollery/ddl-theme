<form class="search" role="search" method="get" action="<?php echo home_url( '/' ); ?>">
  <div class="input-group">
    <div class="input-group-prepend">
      <span class="input-group-text pr-0"><i class="fa fa-search"></i></span>
    </div>
    <input type="text" name="s" id="s" class="form-control" placeholder="I’m looking for…" aria-label="Search" autocomplete="off" required/>
    <div class="input-group-append">
      <button type="submit" id="searchsubmit" class="button-primary">Search</button>
    </div>
  </div>
</form>