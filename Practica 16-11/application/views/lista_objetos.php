<div class="card w-75 mx-auto mt-3">
    <h2 class="card-header text-center">Objetos</h2>
    <table class="table card_body">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Objeto</th>
                <th scope="col">Compartir</th>
                <th scope="col">Opciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($objetos as $o){
            ?>
                    <tr>
                        <th scope="row"><?php echo $o["id"]?></th>
                        <td><?php echo $o["nombre"]?></td>
                        <td>
                            <?php
                            if($o["estado"]==1){
                            ?>
                                <a class="btn btn-success" target="_blank" href="<?php echo site_url('inicio/ver/'.$o["id"])?>"><i class="bi bi-share-fill"></i></a></td>
                                <?php
                            }    
                            ?>
                        <td>
                            <a class="btn btn-warning" href="<?php echo site_url('inicio/estado/'.$o["id"].'/'.$o["estado"])?>"><i class="bi bi-eye-fill"></i></a>
                            <a class="btn btn-danger" href="<?php echo site_url('inicio/borrar/'.$o["id"])?>"><i class="bi bi-trash-fill"></i></a>
                        </td>
                    </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</div>