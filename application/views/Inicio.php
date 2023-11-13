<div class="container">
    <div class="card">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Usuario</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Antiguedad</th>
                    <th scope="col">Salario</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <th scope="row"><?php echo $user['user_id']; ?></th>
                        <td class="user-data" data-field="user"><?php echo $user['user']; ?></td>
                        <td class="user-data" data-field="name"><?php echo $user['name']; ?></td>
                        <td class="user-data" data-field="name"><?php echo $user['antiquity']; ?></td>
                        <td class="user-data" data-field="name"><?php echo $user['salary']; ?></td>
                        <td>
                            <button class="btn btn-info btn-ver" data-user-id="<?php echo $user['user_id']; ?>">Ver</button>
                            <button class="btn btn-warning btn-modificar" data-user-id="<?php echo $user['user_id']; ?>">Modificar</button>
                            <button class="btn btn-danger btn-eliminar" data-user_id="<?php echo $user['user_id']; ?>">Eliminar</button>

                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function() {

        // Click ver
        $('.btn-ver').click(function() {
            var user = $(this).closest('tr').find('td[data-field="user"]').text(); //find busca la fila mas cercana
            var name = $(this).closest('tr').find('td[data-field="name"]').text();
            alert('Usuario: ' + user + '\nNombre: ' + name);
        });
        

        // Click eliminar
        $('.btn-eliminar').click(function() {
            var userId = $(this).data('user_id');
             // console.log('User ID:', userId);  
            if (confirm('¿Estás seguro de que deseas eliminar este usuario?')) {
                $.ajax({
                    url: "<?php echo site_url('InicioController/delete_ajax/'); ?>" + userId,
                    type: "POST",
                    contentType: "application/json", 
                    data: JSON.stringify({}), 
                    dataType: "json",
                    success: function(data) {
                        //console.log(data);
                        if (data.status === 'success') {
                            alert('Usuario eliminado correctamente.');
                            location.reload(); //buenisimo para recargar pagina ¿asincronico?
                        } else {
                            alert('Error al eliminar el usuario.');
                        }
                    },                   
                // error: function(jqXHR, textStatus, errorThrown) {
                //     console.log('AJAX Error: ' + textStatus);
                //     console.log('Error Thrown: ' + errorThrown);
                // }
                });
            }
        });



// Click modificar
$('.btn-modificar').click(function() {
    var userId = $(this).data('user_id');
    var user = $(this).closest('tr').find('td[data-field="user"]');
    var name = $(this).closest('tr').find('td[data-field="name"]');

    // Implementa la lógica para editar el usuario, por ejemplo, abrir un modal con un formulario de edición
    var newUser = prompt('Modificar usuario:', user.text());
    var newName = prompt('Modificar nombre:', name.text());

    if (newUser !== null && newName !== null) {
        // AJAX para modificar el usuario
        $.ajax({
    url: "<?php echo site_url('InicioController/modify_ajax/') ?>" + userId,
    type: "POST",
    contentType: "application/json",
    data: JSON.stringify({ user: newUser, name: newName }),
    dataType: "json",
    success: function(data) {
        if (data.status === 'success') {
            alert('Usuario modificado correctamente.');
            // Puedes actualizar dinámicamente los datos en la tabla si es necesario
            user.text(newUser);
            name.text(newName);
        } else {
            alert('Error al modificar el usuario: ' + data.message);
        }
    },
    error: function(jqXHR, textStatus, errorThrown) {
        console.log('AJAX Error: ' + textStatus);
        console.log('Error Thrown: ' + errorThrown);
    }
});


    }
});


    });
</script>

