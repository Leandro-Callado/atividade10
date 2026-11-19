# Sistema de Gerenciamento de Biblioteca

Sistema web desenvolvido em **Laravel 12** para gerenciamento de uma biblioteca, permitindo controlar livros, leitores e empréstimos, incluindo o acompanhamento de devoluções e identificação de empréstimos atrasados.

O projeto foi desenvolvido como atividade prática da disciplina de **Programação II**, com o objetivo de aplicar conceitos de desenvolvimento web, arquitetura MVC, banco de dados relacionais e utilização do Eloquent ORM.

## Funcionalidades

### 1. Dashboard
- Visualização da quantidade total de livros cadastrados.
- Visualização da quantidade de leitores cadastrados.
- Contagem de empréstimos em andamento.
- Identificação e contagem de empréstimos atrasados.

### 2. Gerenciamento de livros
- Cadastro de livros com título, autor, editora, ano de publicação, ISBN e quantidade de exemplares.
- Listagem dos livros cadastrados.
- Edição e exclusão de livros.
- Pesquisa de livros pelo título ou autor.
- Validação para impedir o cadastro de ISBN duplicado.
- Impedimento da exclusão de livros que possuem histórico de empréstimos.

### 3. Gerenciamento de leitores
- Cadastro de leitores com nome, CPF, e-mail e telefone.
- Listagem dos leitores cadastrados.
- Edição e exclusão de leitores.
- Pesquisa de leitores pelo nome.
- Validação de CPF e e-mail únicos.
- Impedimento da exclusão de leitores que possuem histórico de empréstimos.

### 4. Gerenciamento de empréstimos
- Registro de empréstimos vinculando livros e leitores.
- Seleção de livros com exemplares disponíveis.
- Definição da data do empréstimo e da data prevista para devolução.
- Controle automático da quantidade de exemplares disponíveis.
- Identificação de empréstimos em andamento e atrasados.
- Filtro de empréstimos por situação.
- Filtro para visualizar somente empréstimos atrasados.
- Visualização dos detalhes de cada empréstimo.

### 5. Controle de devoluções
- Registro da devolução de livros.
- Atualização da situação do empréstimo para "Devolvido".
- Registro da data efetiva de devolução.
- Reposição automática do exemplar ao estoque.
- Prevenção de registros duplicados de devolução.

## Tecnologias utilizadas

| Tecnologia | Finalidade |
|---|---|
| PHP 8.5 | Linguagem de programação |
| Laravel 12 | Framework de desenvolvimento web |
| MySQL | Sistema gerenciador de banco de dados |
| Eloquent ORM | Consultas e relacionamentos com o banco de dados |
| Blade | Sistema de templates do Laravel |
| Bootstrap 5 | Estilização e componentes da interface |
| HTML5 | Estrutura das páginas |
| CSS3 | Estilização da aplicação |

## Estrutura do projeto

O projeto segue o padrão arquitetural **MVC (Model-View-Controller)**, separando as responsabilidades da aplicação.

```text
biblioteca/
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       ├── DashboardController.php
│   │       ├── LivroController.php
│   │       ├── LeitorController.php
│   │       └── EmprestimoController.php
│   │
│   └── Models/
│       ├── Livro.php
│       ├── Leitor.php
│       └── Emprestimo.php
│
├── database/
│   └── migrations/
│       ├── create_livros_table.php
│       ├── create_leitores_table.php
│       └── create_emprestimos_table.php
│
├── resources/
│   └── views/
│       ├── layouts/
│       │   └── app.blade.php
│       ├── livros/
│       ├── leitores/
│       ├── emprestimos/
│       └── dashboard.blade.php
│
├── routes/
│   └── web.php
│
├── .env.example
└── README.md
```

*Observação: a estrutura acima apresenta os principais arquivos e diretórios da aplicação, omitindo arquivos padrão do Laravel.*

## Banco de dados

