# Sistema-de-Cadastro-de-Alunos
Projeto apresentado pelo professor Felipe na materia de engenharia de software. O intuito é para desenvolver a parte de desenvolvimento na parte de software dos alunos.

# 1 - Visão Geral do Software
O sistema de Cadastro de Alunos foi construindo sob um ambiente web desenvolvido em PHP e estruturado em HTML e Bootstrap, e utilizando-se do XAMPP que é uma junção de quatro tecnologias: Apache (cria um servidor web local), MySQL (sistema de gerenciamento de banco de dados relacional), PHP (linguagem de programação voltada para o desenvolvimento de aplicações para a web) e Perl (linguagem de programação usada para criar scripts e aplicações). Sua finalidade é de cadastrar os alunos de qualquer instituição de ensino, além de realizar uma busca por CPF ou Matrícula no banco de dados e mostrar os dados do aluno cadastrado e exportar um relatório em JSON ou XML.

# 2 - Requisitos para Desenvolvimento
  * Sistema Operacional: Windows
  * Navegador: Chrome, Firefox, Edge
  * Versão PHP: v8.0 ou superior
  * Servidor Web: Xampp v3.3.0 (MySql, Apache inclusos)
  * Ambiente de Desenvolvimento: Qualquer um compatível com os requisitos listados acima

# 3 - Arquitetura do Sistema
  A arquitetura do sistema segue o padrão MVC (Model-View-Controller), garantindo organização e separação de  responsabilidades para melhor manutenção e escalabilidade.

Model (Modelo)
O modelo gerencia a estrutura de dados e interage diretamente com o banco MySQL. O sistema utiliza PHP para realizar consultas, inserções e recuperação de dados dos alunos no banco student_registration. Arquivos principais:

config.php: Responsável pela conexão segura com o banco de dados.

Tabelas do MySQL: Armazenam informações dos alunos, incluindo nome, CPF, matrícula, CEP, endereço e telefone.

*View (Visualização)*
A interface do usuário foi desenvolvida utilizando HTML, Bootstrap e PHP, garantindo uma experiência visual moderna e responsiva. Componentes da view:

Cadastro de alunos: Formulário estilizado que permite inserção de informações.

Busca de alunos: Exibe os dados em tabela com cores escuras e ciano como principal.

Exportação de relatórios: Gera arquivos JSON ou XML com todos os alunos cadastrados.

Controller (Controle)
O controle gerencia a comunicação entre Model e View, processando as entradas do usuário e enviando os dados necessários. Principais funções:

Cadastro (cadastro.php): Insere novos alunos no banco de dados.

Busca (busca.php): Recupera e exibe alunos baseados em CPF ou matrícula.

Exportação (export.php): Gera relatórios completos em XML ou JSON, acessíveis via links na interface.

Tecnologias utilizadas
Backend: PHP

Frontend: HTML, Bootstrap e PHP

Banco de Dados: MySQL
