<div class="container">
    <div class="card">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Usuario</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <th scope="row"><?php echo $user['user_id']; ?></th>
                        <td><?php echo $user['user']; ?></td>
                        <td><?php echo $user['name']; ?></td>
                        <!-- Añade botones de acciones según tus necesidades -->
                        <td>
                            <a href="<?php echo site_url('InicioController/ver/' . $user['user_id']); ?>" class="btn btn-info">Ver</a>
                            <a href="<?php echo site_url('InicioController/modificar/' . $user['user_id']); ?>" class="btn btn-warning">Modificar</a>
                            <a href="<?php echo site_url('InicioController/eliminar/' . $user['user_id']); ?>" class="btn btn-danger">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
