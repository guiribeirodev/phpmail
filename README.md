# Teste Web - Formulário de Contato

Aplicação PHP para cadastro e listagem de contatos. Ao enviar o formulário, os dados são salvos no MySQL e uma notificação é enviada por SMTP usando o PHPMailer.

## Requisitos

- PHP 8.0 ou superior
- Composer
- MySQL
- Extensões PHP `pdo_mysql` e `openssl`

## Instalação

1. Clone ou copie o projeto para o ambiente local.
2. Instale as dependências:

   ```bash
   composer install
   ```

3. Crie o banco de dados e a tabela:

   ```sql
   CREATE DATABASE testeescala
     CHARACTER SET utf8mb4
     COLLATE utf8mb4_unicode_ci;

   USE testeescala;

   CREATE TABLE Contatos (
       id INT AUTO_INCREMENT PRIMARY KEY,
       nome VARCHAR(255) NOT NULL,
       email VARCHAR(255) NOT NULL,
       telefone VARCHAR(20) NOT NULL,
       mensagem TEXT NOT NULL
   );
   ```

4. Configure o acesso ao banco em [`app/Config/Database.php`](app/Config/Database.php).
5. Configure o servidor SMTP em [`app/Controllers/ContatoController.php`](app/Controllers/ContatoController.php). Não versione senhas ou outras credenciais reais.

## Execução local

Na raiz do projeto, inicie o servidor embutido do PHP:

```bash
php -S localhost:8000
```

Depois, acesse <http://localhost:8000>.

## Funcionalidades

- Cadastro de nome, e-mail, telefone e mensagem.
- Validação dos campos obrigatórios, e-mail e telefone.
- Persistência dos contatos no MySQL.
- Envio de notificação por SMTP.
- Listagem dos contatos cadastrados em `index.php?acao=listar`.
- Filtro dos registros no navegador.

## Estrutura

```text
.
├── app/
│   ├── Config/          # Configuração de banco de dados
│   ├── Controllers/     # Fluxo da aplicação e envio de e-mail
│   ├── Models/          # Operações de persistência
│   └── Views/           # Formulário e listagem
├── index.php            # Ponto de entrada
├── composer.json        # Dependências PHP
└── composer.lock
```

## Rotas disponíveis

| URL | Descrição |
| --- | --- |
| `index.php` | Exibe o formulário de contato |
| `index.php?acao=index` | Exibe o formulário de contato |
| `index.php?acao=enviar` | Processa o formulário via `POST` |
| `index.php?acao=listar` | Exibe os contatos cadastrados |

## Segurança

Antes de publicar a aplicação, substitua as credenciais de banco e SMTP de exemplo por uma configuração segura. Recomenda-se carregá-las por variáveis de ambiente e manter o ambiente de produção fora do controle de versão.
