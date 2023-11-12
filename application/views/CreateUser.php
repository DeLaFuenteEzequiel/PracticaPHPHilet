<form method="post" action="<?php echo site_url('InicioController/insert_user'); ?>">
  <div class="form-group">
    <label for="exampleInputEmail1">Nombre de Usuario</label>
    <input type="text" class="form-control" id="user" name="user">
  </div>

  <div class="form-group">
    <label for="exampleInputPassword1">Contraseña</label>
    <input type="password" class="form-control" id="password" name ="password">
  </div>

  <div class="form-group">
    <label for="exampleInputEmail">Nombre Real</label>
    <input type="text" class="form-control" id="name" name ="name">
  </div>
 
  <button type="submit" class="btn btn-primary">Agregar Usuario</button>
</form>