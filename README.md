# Sistema de Gerenciamento de usuários

## Sobre o sistema

Esta API REST oferece 5 operações sobre os usuários, sendo elas:

-   Listagem de usuários
-   Exibir um usuário
-   Cadastrar usuário
-   Editar usuário
-   Deletar usuário

Informações do usuário:

-   Nome
-   CPF
-   Data Nascimento
-   Email
-   Tefone
-   Logradouro
-   Cidade
-   Estado

## Tecnologia

-   Laravel

## Configuração e instalação

É necessário ter instalado o PHP, Composer, MySQL e um servidor para a aplicação.

1. Clone este repositório

    ```
    git clone https://github.com/diogenesc/user-management-api.git
    ```

2. Entre na pasta e instale as dependências

    ```
    cd user-management-api
    composer install
    ```

3. Copie o .env.example e configure o necessário

    ```
    cp .env.example .env
    ```

4. Execute os scripts de configuração e migração do banco de dados

    ```bash
    php artisan key:generate
    php artisan migrate
    ```

## Endpoints

Você deve configurar seu servidor e para a pasta _public_, ou precisará do prefixo _public/_ em cada endpoint. Exemplo: public/api/users

| Método    | URI              | Descrição                            |
| --------- | ---------------- | ------------------------------------ |
| GET       | `api/users`      | Returna a lista de todos os usuários |
| GET       | `api/users/{id}` | Retorna um usuário                   |
| POST      | `api/users`      | Cadastra um usuário                  |
| PUT/PATCH | `api/users/{id}` | Edita um usuário                     |
| DELETE    | `api/users/{id}` | Remove um usuário                    |

### Exemplo de Request para Cadastro e Edição

**Request**:

```json
{
    "name": "Nome completo",
    "cpf": "000.000.000-00",
    "birthday": "2020-01-01",
    "email": "usuario@usuario.com",
    "phone_number": "99000000000",
    "address": "Rua Exemplo, SN",
    "city": "Vitória",
    "state": "Espírito Santo"
}
```

| Atributo     | Tipo   |
| ------------ | ------ |
| name         | string |
| cpf          | string |
| birthday     | date   |
| email        | string |
| phone_number | string |
| address      | string |
| city         | string |
| state        | string |
