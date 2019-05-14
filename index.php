<?php
    include 'global/config.php';
    include 'global/conexion.php';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <title>Tienda UPEC Creativa</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <a class="navbar-brand">Logo</a>
        <button class="navbar-toggler" data-target="#my-nav" data-toggle="collapse" aria-controls="my-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div id="my-nav" class="collapse navbar-collapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Inicio <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Carrito</a>
                </li>
            </ul>
        </div>
    </nav>
    <br>
    <br>
    <div class="container">
    <br>
        <div class="alert alert-success" role="alert">
            Notificaciones
            <a href="#" class="badge badge-success">Ver carrito</a>
        </div>
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
                        <button type="button" class="btn btn-primary">Agregar al carrito</button>
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
</body>
</html>