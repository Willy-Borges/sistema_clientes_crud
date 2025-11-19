<?php
require_once "conexao.php";
header("Content-Type: application/json; charset=UTF-8");

$sql = "SELECT id, nome, cpf FROM clientes ORDER BY id ASC";
$res = $conexao->query($sql);

$lista = [];

while ($row = $res->fetch_assoc()) {
    $lista[] = $row;
}

echo json_encode([
    "status" => "ok",
    "clientes" => $lista
]);
?>
