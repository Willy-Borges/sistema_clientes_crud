<?php
header("Content-Type: application/json; charset=UTF-8");
require_once "conexao.php";

$id              = trim($_POST['id'] ?? "");
$nome            = trim($_POST['nome'] ?? "");
$cpf             = trim($_POST['cpf'] ?? "");
$sexo            = trim($_POST['sexo'] ?? "");
$data_nascimento = trim($_POST['data_nascimento'] ?? "");
$profissao       = trim($_POST['profissao'] ?? "");
$logradouro      = trim($_POST['logradouro'] ?? "");
$numero          = trim($_POST['numero'] ?? "");
$bairro          = trim($_POST['bairro'] ?? "");
$cidade          = trim($_POST['cidade'] ?? "");
$uf              = trim($_POST['uf'] ?? "");
$cep             = trim($_POST['cep'] ?? "");
$celular         = trim($_POST['cel'] ?? "");
$email           = trim($_POST['email'] ?? "");

// validações
if ($nome === "" || $cpf === "" || $celular === "" || $email === "") {
    echo json_encode([
        "status" => "erro",
        "mensagem" => "Nome, CPF, Celular e Email são obrigatórios."
    ]);
    exit;
}

// converter data dd/mm/yyyy → yyyy-mm-dd
if ($data_nascimento !== "" && preg_match("/^\d{2}\/\d{2}\/\d{4}$/", $data_nascimento)) {
    $p = explode("/", $data_nascimento);
    $data_nascimento = $p[2] . "-" . $p[1] . "-" . $p[0];
}

// CPF duplicado
if ($id === "" || $id == 0) {
    $sqlCPF = $conexao->prepare("SELECT id FROM clientes WHERE cpf = ?");
    $sqlCPF->bind_param("s", $cpf);
} else {
    $sqlCPF = $conexao->prepare("SELECT id FROM clientes WHERE cpf = ? AND id != ?");
    $sqlCPF->bind_param("si", $cpf, $id);
}

$sqlCPF->execute();
$resCPF = $sqlCPF->get_result();

if ($resCPF->num_rows > 0) {
    echo json_encode([
        "status" => "erro",
        "mensagem" => "CPF já cadastrado em outro cliente."
    ]);
    exit;
}



// NOVO CLIENTE
if ($id === "" || $id == 0) {

    $sql = $conexao->prepare("
        INSERT INTO clientes
        (nome, cpf, sexo, data_nascimento, profissao, logradouro, numero, bairro, cidade, cep, celular, email, uf)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
    ");

    $sql->bind_param(
        "sssssssssssss",
        $nome, $cpf, $sexo, $data_nascimento, $profissao,
        $logradouro, $numero, $bairro, $cidade, $cep,
        $celular, $email, $uf
    );

    if ($sql->execute()) {
        echo json_encode([
            "status" => "sucesso",
            "mensagem" => "Cliente cadastrado com sucesso!",
            "id" => $sql->insert_id
        ]);
    } else {
        echo json_encode(["status" => "erro", "mensagem" => "Erro ao cadastrar."]);
    }

    exit;
}


// ATUALIZAR CLIENTE
$sql = $conexao->prepare("
    UPDATE clientes SET
        nome = ?, cpf = ?, sexo = ?, data_nascimento = ?, profissao = ?,
        logradouro = ?, numero = ?, bairro = ?, cidade = ?, cep = ?,
        celular = ?, email = ?, uf = ?
    WHERE id = ?
");

$sql->bind_param(
    "sssssssssssssi",
    $nome, $cpf, $sexo, $data_nascimento, $profissao,
    $logradouro, $numero, $bairro, $cidade, $cep,
    $celular, $email, $uf, $id
);

if ($sql->execute()) {
    echo json_encode(["status" => "sucesso", "mensagem" => "Cliente atualizado com sucesso."]);
} else {
    echo json_encode(["status" => "erro", "mensagem" => "Erro ao atualizar."]);
}
?>
