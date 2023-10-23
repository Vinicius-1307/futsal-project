API de Gerenciamento de Jogos de Futsal - Laravel

Bem-vindo à API de Gerenciamento de Jogos de Futsal construída com Laravel. Esta API permite o gerenciamento de jogadores, times, partidas e autenticação de usuários com JWT. É uma ferramenta poderosa para administrar informações relacionadas a jogos de futsal de forma eficaz e eficiente.

**Configuração:**

Antes de começar a usar a API Laravel, siga as etapas a seguir para configurar o ambiente:

1.	Clonar o repositório:

    •	git clone https://github.com/Vinicius-1307/futsal-project.git

2.	Instalar dependências:	

    •	composer install

3.	Configurar Variáveis de Ambiente:
Copie o arquivo ‘.env.example’ para ‘.env’ e configure as seguintes variáveis de ambiente:

    •	DB_CONNECTION: Defina a conexão com o banco de dados (por exemplo, mysql).
  	
    •	DB_HOST, DB_PORT, DB_DATABASE, DB_USERNAME, DB_PASSWORD: Configure as informações do banco de dados.
  	
    •	JWT_SECRET: Sua chave secreta para autenticação JWT.

5.	Gerar uma Chave de Aplicativo:
   
    Execute o comando ‘php artisan key:generate’ para gerar uma chave de aplicativo.

6.	Executar Migrações:

    Execute as migrações para criar as tabelas no banco de dados:
    ‘php artisan migrate’

7.	Iniciar o servidor de desenvolvimento:

    ‘php artisan serve’

**Endpoints:**

A API Laravel possui os seguintes endpoints: 

**Login:**

•	POST /api /login: Realiza login com autenticação JWT.

**Users:**

•	POST /api/user/: Registra um novo usuário.

**Players:**

•	POST ```/api/player:``` Cria um novo jogador.

•	PUT /api/player/{id}: Edita um jogador existente.

•	DELETE /api/player/{id}: Deleta um jogador.

**Teams:**

•	POST /api/team: Cria um novo time.

•	GET /api/team/: Lista todos os times com jogadores associados.

•	GET /api/team/order-by: Lista times em ordem decrescente.

•	PATCH /api/team/{id}: Edita um time existente.

•	DELETE /api/team/{id}: Deleta um time.

**Matches:**

•	POST /api/match: Cria uma nova partida.

•	PUT /api/match/{id}: Edita uma partida existente.

•	DELETE /api/match/{id}: Deleta uma partida existente.

**Contato:**
Se você tiver alguma dúvida ou precisar de assistência, entre em contato com [viniciusjose9@outlook.com].

Aproveite a API de Gerenciamento de Jogos de Futsal construída com Laravel!	

	
