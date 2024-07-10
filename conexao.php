<?php

require __DIR__ . '/vendor/autoload.php';

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$db_host = getenv('DB_HOST');
$db_port = getenv('DB_PORT');
$db_database = getenv('DB_DATABASE');
$db_username = getenv('DB_USERNAME');
$db_password = getenv('DB_PASSWORD');

$conexao = mysqli_connect($db_host, $db_username, $db_password, $db_database, $db_port);

if (!$conexao) {
    die("Conexão falhou: " . mysqli_connect_error());
} else {
    echo "Conexão bem-sucedida!";
}
