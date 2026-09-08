# Gerenciador de Tarefas

Aplicação web para gerenciamento de tarefas, desenvolvida como parte de um teste técnico utilizando PHP e CodeIgniter 4.

O projeto possui uma interface web para criação, edição, consulta e exclusão de tarefas, além de uma API REST para acesso aos mesmos recursos.

## Tecnologias

* PHP 8.2+
* CodeIgniter 4
* PostgreSQL
* Bootstrap 5
* Composer

## Requisitos

Para executar o projeto localmente, é necessário ter instalado:

* PHP 8.2 ou superior
* Composer
* PostgreSQL

## Instalação

### 1. Clone o repositório

```bash
git clone https://github.com/CaptLuckyTiger/Gerenciador-Tarefas.git
cd Gerenciador-Tarefas
```

### 2. Instale as dependências

```bash
composer install
```

### 3. Configure o banco de dados

Crie um banco de dados PostgreSQL:

```sql
CREATE DATABASE task_manager;
```

Em seguida, crie o tipo utilizado para representar o status das tarefas e a tabela `tasks`:

```sql
CREATE TYPE task_status AS ENUM (
    'pendente',
    'em andamento',
    'concluída'
);

CREATE TABLE tasks (
    id SERIAL PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    status task_status DEFAULT 'pendente',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

### 4. Configure as variáveis de ambiente

Copie o arquivo `env` para `.env` e configure as informações de conexão com o PostgreSQL:

```env
CI_ENVIRONMENT = development

database.default.hostname = localhost
database.default.database = task_manager
database.default.username = postgres
database.default.password = sua_senha
database.default.DBDriver = Postgre
database.default.port = 5432
```

### 5. Execute a aplicação

Inicie o servidor de desenvolvimento do CodeIgniter:

```bash
php spark serve
```

A aplicação estará disponível em:

```text
http://localhost:8080
```

## Funcionalidades

* Criação de tarefas com título, descrição e status
* Listagem de tarefas
* Edição de tarefas
* Exclusão de tarefas
* Validação dos dados dos formulários
* Proteção contra SQL Injection utilizando o Query Builder
* Proteção CSRF
* Rotas amigáveis
* API REST

Os status disponíveis para uma tarefa são:

* `pendente`
* `em andamento`
* `concluída`

## API REST

A aplicação disponibiliza uma API REST para gerenciamento das tarefas.

| Método   | Endpoint          | Descrição                     |
| -------- | ----------------- | ----------------------------- |
| `GET`    | `/api/tasks`      | Lista todas as tarefas        |
| `POST`   | `/api/tasks`      | Cria uma nova tarefa          |
| `GET`    | `/api/tasks/{id}` | Retorna uma tarefa específica |
| `PUT`    | `/api/tasks/{id}` | Atualiza uma tarefa           |
| `DELETE` | `/api/tasks/{id}` | Remove uma tarefa             |

### Exemplos

Listar tarefas:

```http
GET http://localhost:8080/api/tasks
```

Criar uma tarefa:

```http
POST http://localhost:8080/api/tasks
Content-Type: application/json

{
    "title": "Implementar nova funcionalidade",
    "description": "Adicionar suporte à API de tarefas",
    "status": "pendente"
}
```

Buscar uma tarefa:

```http
GET http://localhost:8080/api/tasks/1
```

Atualizar uma tarefa:

```http
PUT http://localhost:8080/api/tasks/1
Content-Type: application/json

{
    "title": "Implementar nova funcionalidade",
    "description": "Funcionalidade concluída",
    "status": "concluída"
}
```

Excluir uma tarefa:

```http
DELETE http://localhost:8080/api/tasks/1
```

A API pode ser testada utilizando ferramentas como Postman ou Thunder Client.

## Estrutura do projeto

O projeto segue a arquitetura MVC disponibilizada pelo CodeIgniter 4, separando responsabilidades entre controllers, models e views.

```text
app/
├── Controllers/
├── Models/
├── Views/
└── Config/

public/
.env
composer.json
spark
```

## Observações

Este projeto foi desenvolvido como teste técnico, com foco na implementação de um CRUD completo, organização do código, validação dos dados e disponibilização de uma API REST.
