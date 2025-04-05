<?php
include 'config.php';

$busca = $_GET["busca"] ?? '';

$stmt = $pdo->prepare("SELECT * FROM student_registration WHERE cpf = ? OR matricula = ?");
$stmt->execute([$busca, $busca]);
$aluno = $stmt->fetch(PDO::FETCH_ASSOC);

if ($aluno) {
    echo '<h3 class="text-cyan mt-4">Dados do Aluno</h3>';
    echo '<table class="table table-dark table-striped border border-cyan">';
    echo '<thead>';
    echo '<tr>';
    echo '<th>Nome</th>';
    echo '<th>CPF</th>';
    echo '<th>Matrícula</th>';
    echo '<th>CEP</th>';
    echo '<th>Endereço</th>';
    echo '<th>Telefone</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';
    echo '<tr>';
    echo '<td>' . $aluno["nome"] . '</td>';
    echo '<td>' . $aluno["cpf"] . '</td>';
    echo '<td>' . $aluno["matricula"] . '</td>';
    echo '<td>' . $aluno["cep"] . '</td>';
    echo '<td>' . $aluno["endereco"] . '</td>';
    echo '<td>' . $aluno["telefone"] . '</td>';
    echo '</tr>';
    echo '</tbody>';
    echo '</table>';
} else {
    echo '<p class="text-danger">Nenhum aluno encontrado.</p>';
}
?>
