<?php
include 'config.php';

$formato = $_GET["formato"] ?? 'json';

$stmt = $pdo->query("SELECT * FROM student_registration");
$alunos = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($formato === 'xml') {
    header("Content-Type: application/xml");
    $xml = new SimpleXMLElement("<alunos/>");

    foreach ($alunos as $aluno) {
        $item = $xml->addChild("aluno");
        foreach ($aluno as $key => $value) {
            $item->addChild($key, $value);
        }
    }

    echo $xml->asXML();
} else {
    header("Content-Type: application/json");
    echo json_encode($alunos, JSON_PRETTY_PRINT);
}
?>
