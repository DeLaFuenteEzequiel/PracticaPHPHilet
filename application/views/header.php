<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
</head>
<body>

<?php
// Verifica si el controlador y el método no son "LoginController" e "index"
if ($this->router->fetch_class() !== 'LoginController' || $this->router->fetch_method() !== 'index') {
    ?>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Administrador</a>

        <!-- Botón para colapsar la barra de navegación en dispositivos pequeños -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Estructura de la barra de navegación -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="<?php echo site_url('InicioController/index'); ?>">Usuarios</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo site_url('InicioController/create'); ?>">Agregar Usuario</a>
                </li>
            </ul>
        </div>
    </nav>
    <?php
}
?>

<div class="container">
    <!-- Resto del contenido de la página se mantiene aquí -->