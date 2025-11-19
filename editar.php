<?php
header("Content-Type: application/json");
require_once "conexao.php";

// Lista de campos permitidos para atualizar (corrigido: cel)
$camposPermitidos = [
    "nome",
    "cpf",
    "sexo",
    "data_nascimento",
    "profissao",
    "logradouro",
    "numero",
    "bairro",
    "cidade",
    "cep",
    "cel",   // CORRIGIDO
    "email",
    "uf"
];

// Verifica ID
if (!isset($_POST['id']) || empty($_POST['id'])) {
    echo json_encode([
        "status" => "erro",
        "mensagem" => "ID do cliente não informado."
    ]);
    exit;
}

$id = intval($_POST['id']);

// Verifica se o cliente existe
$sqlCheck = $conexao->prepare("SELECT id FROM clientes WHERE id = ?");
$sqlCheck->bind_param("i", $id);
$sqlCheck->execute();
$result = $sqlCheck->get_result();

if ($result->num_rows === 0) {
    echo json_encode([
        "status" => "erro",
        "mensagem" => "Cliente não encontrado."
    ]);
    exit;
}

// Montar SQL dinamicamente com apenas os campos enviados
$updates = [];
$valores = [];
$tipos = "";

foreach ($camposPermitidos as $campo) {
    if (isset($_POST[$campo])) {
        $updates[] = "$campo = ?";
        $valores[] = $_POST[$campo];
        $tipos .= "s";
    }
}

// Verifica se tem algo para atualizar
if (empty($updates)) {
    echo json_encode([
        "status" => "erro",
        "mensagem" => "Nenhum campo para atualizar."
    ]);
    exit;
}

// Adiciona ID no final
$valores[] = $id;
$tipos .= "i";

// Query final
$sql = "UPDATE clientes SET ".implode(", ", $updates)." WHERE id = ?";
$stmt = $conexao->prepare($sql);

// Bind
$stmt->bind_param($tipos, ...$valores);

// Executa
if ($stmt->execute()) {
    echo json_encode([
        "status" => "sucesso",
        "mensagem" => "Cliente atualizado com sucesso."
    ]);
} else {
    echo json_encode([
        "status" => "erro",
        "mensagem" => "Erro ao atualizar cliente."
    ]);
}

$stmt->close();
$conexao->close();
?>
