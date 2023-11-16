<div class="card w-50 mt-5 mx-auto">
    <form class="card-body" method="post" action="<?php echo site_url("ingresar/ingresar")?>">
        <div class="form-group">
            <label>Usuario</label>
            <input type="text" class="form-control" name="usuario" >
        </div>
        <div class="form-group">
            <label>Contraseña</label>
            <input type="password" class="form-control" name="pass">
        </div>
        <button type="submit" class="btn btn-primary">Ingresar</button>
    </form>
</div>