<?php
    session_start();
    $mensaje="";

    if (isset($_POST['btnAccion'])){
        switch ($_POST['btnAccion']){

            case 'Agregar':
                if (is_numeric(openssl_decrypt($_POST["id"],COD,KEY))){
                    $ID=openssl_decrypt($_POST["id"],COD,KEY);
                    $mensaje.= "Ok...Id correcto " . $ID . "<br>";
                }else{
                    $mensaje.= "Upps, pasó algo con el Id" . "<br>";
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

                if (is_numeric($_POST["cantidad"])){
                    $cantidad =$_POST["cantidad"];
                    $mensaje.="Cantidad: " . $cantidad ."<br>";
                }else{
                    $mensaje.="Upss, pasó algo con la cantidad" . "<br>";
                }

                if ($cantidad >0){
                    $subtotal=$PRECIO*$cantidad;
                    $mensaje.="Subtotal: " . $subtotal . " $ " . "<br>";
                }else{
                    echo "<script>alert('Ingrese una cantidad válida');</script>";
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
            }

            $mensaje=print_r($_SESSION,true);

            break;
        }

    }

?>