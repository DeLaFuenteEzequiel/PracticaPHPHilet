

<div class="container">
    <div class="row mt-5">
        <div class="col-md-6 offset-md-3">
            <h2 class="text-center">Iniciar Sesión</h2>
            <form class="card" method="post" action=<?php echo site_url("LoginController/validate_login")?> >
                <div class="form-group">
                    <label for="user">Usuario</label>
                    <input type="text" class="form-control" id="user" name="user" required>
                </div>
                <div class="form-group">
                    <label for="password">Contraseña</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <button type="submit" class="btn btn-primary" id="loginButton">Iniciar Sesión</button>
                
            </form>
           
        </div>
    </div>
</div>



