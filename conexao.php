<?php
$servername = "localhost";
$username = "root";
$password = "careca18.";
$dbname = "plm";

$conexao = mysqli_connect($servername, $username, $password, $dbname);

if (!$conexao) {
    die("Conexão falhou: " . mysqli_connect_error());
}
?>
