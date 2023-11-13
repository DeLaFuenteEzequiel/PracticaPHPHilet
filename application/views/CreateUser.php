
<div class = "container">
<div class= "row">
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

  <div class="form-group">
    <label for="exampleInputEmail">Antiguedad</label>
    <input type="text" class="form-control" id="antiquity" name ="antiquity">
  </div>

  <div class="form-group">
    <label for="exampleInputEmail">Salario</label>
    <input type="text" class="form-control" id="salary" name ="salary">
  </div>
 
  <button type="submit" class="btn btn-primary">Agregar Usuario</button>
</form>
</div>
</div>