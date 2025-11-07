<?php
session_start();
include_once "conectar.php";
if (isset($bd)) {

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $gmail = $_POST['gmail'] ?? '';
            $clave = $_POST['clave'] ?? '';
            $preparada = $bd->prepare("select gmail,clave,nombre from usuarios where gmail = ? AND clave = ?");
            $preparada->execute( array($gmail,$clave));

                if($preparada->rowCount()>0){
                    
                    foreach ($preparada as $usu) {
                    $_SESSION['nombre'] = htmlspecialchars($usu['nombre']);
                    $_SESSION['gmail'] = htmlspecialchars($usu['gmail']);
                    $_SESSION['clave'] = htmlspecialchars($usu['clave']);
                    
                    }
                    header("Location:catalogo.html");
                    exit();
                }else{
                    echo "<p>error de credenciales</p>";
                }
           
            }
        }




?>