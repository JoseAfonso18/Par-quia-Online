# Paróquia Online — Sistema Web de Informações

Site institucional da **Paróquia Nossa Senhora da Glória**. A aplicação divulga horários de missas, eventos, festas e avisos, permite que os fiéis se inscrevam em grupos e pastorais e se candidatem a voluntariado, e oferece à secretaria um painel administrativo para manter todo o conteúdo sem apoio técnico.

Projeto acadêmico de extensão desenvolvido em três sprints (US001–US017).

---

## Índice

- [Funcionalidades](#funcionalidades)
- [Tecnologias](#tecnologias)
- [Requisitos](#requisitos)
- [Configuração do ambiente de desenvolvimento](#configuração-do-ambiente-de-desenvolvimento)
- [Como rodar localmente](#como-rodar-localmente)
- [Testes](#testes)
- [Estrutura do projeto](#estrutura-do-projeto)
- [Deploy em produção](#deploy-em-produção)
- [Documentação](#documentação)
- [Licença](#licença)
- [Créditos da equipe](#créditos-da-equipe)

---

## Funcionalidades

**Público**

- Consulta de horários de missas, ordenados de domingo a sábado
- Agenda de eventos e festas da comunidade
- Avisos paroquiais, com destaque na página inicial
- Listagem de grupos e pastorais ativos
- Páginas Home, Sobre e Contato, com envio real de e-mail via SMTP

**Fiéis cadastrados**

- Cadastro, login e logout
- Inscrição e cancelamento em grupos e pastorais
- Candidatura a voluntariado em eventos, com mensagem opcional

**Administradores (`/admin`)**

- CRUD de eventos, avisos, grupos e horários de missas
- Ativação/desativação de grupos e missas sem perda de histórico
- Consulta de inscritos por grupo e de voluntários por evento

## Tecnologias

- PHP 8.1+ / Laravel 10
- MySQL 8
- Bootstrap 5
- Blade (template engine do Laravel)
- PHPUnit (testes Unit e Feature)

## Requisitos

- PHP >= 8.1 com as extensões `bcmath`, `ctype`, `curl`, `dom`, `fileinfo`, `json`, `mbstring`, `openssl`, `pdo_mysql`, `tokenizer`, `xml`
- Composer 2.x
- MySQL 8 (ou MariaDB 10.6+)
- Git
- Node.js 18+ (opcional, apenas para recompilar assets)

## Configuração do ambiente de desenvolvimento

```bash
git clone https://github.com/JoaoVitorGrando/Paroquia-online.git
cd Paroquia-online

composer install

cp .env.example .env
php artisan key:generate
```

Edite o `.env` com as credenciais do seu MySQL:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=paroquia_online
DB_USERNAME=root
DB_PASSWORD=
```

> Se o `php artisan migrate` retornar `SQLSTATE[HY000] [1045] Access denied for user 'root'@'localhost'`, o usuário e a senha do `.env` não correspondem aos do MySQL local. Ajuste `DB_USERNAME`/`DB_PASSWORD` e rode `php artisan config:clear` antes de tentar novamente.

Para testar o formulário de contato localmente, configure também as variáveis `MAIL_*` (use `MAIL_MAILER=log` para gravar o e-mail em `storage/logs/laravel.log` em vez de enviá-lo).

Crie o banco e rode as migrations com a carga inicial:

```bash
mysql -u root -e "CREATE DATABASE paroquia_online CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
php artisan migrate --seed
```

## Como rodar localmente

```bash
php artisan serve
```

Acesse <http://localhost:8000>.

## Testes

```bash
php artisan test              # toda a suíte
php artisan test --filter=Grupo
```

Cobertura atual: autenticação, grupos, eventos e formulário de contato.

## Estrutura do projeto

```
app/
├── Http/Controllers/   # Home, Missa, Evento, Aviso, Grupo, Voluntario, Auth, Admin
├── Http/Middleware/    # middleware 'admin' (verifica is_admin)
├── Mail/               # ContatoRecebido (mailable do formulário de contato)
└── Models/             # User, Missa, Evento, Aviso, Grupo
database/
├── migrations/         # esquema do banco versionado
└── seeders/            # AdminSeeder e cargas iniciais
resources/views/        # templates Blade (layout, páginas públicas e admin)
routes/web.php          # todas as rotas da aplicação
public/                 # raiz web (index.php, css, js, imagens)
tests/                  # testes Unit e Feature
```

## Deploy em produção

Resumo — o procedimento completo está no Manual Técnico e Guia de Implantação (Seção 5 da documentação do projeto):

```bash
git pull origin main
composer install --no-dev --optimize-autoloader
php artisan migrate --force
php artisan optimize:clear
php artisan config:cache && php artisan route:cache && php artisan view:cache
```

Requisitos de produção: raiz web apontando para `public/`, `APP_ENV=production`, `APP_DEBUG=false`, HTTPS ativo, `storage/` e `bootstrap/cache/` graváveis pelo usuário do servidor web, e backup diário do banco.

## Documentação

A documentação completa do projeto é entregue em documento único, formatado conforme as normas da ABNT, e reúne:

| Seção | Conteúdo |
|---|---|
| 2 | Requisitos funcionais e não funcionais (SRS) |
| 3 | Arquitetura, diagramas, decisões de design e modelo de dados |
| 4 | Manual do usuário (comunidade e secretaria) |
| 5 | Manual técnico e guia de implantação |
| 6 | Plano de implantação detalhado |

## Sprints

- **Sprint 1** — US001 a US004: horários de missas, eventos e festas, cadastro e login.
- **Sprint 2** — US005 a US012: inscrição em grupos, voluntariado, painel admin de eventos e avisos, Home, Sobre, Avisos e Contato.
- **Sprint 3** — US013 a US017: CRUD de grupos e de missas, envio real de e-mail no contato, testes automatizados e refinos de UX (hero na home e rodapé fixo).

## Licença

Distribuído sob a **Licença MIT**. Consulte o arquivo [`LICENSE`](LICENSE) para o texto completo.

## Créditos da equipe

| Papel | Integrante |
|---|---|
| Product Owner | Luis Gustavo Romanichen Domingues |
| Scrum Master | João Vitor Grando |
| Desenvolvedor | José Afonso Machado da Cruz |
| Desenvolvedor | Gustavo Ferreira dos Santos |

Projeto de extensão desenvolvido para a Paróquia Nossa Senhora da Glória na disciplina de **Engenharia de Software** do **Centro Universitário Campo Real**.
