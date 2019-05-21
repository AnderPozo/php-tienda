<?php
    session_start();
    $mensaje="";

    //Comprueba datos enviados desde el formulario de index
    if (isset($_POST['btnAccion'])){
        $cantidad =$_POST["cantidad"];

        switch ($_POST['btnAccion']){

            case 'Agregar':
                if (is_numeric($_POST["cantidad"]) && $cantidad >0){
                    //$cantidad =$_POST["cantidad"];
                    $mensaje.="Cantidad: " . $cantidad ."<br>";
                }else{
                    $mensaje.="Ingrese una cantidad válida" . "<br>";
                    break;
                }

                /*
                if ($cantidad >0){
                    $subtotal=$PRECIO*$cantidad;
                    $mensaje.="Subtotal: " . $subtotal . " $ " . "<br>";
                }else{
                    echo "<script>alert('Ingrese una cantidad válida');</script>";
                    break;
                }*/

                if (is_numeric(openssl_decrypt($_POST["id"],COD,KEY))){
                    $ID=openssl_decrypt($_POST["id"],COD,KEY);
                    $mensaje.= "Ok...Id correcto " . $ID . "<br>";
                }else{
                    $mensaje.= "Upps, pasó algo con el Id" . "<br>";
                    break;
                }

                if (is_string(openssl_decrypt($_POST["nombre"],COD,KEY))){
                    $NOMBRE=openssl_decrypt($_POST["nombre"],COD,KEY);
                    $mensaje.= "Ok...Nombre correcto " . $NOMBRE . "<br>";
                }else{
                    $mensaje.= "Upps, pasó algo con el nombre" . "<br>";
                    break;
                }

                if (is_numeric(openssl_decrypt($_POST["precio"],COD,KEY))){
                    $PRECIO=openssl_decrypt($_POST["precio"],COD,KEY);
                    $mensaje.= "Ok...Precio correcto " . $PRECIO . "<br>";
                }else{
                    $mensaje.= "Upps, pasó algo con el precio" . "<br>";
                    break;
                }

                //Variable de sesión del carrito
            if (!isset($_SESSION['CARRITO'])){
                $producto = array(
                    'ID'=>$ID,
                    'NOMBRE'=>$NOMBRE,
                    'CANTIDAD'=> $cantidad,
                    'PRECIO'=> $PRECIO,
                    'SUBTOTAL'=> $subtotal
                );
                $_SESSION['CARRITO'][0]=$producto;
                $mensaje='Producto agregado al carrito';
            }else{
                $idProductos = array_column($_SESSION['CARRITO'],'ID');

                if (in_array($ID,$idProductos)){

                    echo "<script>alert('El producto ya ha sido agregado')</script>";
                    $mensaje = "";
                }else{
                    $NumeroProductos=count($_SESSION['CARRITO']);
                    $producto = array(
                        'ID'=>$ID,
                        'NOMBRE'=>$NOMBRE,
                        'CANTIDAD'=> $cantidad,
                        'PRECIO'=> $PRECIO,
                        'SUBTOTAL'=> $subtotal
                    );
                    $_SESSION['CARRITO'][$NumeroProductos]=$producto;
                    $mensaje='Producto agregado al carrito';
                }
            }

            //$mensaje=print_r($_SESSION,true);


            break;
            //Elimina los productos del carrito mediante ID
            case 'Eliminar':
                if (is_numeric(openssl_decrypt($_POST["id"],COD,KEY))){
                    $ID=openssl_decrypt($_POST["id"],COD,KEY);

                    foreach ($_SESSION['CARRITO'] as $indice=>$producto){
                        if ($producto['ID']==$ID){
                            unset($_SESSION['CARRITO'][$indice]);
                            echo "<script>alert('Producto eliminado...');</script>";
                        }
                    }

                }else{
                    $mensaje.= "Upps, pasó algo con el Id" . "<br>";
                }
            break;
        }

    }

?>