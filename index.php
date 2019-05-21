<?php
    include 'global/config.php';
    include 'global/conexion.php';
    include 'carrito.php';
    include 'templates/header.php'
?>

    <div class="container">
    <br>
        <?php if ($mensaje!=""){ ?>
        <div class="alert alert-success" role="alert">
            <?php echo $mensaje; ?>
            <a href="mostrarCarrito.php" class="badge badge-success">Ver carrito</a>
        </div>
        <?php }?>
        <br>
        <div class="row">
            <?php
                $sentencia = $pdo->prepare("SELECT * FROM `tblproductos`");
                $sentencia->execute();
                $listaProductos=$sentencia->fetchAll(PDO:: FETCH_ASSOC);
                //print_r($listaProductos);
            ?>
            <?php
                foreach ($listaProductos as $producto){
            ?>
            <div class="col-md-3">
                <div class="card">
                    <img src="<?php echo $producto['IMAGEN'];?>"
                         title="<?php echo $producto['NOMBRE'];?>"
                         class="card-img-top"
                         alt="<?php echo $producto['NOMBRE'];?>"
                         data-toggle="popover"
                         data-trigger="hover"
                         data-content="<?php echo $producto['DESCRIPCION'];?>">
                    <div class="card-body">
                        <span><?php echo $producto['NOMBRE'];?></span>
                        <h5 class="card-title"><?php echo $producto['PRECIO'];?></h5>
                        <form action="" method="post">
                            <input type="number" class="form-control" value="1" name="cantidad" id="cantidad" placeholder="Ingrese cantidad">
                            <input type="hidden" name="id" id="id" value="<?php echo openssl_encrypt($producto['ID'],COD,KEY);?>">
                            <input type="hidden" name="nombre" id="nombre" value="<?php echo  openssl_encrypt($producto['NOMBRE'],COD,KEY);?>">
                            <input type="hidden" name="precio" id="precio" value="<?php echo openssl_encrypt($producto['PRECIO'],COD,KEY );?>">
                            <br>
                            <button type="submit" name="btnAccion" value="Agregar" class="btn btn-primary">Agregar al carrito</button>
                        </form>

                    </div>
                </div>
            </div>

            <?php
                }
            ?>
        </div>
        <br>
    </div>
<br>
<br>

<script>
    $(function () {
        $('[data-toggle="popover"]').popover()
    })
</script>
<?php
    include 'templates/footer.php';
?>