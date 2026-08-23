# Paróquia Online — Sistema Web de Informações

Site institucional da **Paróquia Nossa Senhora da Glória**. A aplicação divulga horários de missas, eventos, festas e avisos, permite que os fiéis se inscrevam em grupos e pastorais e se candidatem a voluntariado, e oferece à secretaria um painel administrativo para manter todo o conteúdo sem apoio técnico.

Projeto acadêmico de extensão desenvolvido em três sprints (US001–US017).

---

## Índice

- [Funcionalidades](#funcionalidades)
- [Tecnologias](#tecnologias)
- [Testes](#testes)
- [Estrutura do projeto](#estrutura-do-projeto)
- [Documentação](#documentação)
- [Sprints](#sprints)
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

**Secretaria**

- Gestão completa de eventos, avisos, grupos e horários de missas
- Ativação/desativação de grupos e missas sem perda de histórico
- Consulta de inscritos por grupo e de voluntários por evento

## Tecnologias

- PHP 8.1+ / Laravel 10
- MySQL 8
- Bootstrap 5
- Blade (template engine do Laravel)
- PHPUnit (testes Unit e Feature)

## Testes

O projeto conta com uma suíte de testes automatizados construída com PHPUnit,
cobrindo autenticação, grupos, eventos, missas, avisos, voluntariado, formulário
de contato, páginas públicas e as restrições de acesso à área administrativa.

## Estrutura do projeto

```
app/
├── Http/Controllers/   # Home, Missa, Evento, Aviso, Grupo, Voluntario, Auth
├── Http/Middleware/    # controle de permissões de acesso
├── Mail/               # ContatoRecebido (mailable do formulário de contato)
└── Models/             # User, Missa, Evento, Aviso, Grupo
database/
├── migrations/         # esquema do banco versionado
└── seeders/            # cargas iniciais de dados
resources/views/        # templates Blade (layout e páginas)
routes/web.php          # todas as rotas da aplicação
public/                 # raiz web (index.php, css, js, imagens)
tests/                  # testes Unit e Feature
```

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
- **Sprint 2** — US005 a US012: inscrição em grupos, voluntariado, gestão de eventos e avisos, Home, Sobre, Avisos e Contato.
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
