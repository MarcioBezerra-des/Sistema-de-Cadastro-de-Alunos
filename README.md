# Sistema-de-Cadastro-de-Alunos
Projeto apresentado pelo professor Felipe na materia de engenharia de software. O intuito é para desenvolver a parte de desenvolvimento na parte de software dos alunos.

## 1 - Visão Geral do Software
O sistema de Cadastro de Alunos foi construindo sob um ambiente web desenvolvido em PHP e estruturado em HTML e Bootstrap, e utilizando-se do XAMPP que é uma junção de quatro tecnologias: Apache (cria um servidor web local), MySQL (sistema de gerenciamento de banco de dados relacional), PHP (linguagem de programação voltada para o desenvolvimento de aplicações para a web) e Perl (linguagem de programação usada para criar scripts e aplicações). Sua finalidade é de cadastrar os alunos de qualquer instituição de ensino, além de realizar uma busca por CPF ou Matrícula no banco de dados e mostrar os dados do aluno cadastrado e exportar um relatório em JSON ou XML.

## 2 - Requisitos para Desenvolvimento
  * Sistema Operacional: Windows
  * Navegador: Chrome, Firefox, Edge
  * Versão PHP: v8.0 ou superior
  * Servidor Web: Xampp v3.3.0 (MySql, Apache inclusos)
  * Ambiente de Desenvolvimento: Qualquer um compatível com os requisitos listados acima

## 3 - Arquitetura do Sistema
  A arquitetura do sistema segue o padrão MVC (Model-View-Controller), garantindo organização e separação de  responsabilidades para melhor manutenção e escalabilidade.

### Model (Modelo)
O modelo gerencia a estrutura de dados e interage diretamente com o banco MySQL. O sistema utiliza PHP para realizar consultas, inserções e recuperação de dados dos alunos no banco student_registration. Arquivos principais:

* config.php: Responsável pela conexão segura com o banco de dados.
* Tabelas do MySQL: Armazenam informações dos alunos, incluindo nome, CPF, matrícula, CEP, endereço e telefone.

### View (Visualização)
A interface do usuário foi desenvolvida utilizando HTML, Bootstrap e PHP, garantindo uma experiência visual moderna e responsiva. Componentes da view:

* Cadastro de alunos: Formulário estilizado que permite inserção de informações.
* Busca de alunos: Exibe os dados em tabela com cores escuras e ciano como principal.
* Exportação de relatórios: Gera arquivos JSON ou XML com todos os alunos cadastrados.

### Controller (Controle)
O controle gerencia a comunicação entre Model e View, processando as entradas do usuário e enviando os dados necessários. Principais funções:

* Cadastro (cadastro.php): Insere novos alunos no banco de dados.
* Busca (busca.php): Recupera e exibe alunos baseados em CPF ou matrícula.
* Exportação (export.php): Gera relatórios completos em XML ou JSON, acessíveis via links na interface.

Tecnologias utilizadas
* Backend: PHP
* Frontend: HTML, Bootstrap e PHP
* Banco de Dados: MySQL

## 4 - Como fazer a instalação?



### Estrutura do Sistema
````
/sistema_cadastro
  |-- Criação do Banco de Dados
  |-- cadastro.php
  |-- config.php
  |-- style.css
  |-- buscar_alunos.php
````
### Banco de Dados
```
//Código em SQL para criar o Banco de Dados no MySQL

create database student_registration

CREATE TABLE student_registration (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255),
    cpf VARCHAR(11) UNIQUE,
    matricula VARCHAR(20) UNIQUE,
    cep VARCHAR(10),
    endereco VARCHAR(255),
    telefone VARCHAR(15)
);
```
### Código do Cadastro dos Alunos (cadastro.php)
````
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
````
### Conexão entre o Código e o Banco de Dados (config.php)
````
<?php
$host = 'localhost';
$dbname = 'student_registration';
$user = 'root';
$pass = '';

