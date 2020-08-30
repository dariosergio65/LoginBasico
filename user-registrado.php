<?php
//include ("header.php");
//include ("db.php");
?>

<?php

session_start();

if(isset($_POST['usuario'])){
    $minombre=htmlentities(addslashes($_POST['usuario']));
    $miclave=htmlentities(addslashes($_POST['clave']));
    $encriptada =  password_hash($miclave, PASSWORD_DEFAULT);
}else{
    die("Algo raro pasó :(");
}

try{
    $base= new PDO("mysql:host=localhost:3307; dbname=servicios", "root", "");
    $base->setAttribute (PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $base->exec("SET CHARACTER SET utf8");
    $sql="INSERT INTO users (nombre,clave) VALUES (:minombre, :miclave)";
    $resultado=$base->prepare($sql);

    $resultado->bindValue(":minombre", $minombre);
    $resultado->bindValue(":miclave", $encriptada);

    $resultado->execute();

    $filas=$resultado->rowCount();
    if($filas != 0){
        //echo "<h2>Funciona</h2>";}
        session_start();
        $_SESSION['ingresado']=$_POST['usuario'];
        header("location: autenticado.php");
    }
    else{
        $_SESSION['mensaje'] = "Debe ingresar un usuario y contraseña válidos.";
        $_SESSION['tipo_mensaje'] = "danger";
        header("location: index.php");
    }
}
catch(Exception $e){
    echo "Error en linea: " . $e->getLine() . "<br>";
    die("Mensaje de Error: " . $e->getMessage());
}

?>

<?php
//nclude ("footer.php")
?>