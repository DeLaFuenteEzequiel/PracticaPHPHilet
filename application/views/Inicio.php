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
                        <td class="user-data" data-field="antiquity"><?php echo $user['antiquity']; ?></td>
                        <td class="user-data" data-field="salary"><?php echo $user['salary']; ?></td>
                        <td>
                            <button class="btn btn-info btn-ver" data-user-id="<?php echo $user['user_id']; ?>">Ver</button>
                            <button class="btn btn-warning btn-modificar" data-user-id="<?php echo $user['user_id']; ?>">Modificar</button>
                            <button class="btn btn-danger btn-eliminar" data-user_id="<?php echo $user['user_id']; ?>">Eliminar</button>
                            <button class="btn btn-success btn-guardar" data-user-id="<?php echo $user['user_id']; ?>" style="display: none;">Guardar</button>
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
            var antiquity = $(this).closest('tr').find('td[data-field="antiquity"]').text();
            var salary = $(this).closest('tr').find('td[data-field="salary"]').text();
            alert('Usuario: ' + user + '\nNombre: ' + name + '\nAntiguedad: ' + antiquity + '\nSalario: ' + salary);
        });
        

        // Click eliminar
        $('.btn-eliminar').click(function() {
            var userId = $(this).data('user_id'); 
            if (confirm('¿Estás seguro de que deseas eliminar este usuario?')) {
                $.ajax({
                    url: "<?php echo site_url('InicioController/delete_ajax/'); ?>" + userId,
                    type: "POST",
                    contentType: "application/json", 
                    data: JSON.stringify({}), 
                    dataType: "json",
                    success: function(data) {
                        if (data.status === 'success') {
                            alert('Usuario eliminado correctamente.');
                            location.reload(); //buenisimo para recargar pagina ¿asincronico?
                        } else {
                            alert('Error al eliminar el usuario.');
                        }
                    },                   
                });
            }
        });

        //Click modificar
        $('.btn-modificar').click(function() {
            var row = $(this).closest('tr');
            row.find('.user-data').each(function() {
                var value = $(this).text();
                var field = $(this).data('field');
                $(this).html('<input type="text" class="form-control" value="' + value + '" data-field="' + field + '">');
            });
            row.find('.btn-modificar, .btn-eliminar').hide();
            row.find('.btn-guardar').show();
        });

        //Click guardar
        $('.btn-guardar').click(function() {
            var row = $(this).closest('tr');
            var userId = $(this).data('user-id');
            var userData = {};

            row.find('.user-data input').each(function() {
                var field = $(this).data('field');
                var value = $(this).val();
                userData[field] = value;
            });
            $.ajax({
                url: "<?php echo site_url('InicioController/update_user_ajax/'); ?>" + userId,
                type: "POST",
                contentType: "application/json",
                data: JSON.stringify(userData),
                dataType: "json",
                success: function(data) {
                    if (data.status === 'success') {
                        alert('Usuario actualizado correctamente.');
                        location.reload();
                    } else {
                        alert('Error al actualizar el usuario.');
                    }
                },
            });
        });

      });
</script>

