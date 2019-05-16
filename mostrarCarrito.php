<?php
    include 'global/config.php';
    include 'carrito.php';
    include 'templates/header.php'
?>

<div class="container">
    <br>
    <h2>Carrito</h2>
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
        <tr>
            <td class="text-center">John</td>
            <td class="text-center">Doe</td>
            <td class="text-center">john@example.com</td>
            <td class="text-center">asdasd</td>
            <td class="text-center"><button class="btn btn-danger">Eliminar</button></td>
        </tr>
        <tr>
            <td colspan="3" align="right"><h3>Total</h3></td>
            <td align="center"><h3>100$</h3></td>
        </tr>
        </tbody>
    </table>
</div>

<?php
    include 'templates/footer.php';
?>
