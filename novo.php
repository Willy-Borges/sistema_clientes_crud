<?php
header("Content-Type: application/json; charset=UTF-8");
require_once "conexao.php";

$nome    = $_POST['nome'] ?? '';
$cpf     = $_POST['cpf'] ?? '';
$celular = $_POST['cel'] ?? ''; // HTML usa id="cel"
$email   = $_POST['email'] ?? '';
$sexo    = $_POST['sexo'] ?? '';
$nasc    = $_POST['nascimento'] ?? ''; // CORRIGIDO!
$prof    = $_POST['profissao'] ?? '';

$logradouro = $_POST['logradouro'] ?? '';
$numero     = $_POST['numero'] ?? '';
$bairro     = $_POST['bairro'] ?? '';
$cidade     = $_POST['cidade'] ?? '';
$cep        = $_POST['cep'] ?? '';
$uf         = $_POST['uf'] ?? '';


if(empty($nome) || empty($cpf) || empty($celular) || empty($email)) {
    echo json_encode(["status" => "erro", "mensagem" => "Nome, CPF, Celular e Email são obrigatórios."]);
    exit;
}


if(!empty($nasc)) {
    $nasc = date("Y-m-d", strtotime($nasc));
}


$sql = $conexao->prepare("
    INSERT INTO clientes
    (nome, cpf, celular, email, sexo, data_nascimento, profissao, logradouro, numero, bairro, cidade, cep, uf)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
");

$sql->bind_param(
    "sssssssssssss",
    $nome, $cpf, $celular, $email, $sexo, $nasc, $prof,
    $logradouro, $numero, $bairro, $cidade, $cep, $uf
);

if($sql->execute()) {
    echo json_encode(["status" => "ok", "mensagem" => "Cliente salvo com sucesso!"]);
} else {
    echo json_encode(["status" => "erro", "mensagem" => $conexao->error]);
}

$sql->close();
$conexao->close();
?>
