<?php
    include 'global/config.php';
    include 'carrito.php';
    include 'templates/header.php'
?>

<div class="container">
    <br>
    <h2>Carrito</h2>
    <?php if (!empty($_SESSION['CARRITO'])){?>
    <p>Productos agregados al carrito</p>
    <table class="table table-striped">
        <thead>
        <tr>
            <th width="35%" class="text-center">Título</th>
            <th class="text-center">Cantidad</th>
            <th class="text-center">Precio</th>
            <th class="text-center">Subtotal</th>
            <th class="text-center">Opciones</th>
        </tr>
        </thead>
        <tbody>
        <?php $total=0; ?>
        <?php  foreach ($_SESSION['CARRITO'] as $indice=>$producto){?>
        <tr>
            <td class="text-center"><?php echo $producto['NOMBRE'] ?></td>
            <td class="text-center"><?php echo $producto['CANTIDAD'] ?></td>
            <td class="text-center">$ <?php echo $producto['PRECIO'] ?></td>
            <td class="text-center">$ <?php echo number_format($producto['PRECIO']*$producto['CANTIDAD'],2) ?></td>
            <form action="" method="post">
                <input type="hidden" name="id" id="id" value="<?php echo openssl_encrypt($producto['ID'],COD,KEY);?>">
                <td class="text-center"><button class="btn btn-danger" type="submit" name="btnAccion" value="Eliminar" >Eliminar</button></td>
            </form>

        </tr>
        <?php $total+=$producto['PRECIO']*$producto['CANTIDAD'] ?>
        <?php } ?>
        <tr>
            <td colspan="3" align="right"><h3>Total</h3></td>
            <td align="center"><h3>$ <?php echo number_format($total,2)?></h3></td>
        </tr>
        </tbody>
    </table>
    <?php  }
        else{ ?>
            <br>
    <div class="alert alert-success">
        No hay productos agregados al carrito
    </div>
    <?php  } ?>
</div>

<?php
    include 'templates/footer.php';
?>
