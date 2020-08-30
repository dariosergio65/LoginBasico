<?php
//include ("header.php");
//include ("db.php");
?>

<?php

session_start();
$cuenta=0;
if(isset($_POST['usuario'])){
    $minombre=htmlentities(addslashes($_POST['usuario']));
    $miclave=htmlentities(addslashes($_POST['clave']));
}else{
    die("Algo raro pasó :(");
}

try{
    $base= new PDO("mysql:host=localhost:3307; dbname=servicios", "root", "");
    $base->setAttribute (PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $base->exec("SET CHARACTER SET utf8");
    $sql="SELECT * FROM users WHERE nombre= :minombre";
    $resultado=$base->prepare($sql);

    $resultado->bindValue(":minombre", $minombre);

    $resultado->execute();

    while($registro = $resultado->fetch(PDO::FETCH_ASSOC)){
        if(password_verify($miclave, $registro['clave'])){
            $cuenta++;
        }
    }

    $filas=$cuenta;
    if($filas != 0){
        $_SESSION['ingresado']=$_POST['usuario'];
        header("location: autenticado.php");
    }
    else{
        $_SESSION['mensaje'] = "Debe ingresar un usuario y contraseña válidos.";
        $_SESSION['tipo_mensaje'] = "danger";
        header("location: login.php");
    }
}
catch(Exception $e){
    die("Error Servicios: " . $e->getMessage());
}

$resultado->closeCursor();

?>

<?php
//nclude ("footer.php")
?>