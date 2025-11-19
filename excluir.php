<?php
header("Content-Type: application/json");
require_once "conexao.php";

$id = $_POST['id'] ?? '';

if ($id === '') {
    echo json_encode([
        "status" => "erro",
        "mensagem" => "Nenhum cliente selecionado para excluir."
    ]);
    exit;
}

$sql = $conexao->prepare("DELETE FROM clientes WHERE id = ?");
$sql->bind_param("i", $id);

if ($sql->execute()) {
    echo json_encode([
        "status" => "sucesso",
        "mensagem" => "Cliente excluído com sucesso!"
    ]);
} else {
    echo json_encode([
        "status" => "erro",
        "mensagem" => "Erro ao excluir cliente."
    ]);
}

$sql->close();
$conexao->close();
?>
