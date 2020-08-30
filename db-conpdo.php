<?php

session_start();

//$db_host="localhost:3307";
//$db_nombre="servicios";
//$db_usuario="root";
//$db_contra="";

//$conn = mysqli_connect($db_host,$db_usuario,$db_contra,$db_nombre);

?>

<?php

$usuario = $_POST['usu'];
$contrasenia = $_POST['contra'];

try {
    $base= new PDO('mysql:host=localhost:3307; dbname=servicios','root','');
    $base->setAttribute(PDO::ATTR_ERRMODE, ERRMODE_EXCEPTION);
    $base->exec("SET CHARACTER SET utf8");

    $sql= "INSERT INTO usuarios (usuario,pass) VALUES (:usu, :contra) ";
    $resultado = $base->prepare($sql);
    $resultado->execute(array(":usu"=>$usuario, ":contra"=>$contrasenia));
    echo "Registro insertado";
    $resultado->closeCursor();
} catch (Exception $e) {
    
    echo "Tipo de error : " . $e->getMessage() . "<br>";
    echo "linea del error: " . $e=>getLine();
}finally{
    $base=null;
}

?>