O sistema utiliza MySQL e possui três tabelas principais:

### livros
Armazena as informações dos livros cadastrados, incluindo título, autor, editora, ano de publicação, ISBN e quantidade disponível.

### leitores
Armazena os dados dos leitores, incluindo nome, CPF, e-mail e telefone.

### emprestimos
Registra os empréstimos realizados, relacionando livros e leitores por meio de chaves estrangeiras.

Principais relacionamentos:

- Um livro pode possuir vários empréstimos.
- Um leitor pode realizar vários empréstimos.
- Cada empréstimo pertence a um livro e a um leitor.

Os relacionamentos são implementados utilizando o Eloquent ORM.

## Requisitos para execução

Antes de executar o projeto, é necessário ter instalado:

- PHP 8.2 ou superior.
- Composer.
- MySQL.
- Node.js e NPM, caso seja necessário compilar os recursos do frontend.

## Instalação e execução

### 1. Clonar o repositório

```bash
git clone URL_DO_REPOSITORIO
```

Entre na pasta do projeto:

```bash
cd biblioteca
```

### 2. Instalar as dependências

```bash
composer install
```

### 3. Configurar o ambiente

Crie o arquivo `.env` a partir do exemplo:

```bash
cp .env.example .env
```

No Windows, também é possível copiar o arquivo manualmente.

Gere a chave da aplicação:

```bash
php artisan key:generate
```

### 4. Configurar o banco de dados

Crie um banco de dados MySQL chamado `biblioteca`.

Configure as variáveis correspondentes no arquivo `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=biblioteca
DB_USERNAME=root
DB_PASSWORD=
```

Ajuste o usuário e a senha conforme a configuração local do MySQL.

### 5. Executar as migrations

```bash
php artisan migrate
```

Esse comando cria as tabelas necessárias para o funcionamento do sistema.

### 6. Iniciar a aplicação

```bash
php artisan serve
```

Acesse pelo navegador:

```text
http://127.0.0.1:8000
```

## Consultas com Eloquent ORM

As pesquisas e os filtros do sistema utilizam o Eloquent ORM, por meio dos modelos `Livro`, `Leitor` e `Emprestimo`.

São utilizados métodos como:

- `where()` para aplicação de condições.
- `orWhere()` para pesquisas em múltiplos campos.
- `whereDate()` para comparação de datas.
- `with()` para carregamento de relacionamentos.
- `paginate()` para paginação dos resultados.
- `when()` para aplicação condicional de filtros.

Dessa forma, as consultas são realizadas por meio da camada de modelos do Laravel, sem necessidade de escrever consultas SQL diretamente nos controllers.

## Regras de negócio

O sistema implementa algumas regras para manter a consistência dos dados:

- Não é permitido registrar empréstimos de livros sem exemplares disponíveis.
- A quantidade de exemplares é reduzida automaticamente ao registrar um empréstimo.
- A data prevista para devolução não pode ser anterior à data do empréstimo.
- Empréstimos atrasados são identificados pela comparação entre a data prevista e a data atual.
- A devolução altera a situação do empréstimo e restaura a quantidade disponível do livro.
- Uma devolução não pode ser registrada mais de uma vez.
- Livros e leitores com histórico de empréstimos não podem ser excluídos.

As operações de empréstimo e atualização de estoque utilizam transações no banco de dados para preservar a consistência das informações.

## Objetivo acadêmico

Este projeto tem como finalidade colocar em prática os conceitos estudados na disciplina de Programação II, especialmente:

- Programação orientada a objetos.
- Arquitetura MVC.
- Operações CRUD.
- Modelagem de banco de dados relacionais.
- Chaves primárias e estrangeiras.
- Relacionamentos entre entidades.
- Consultas utilizando Eloquent ORM.
- Validação de dados.
- Regras de negócio.
- Desenvolvimento de interfaces web.

---

**Projeto acadêmico desenvolvido para a disciplina de Programação II.**