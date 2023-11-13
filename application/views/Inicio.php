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
                        <td scope="row"><?php echo $user['user_id']; ?></td>
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

<div class = "container">
<div class="row mt-3">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <button class="btn btn-primary" id="btnCalcularPromedio">Calcular Promedio de Sueldos</button>
                <button class="btn btn-success" id="btnCalcularTotal">Calcular Total de Sueldos</button>
                <button class="btn btn-warning" id="btnMenorSueldo">Menor Sueldo</button>
                <button class="btn btn-danger" id="btnMayorSueldo">Mayor Sueldo</button>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Resultados</h5>
                <p id="resultadoPromedio">Promedio: <span class="font-weight-bold">-</span></p>
                <p id="resultadoTotal">Total: <span class="font-weight-bold">-</span></p>
                <p id="resultadoMenorSueldo">Menor Sueldo: <span class="font-weight-bold">-</span></p>
                <p id="resultadoMayorSueldo">Mayor Sueldo: <span class="font-weight-bold">-</span></p>
            </div>
        </div>
    </div>
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
            if (confirm('¿Estás seguro de que deseas eliminar este usuario?'))
            {
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

        //Calculos

        // Click calcular promedio
        $('#btnCalcularPromedio').click(function () {
            $.ajax({
                url: "<?php echo site_url('InicioController/calcular_promedio'); ?>",
                type: "GET",
                dataType: "json",
                success: function (data) {
                    $('#resultadoPromedio span').text(data.promedio.toFixed(2));
                }
            });
        });

        // Click calcular total
        $('#btnCalcularTotal').click(function () {
            $.ajax({
                url: "<?php echo site_url('InicioController/calcular_total'); ?>",
                type: "GET",
                dataType: "json",
                success: function (data) {
                    $('#resultadoTotal span').text(data.total.toFixed(2));
                }
            });
        });
        
        // Click menor sueldo
        $('#btnMenorSueldo').click(function () {
            $.ajax({
                url: "<?php echo site_url('InicioController/obtener_menor_sueldo'); ?>",
                type: "GET",
                dataType: "json",
                success: function (data) {
                    $('#resultadoMenorSueldo span').text(data.menorSueldo.toFixed(2));
                }
            });
        });

        // Click mayor sueldo
        $('#btnMayorSueldo').click(function () {
            $.ajax({
                url: "<?php echo site_url('InicioController/obtener_mayor_sueldo'); ?>",
                type: "GET",
                dataType: "json",
                success: function (data) {
                    $('#resultadoMayorSueldo span').text(data.mayorSueldo.toFixed(2));
                }
            });
        });



      });
</script>

