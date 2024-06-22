# Sistema de gerênciamento de tarefas
## Desenvolvido para aplicação a vaga de programador da Vision Soft

#### Autor: Leandro Souza
#### Data: 22/06/2024

### Descrição
O sistema consiste em uma aplicação web feita no framework Yii, onde é possível se autenticar usando um sistema de login por email e senha, e na primeira página existe
uma tabela que lista as tarefas cadastradas, além de conter as funcionalidades de inserção, edição e exclusão das tarefas, todas efetuadas via Ajax.

### Especificações
Framework: Yii - 2.0.45v

### Requisitos
PHP: >=8.3v (com as extensões: sqlsrv e pdo_sqlsrv)
Composer: >=2.7.7v
SQL Server: 2022 - >= 6.0.4125.3 

### Instruções de instalação
* O arquivo de configuração DB do repostiório foi substituido pelo db.php.example, o qual contém o modelo dos dados de autenticação a base de dados. Para o uso da aplicação deve ser removida a extensão '.example' e os dados do 'dsn', 'username' e 'password' devem ser preenchidos de acordo com as configurações da base de dados a ser usada.

* 1ª - Faça Git Clone do repositório atual.
* 2ª - Execute 'composer install' para instalar as dependências necessárias.
* 3ª - Crie no SQL Server uma base de dados chamada 'visionsoft'.
* 4ª - Retire a extensão '.example' do arquivo 'db.php.example', e configure os dados de conexão a sua base de dados SQL Server.
* 5ª - Execute 'php yii migrate' para concretizar as migrações da base de dados.
