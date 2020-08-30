<?php

session_start();

$db_host="localhost:3307";
$db_nombre="servicios";
$db_usuario="root";
$db_contra="";

$conn = mysqli_connect($db_host,$db_usuario,$db_contra,$db_nombre);

?>