// Criando a conexão
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro na conexão: " . $e->getMessage());
}
?>
````
### Código de Busca de Alunos (busca.php)
````
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
````
### Gerador de XML e JSON
````
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
````
### Estrutura do sistema (HTML) e o Estilo (BOOTSTRAP) (index.html)
````
<!DOCTYPE html>
<html lang="pt">
<head>
    <title>Cadastro de Alunos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"> 
    <meta charset="UTF-8">
</head>
<body class="bg-dark text-light">
    <div class="container mt-5">
        <h1 class="text-cyan">Cadastro de Alunos</h1>

        <!-- Formulário de Cadastro -->
        <form method="post" action="cadastro.php" class="border p-4 rounded bg-secondary">
            <div class="mb-3">
                <label class="form-label">Nome</label>
                <input type="text" class="form-control" name="nome">
            </div>
            <div class="mb-3">
                <label class="form-label">CPF</label>
                <input type="text" class="form-control" name="cpf">
            </div>
            <div class="mb-3">
                <label class="form-label">Matrícula</label>
                <input type="text" class="form-control" name="matricula">
            </div>
            <div class="mb-3">
                <label class="form-label">CEP</label>
                <input type="text" class="form-control" name="cep">
            </div>
            <div class="mb-3">
                <label class="form-label">Endereço</label>
                <input type="text" class="form-control" name="endereco">
            </div>
            <div class="mb-3">
                <label class="form-label">Telefone</label>
                <input type="text" class="form-control" name="telefone">
            </div>
            <button type="submit" class="btn btn-cyan">Cadastrar</button>
        </form>

        <!-- Aba de Busca de Aluno -->
        <h2 class="text-cyan mt-4">Buscar Aluno</h2>
        <form method="get" action="busca.php" class="border p-3 rounded bg-secondary">
            <label class="form-label">CPF/Matrícula:</label>
            <input type="text" name="busca" class="form-control">
            <button type="submit" class="btn btn-cyan mt-2">Buscar</button>
        </form>

        <!-- Botões de Exportação -->
        <h2 class="text-cyan mt-4">Exportar Relatórios</h2>
        <a href="export.php?formato=json" class="btn btn-cyan">Baixar JSON</a>
        <a href="export.php?formato=xml" class="btn btn-cyan">Baixar XML</a>
    </div>

    <style>
        .text-cyan { color: #00FFFF; }
        .btn-cyan { background-color: #00FFFF; color: #000; border: none; }
        .btn-cyan:hover { background-color: #008B8B; }
        .table-dark { background-color: #001F3F; color: #00FFFF; }
        .border-cyan { border: 2px solid #00FFFF; }
        th, td { padding: 10px; text-align: center; }
    </style>
</body>
</html>
````

## 5 - Sistema em Funcionamento

![Captura de tela 2025-04-05 210354](https://github.com/user-attachments/assets/c722c207-c051-4273-988d-0c38eda2c254)
![Captura de tela 2025-04-05 210437](https://github.com/user-attachments/assets/d9863f03-4b1b-4ff3-be1d-5af733556d2f)
![Captura de tela 2025-04-05 205846](https://github.com/user-attachments/assets/04314b9f-4d4f-4a34-a8fd-d24d24c7693e)
![Captura de tela 2025-04-05 210408](https://github.com/user-attachments/assets/bef61029-49b0-4713-a442-a2b2fc1be765)
![Captura de tela 2025-04-05 210420](https://github.com/user-attachments/assets/687c64e2-5564-4ad7-a580-39a4e477b58e)

## 7 - Conclusão

Esse projeto de criar um sistema para cadastrar os alunos e realizar sua documentação foi planejado para desenvolver a habilidade e o conhecimento na criação de um sistema por meio de um trabalho acadêmico ministrada pelo professor Felipe Douglas Machado da Cunha, na Universidade Cuiabá - UNIC da disciplina de Engenharia de Software do Curso de Ciência da Computação no 3º Semestre.
