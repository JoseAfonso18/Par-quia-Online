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
- [Melhorias posteriores](#melhorias-posteriores)
- [Licença](#licença)
- [Créditos da equipe](#créditos-da-equipe)

---

## Funcionalidades

**Público**

- Página inicial com a próxima missa, a agenda da semana, avisos em destaque, próximos eventos, grupos e a localização da paróquia
- Horários de missas com destaque da próxima celebração e quadro completo da semana
- Agenda de eventos e festas da comunidade, com fotos
- Grupos e pastorais ativos, com fotos, responsável, dia e horário de reunião
- Catequese: turmas por faixa etária, horários e documentos para inscrição
- Sacramentos: batizado e casamento, com passo a passo e documentação necessária
- Avisos paroquiais, separados entre destaques e demais comunicados
- Página Sobre com a história, o carrossel de fotos e as comunidades atendidas
- Contato pelo WhatsApp da secretaria ou por formulário com envio real de e-mail via SMTP
- Localização no Google Maps, com rota "como chegar"
- Links para as redes sociais oficiais da paróquia

**Fiéis cadastrados**

- Cadastro, login e logout
- Inscrição e cancelamento em grupos e pastorais
- Candidatura a voluntariado em eventos, com mensagem opcional

**Secretaria**

- Painel com indicadores da paróquia: totais de eventos, avisos, missas e grupos, próximos eventos, grupos com mais inscritos e avisos recentes
- Gestão completa de eventos, avisos, grupos e horários de missas
- Envio de fotos para eventos e grupos, com substituição e remoção
- Ativação/desativação de grupos e missas sem perda de histórico
- Consulta de inscritos por grupo e de voluntários por evento

## Tecnologias

- PHP 8.1+ / Laravel 10
- MySQL 8
- Bootstrap 5
- Blade (template engine do Laravel)
- PHPUnit (testes Unit e Feature)

**Integrações**

- WhatsApp (link direto para conversa, com mensagem pronta conforme o grupo, evento ou turma)
- Google Maps (mapa da paróquia e traçado de rota)
- SMTP para o envio das mensagens do formulário de contato

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

## Melhorias posteriores

Evoluções implementadas após a Sprint 3, a partir do retorno da paróquia:

- Contato pelo WhatsApp em todo o site, com mensagem já preenchida conforme o grupo, o evento ou a turma escolhida
- Fotos em grupos e eventos, enviadas pela própria secretaria
- Novas páginas de Catequese e de Sacramentos (batizado e casamento)
- Página inicial reformulada, com próxima missa, agenda da semana, vários avisos em destaque e localização no mapa
- Painel administrativo transformado em dashboard, com indicadores e ações rápidas
- Rodapé institucional com navegação, contato e redes sociais

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
