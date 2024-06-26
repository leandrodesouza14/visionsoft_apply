# Sistema de gerênciamento de tarefas
## Desenvolvido para aplicação a vaga de programador da Vision Soft

#### Autor: Leandro Souza
#### Data: 22/06/2024

### Descrição
O sistema consiste em uma aplicação web feita no framework Yii, onde é possível se autenticar usando um sistema de login por email e senha, e na primeira página existe
uma tabela que lista as tarefas cadastradas, além de conter as funcionalidades de inserção, edição e exclusão das tarefas, todas efetuadas via Ajax.

### Especificações
* Framework: Yii - V2.0.45
* Bootstrap: V5.3.3

### Requisitos
* PHP >= V8.3 (com as extensões: sqlsrv e pdo_sqlsrv)
* Composer >= V2.7.7
* SQL Server 2022 >= V6.0.4125.3 

### Instruções de instalação
O arquivo de configuração *db.php* ('config/db.php') do repostiório foi substituido pelo *db.php.example*, o qual contém o modelo dos dados de autenticação a base de dados. Para o uso da aplicação deve ser **removida a extensão '.example'** e os dados do **'dsn', 'username' e 'password'** devem ser preenchidos de acordo com as configurações da base de dados a ser usada.

- [ ] Faça Git Clone do repositório atual.
- [ ] Execute 'composer install' para instalar as dependências necessárias.
- [ ] Crie no SQL Server uma base de dados, ou faça a importação pelo arquivo *.bak*.
- [ ] Retire a extensão '.example' do arquivo 'db.php.example', e configure os dados de conexão a sua base de dados SQL Server.
- [ ] Caso não tenha feito a importação pelo arquivo *.bak*, execute 'php yii migrate' para concretizar as migrações da base de dados.
- [ ] Execute 'php yii serve' para iniciar um servidor local e desfrutar da aplicação.

### Estilos e Javascript
* O sistema conta com um ficheiro CSS (site.css) e um JS (task.js), esse arquivos não são copilados e estão diretamente no diretorio "web/css" e "web/js", respectivamente.
Os demais estilos aplicados são fornecidos pelo Bootstrap, que acompanha a base do Yii, e disponível no diretorio "assets/f01a24b6/dist/css/".
* O arquivo 'task.js' fornece as instruções JavaScirpt para as funções Ajax de Inserção, Edição, Remoção e Listagem, além de funções auxiliares. 
* Foi usada a biblioteca Jquery em todo o projeto.