<?php
    include 'global/config.php';
    include 'global/conexion.php';
    include 'carrito.php';
    include 'templates/header.php';
?>

<?php
    if ($_POST){
        $total=0;
        $SID=session_id();
        $correo=$_POST['email'];

        foreach ($_SESSION['CARRITO'] as $indice=>$producto){

            $total=$total+($producto['PRECIO']*$producto['CANTIDAD']);
        }

        $sentencia=$pdo->prepare("INSERT INTO `tblventas` 
                        (`ID`, `ClaveTransaccion`, `PaypalDatos`, `Fecha`, `Correo`, `Total`, `Estado`) 
                        VALUES (NULL,:ClaveTransaccion, '', NOW(),:Correo, :Total, 'pendiente');");

        $sentencia->bindParam(":ClaveTransaccion",$SID);
        $sentencia->bindParam(":Correo",$correo);
        $sentencia->bindParam(":Total",$total);
        $sentencia->execute();
        $idVenta=$pdo->lastInsertId();


        foreach ($_SESSION['CARRITO'] as $indice=>$producto){

            $TotalVenta =$producto['PRECIO']*$producto['CANTIDAD'];

            $sentencia=$pdo->prepare(
                "INSERT INTO `tbldetalleventa` (`ID`, `IDVENTA`, `IDPRODUCTO`, `PRECIOUNITARIO`, `CANTIDAD`, `PRECIOTOTAL`, `DESCARGADO`) 
                        VALUES (NULL, :IdVenta, :IdProducto, :PrecioUnitario, :Cantidad, :PrecioTotal, '0')");

            $sentencia->bindParam(":IdVenta",$idVenta);
            $sentencia->bindParam(":IdProducto",$producto['ID']);
            $sentencia->bindParam(":PrecioUnitario",$producto['PRECIO']);
            $sentencia->bindParam(":Cantidad",$producto['CANTIDAD']);
            $sentencia->bindParam(":PrecioTotal",$TotalVenta);
            $sentencia->execute();
        }
    }
?>
    <script src="https://www.paypalobjects.com/api/checkout.js"></script>
    <style>

        /* Media query for mobile viewport */
        @media screen and (max-width: 400px) {
            #paypal-button-container {
                width: 100%;
            }
        }

        /* Media query for desktop viewport */
        @media screen and (min-width: 400px) {
            #paypal-button-container {
                width: 250px;
                display: inline-block;
            }
        }

    </style>

<br>
<div class="jumbotron text-center">
    <h1 class="display-4">¡Paso final!</h1>
    <hr class="my-4">
    <p class="lead">Estas a punto de pagar con PayPal la cantidad de:
        <h4>$ <?php echo number_format($total,2);?> USD</h4>
    <div id="paypal-button-container"></div>
    </p>
    <p>
       Los productos podrán ser descargados una vez se procese el pago<br>
        <strong>(Para más información: anderam92@gmail.com)</strong>
    </p>
</div>


    <script>
        paypal.Button.render({
            env: 'sandbox', // sandbox | production
            style: {
                label: 'checkout',  // checkout | credit | pay | buynow | generic
                size:  'responsive', // small | medium | large | responsive
                shape: 'pill',   // pill | rect
                color: 'gold',   // gold | blue | silver | black
                fundingicons: 'true'
            },

            funding: {
                allowed: [ paypal.FUNDING.CARD ],
                disallowed: [ paypal.FUNDING.CREDIT ]
            },

            // PayPal Client IDs - replace with your own
            // Create a PayPal app: https://developer.paypal.com/developer/applications/create

            client: {
                sandbox:    'AVAFIG6D36LHI2XtIOh8-iO7jqmL03K6pRN2m1ChmzDdhtMq4mVzOY75S6yOjOFuwXU1JCuOXT4_uRWj',
                production: 'AaYj0h9ty8vsAaoiHW-zuP1t3LrVdCSg_vELoNmr8vI2PxAwA5b2fsaZ9MwHEuSDa4axkAVCnDFBZDLQ'
            },

            // Wait for the PayPal button to be clicked

            payment: function(data, actions) {
                return actions.payment.create({
                    payment: {
                        transactions: [
                            {
                                amount: { total: '<?php echo $total; ?>', currency: 'USD' },
                                description:"Compra de productos a Develoteca:$0.01",
                                custom:"Codigo"
                            }
                        ]
                    }
                });
            },

            // Wait for the payment to be authorized by the customer

            onAuthorize: function(data, actions) {
                return actions.payment.execute().then(function() {
                    console.log(data);
                    window.location="verificador.php?paymentToken="+data.paymentToken+"&paymentID="+data.paymentID;
                });
            }

        }, '#paypal-button-container');

    </script>


<?php
    include 'templates/footer.php';
?>