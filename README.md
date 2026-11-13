# kunla-project

API em **Laravel Lumen 8** para um **banco de talentos de profissionais de tecnologia**: cadastro, busca e publicação de candidatos, com painel administrativo.

## Funcionalidades

- Busca pública de candidatos (`/`, `/search`, `/search_more`) e página de detalhe (`/detail/{gid}`)
- Lista de estados (`/state`)
- Área autenticada (middleware `auth`) para o CRUD de candidatos: criar, listar, buscar, ver, atualizar, remover e **publicar**
- Modelos: `Candidate`, `CandidateRole` (função), `CandidateEnglishLevel` (nível de inglês), `CandidateStatus`, `State` e `User`

### Rotas principais

| Método | Rota | Descrição |
|---|---|---|
| `POST` | `/candidate` | Lista candidatos |
| `POST` | `/candidate/store/` | Cadastra candidato |
| `POST` | `/candidate/search` | Pesquisa candidatos |
| `POST` | `/candidate/{id}` | Detalha um candidato |
| `POST` | `/candidate/{id}/publish` | Publica o candidato |
| `PUT` | `/candidate/{id}/update` | Atualiza |
| `DELETE` | `/candidate/{id}` | Remove |
| `GET` | `/state` | Lista de estados |

As rotas de candidato exigem autenticação. A definição completa está em `routes/web.php`.

## Stack

PHP 7.3+ / 8, Lumen 8, Eloquent, PHPUnit.

## Como rodar

```bash
composer install
cp .env.example .env        # configure banco de dados e chaves
# importe/crie as tabelas conforme os modelos em app/Models e database/
php -S localhost:8000 -t public
```

## Documentação

A pasta `docs/` traz o PDF de mapeamento da API, a documentação do painel administrativo e modelos de JSON.

## Licença

Lumen é distribuído sob a [licença MIT](https://opensource.org/licenses/MIT).
