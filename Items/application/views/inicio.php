<div class ="container">

    <div class="card">

        <form method="post" action="<?php echo site_url('items_controller/insert_item'); ?>">
         <div class="row">
            <div class="col">
            <input type="text" class="form-control" placeholder="Item" name="item" value="<?php echo set_value('item'); ?>" required>
            </div>
            <div class="col">          
            <input type="number" class="form-control" placeholder="Cantidad" name="cantidad" min="0" value="<?php echo isset($_POST['cantidad']) ? htmlspecialchars($_POST['cantidad']) : '0'; ?>" required>
        </div>
            <div class="col">
            <button type="submit" class="btn btn-info">+</button>
            </div>
         </div>
        </form>
    </div>
    <div class = "card">
    <table class="table">
    <thead>
        <tr>
        <th scope="col">#</th>
        <th scope="col">Item</th>
        <th scope="col">Cantidad</th>
        <th scope="col">Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($items as $i){ ?>
            <tr>
                    <td scope="row"><?php echo $i["item_id"]?></td>
                    <td><?php echo $i["item"]?></td>
                    <td><?php echo $i["cantidad"]?></td>
                    <td>
                    <a class="btn btn-warning" href="<?php echo site_url('items_controller/add/'.$i["item_id"].'/'.$i["cantidad"])?>"><i class="bi bi-bookmark-plus"></i></a>
                    <a class="btn btn-danger" href="<?php echo site_url('items_controller/delete/'.$i["item_id"])?>"><i class="bi bi-trash-fill"></i></a>
                    </td>
            </tr>

        <?php } ?>
    </tbody>
    </table>

  
    </div>


</div>


