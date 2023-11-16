<div class="card w-25 mx-auto my-5">
  <div class="card-header text-center">
    <?php echo $objeto["nombre"]?>
  </div>
  <div class="card-body text-center">
    <p class="card-text"><?php echo $objeto["descripcion"]?></p>
    <h5 class="card-title">$ <?php echo $objeto["precio"]?></h5>
  </div>
  <div class="card-footer">
      <a class="btn btn-primary" href="<?php echo site_url('inicio/index')?>">Regresar</a>
  </div>
</div>