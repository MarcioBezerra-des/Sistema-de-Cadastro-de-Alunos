<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $cpf = $_POST["cpf"];
    $matricula = $_POST["matricula"];
    $cep = $_POST["cep"];
    $endereco = $_POST["endereco"];
    $telefone = $_POST["telefone"];

    $stmt = $pdo->prepare("INSERT INTO student_registration (nome, cpf, matricula, cep, endereco, telefone) VALUES (?, ?, ?, ?, ?, ?)");
    if ($stmt->execute([$nome, $cpf, $matricula, $cep, $endereco, $telefone])) {
        echo "Aluno cadastrado com sucesso!";
    } else {
        echo "Erro ao cadastrar.";
    }
}
?>