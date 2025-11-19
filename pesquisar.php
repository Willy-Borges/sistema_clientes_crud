<?php
require_once "conexao.php";
header("Content-Type: application/json; charset=UTF-8");

// PEGAR CAMPOS DO FORMULÁRIO
$codigo = $_POST['codigo'] ?? '';
$nome   = $_POST['nome'] ?? '';
$cpf    = $_POST['cpf'] ?? '';
$cel    = $_POST['cel'] ?? '';
$email  = $_POST['email'] ?? '';

if ($codigo == "" && $nome == "" && $cpf == "" && $cel == "" && $email == "") {
    echo json_encode(["status" => "erro", "mensagem" => "Digite algo para pesquisar"]);
    exit;
}


$filtros = [];

if ($codigo !== "") $filtros[] = "id = " . intval($codigo);
if ($nome   !== "") $filtros[] = "nome LIKE '%$nome%'";
if ($cpf    !== "") $filtros[] = "cpf LIKE '%$cpf%'";
if ($cel    !== "") $filtros[] = "celular LIKE '%$cel%'";
if ($email  !== "") $filtros[] = "email LIKE '%$email%'";

$sql = "SELECT * FROM clientes WHERE " . implode(" AND ", $filtros);

$res = $conexao->query($sql);

// NENHUM ENCONTRADO
if ($res->num_rows == 0) {
    echo json_encode(["status" => "erro", "mensagem" => "Nenhum cliente encontrado"]);
    exit;
}


if ($res->num_rows > 1) {
    $lista = [];
    while ($row = $res->fetch_assoc()) {
        $lista[] = [
            "id"   => $row["id"],
            "nome" => $row["nome"],
            "cpf"  => $row["cpf"]
        ];
    }

    echo json_encode([
        "status" => "lista",
        "clientes" => $lista
    ]);
    exit;
}


$cliente = $res->fetch_assoc();

echo json_encode([
    "status" => "ok",
    "cliente" => $cliente
]);
exit;
?>
