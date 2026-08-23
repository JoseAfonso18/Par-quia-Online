<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Paróquia Nossa Senhora da Glória')</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        html, body {
            height: 100%;
        }
        body {
            background-color: #f8f9fa;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        main {
            flex: 1 0 auto;
        }
        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 0.65rem;
            font-weight: bold;
            margin-right: 1rem;
            padding-top: 0.35rem;
            padding-bottom: 0.35rem;
        }
        .navbar-brand-logo-wrap {
            width: 52px;
            height: 52px;
            border-radius: 50%;
            overflow: hidden;
            flex-shrink: 0;
            position: relative;
            border: 2px solid #f0d080;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.25);
            background-color: #f4efe4;
        }
        .navbar-brand-logo {
            position: absolute;
            left: 50%;
            top: 50%;
            width: 132%;
            height: 132%;
            max-width: none;
            transform: translate(-50%, -50%);
            object-fit: contain;
        }
        .navbar-brand-text {
            line-height: 1.15;
            font-size: 0.95rem;
        }
        @media (max-width: 575.98px) {
            .navbar-brand-logo-wrap {
                width: 44px;
                height: 44px;
            }
            .navbar-brand-text {
                font-size: 0.85rem;
            }
        }
        .navbar {
            background-color: #1a3a5c !important;
        }
        .navbar .navbar-toggler {
            border-color: rgba(255, 255, 255, 0.5);
        }
        .navbar .navbar-toggler-icon {
            filter: invert(1);
        }
        .navbar a {
            color: #fff !important;
        }
        .navbar a:hover {
            color: #f0d080 !important;
        }
        .footer {
            background-color: #1a3a5c;
            color: #ccd6e0;
            padding: 36px 0 0;
            margin-top: 48px;
            flex-shrink: 0;
        }
        .footer h6 {
            color: #f0d080;
            font-weight: 700;
            font-size: 0.95rem;
            margin-bottom: 14px;
        }
        .footer a {
            color: #ccd6e0;
            text-decoration: none;
        }
        .footer a:hover {
            color: #f0d080;
        }
        .footer ul {
            list-style: none;
            padding-left: 0;
            margin-bottom: 0;
        }
        .footer .footer-links li {
            margin-bottom: 7px;
            font-size: 0.9rem;
        }
        .footer .footer-info li {
            margin-bottom: 10px;
            font-size: 0.9rem;
            display: flex;
            gap: 9px;
        }
        .footer .footer-info i {
            color: #f0d080;
            flex-shrink: 0;
        }
        .footer .footer-brand-logo {
            width: 56px;
            height: 56px;
            border-radius: 50%;
            overflow: hidden;
            position: relative;
            flex-shrink: 0;
            border: 2px solid #f0d080;
            background-color: #f4efe4;
        }
        .footer .footer-brand-logo img {
            position: absolute;
            left: 50%;
            top: 50%;
            width: 132%;
            height: 132%;
            max-width: none;
            transform: translate(-50%, -50%);
            object-fit: contain;
        }
        .footer .social-link {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background-color: rgba(255, 255, 255, 0.1);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1.15rem;
            color: #fff;
            transition: background-color .2s, color .2s;
        }
        .footer .social-link:hover {
            background-color: #f0d080;
            color: #1a3a5c;
        }
        .footer .footer-bottom {
            border-top: 1px solid rgba(255, 255, 255, 0.15);
            margin-top: 28px;
            padding: 14px 0;
            font-size: 0.82rem;
            color: #9fb0c2;
        }
        /* Mapa da localização da paróquia */
        .mapa-paroquia {
            width: 100%;
            height: 340px;
            border: 0;
            display: block;
        }
        @media (max-width: 575.98px) {
            .mapa-paroquia {
                height: 260px;
            }
        }
        .card-missa {
            border-left: 4px solid #1a3a5c;
        }
        .badge-dia {
            background-color: #1a3a5c;
        }
        /* Hero da home — carrossel de imagens */
        .hero-igreja {
            position: relative;
            width: 100%;
            height: clamp(330px, 44vw, 500px);
            min-height: 330px;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            margin-bottom: 30px;
            overflow: hidden;
        }
        .hero-igreja-slides {
            position: absolute;
            inset: 0;
            z-index: 0;
        }
        .hero-slide {
            position: absolute;
            inset: 0;
            background-size: cover;
            background-position: center center;
            opacity: 0;
            transition: opacity 1s ease-in-out;
        }
        .hero-slide.active {
            opacity: 1;
        }
        .hero-slide::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(rgba(26,58,92,0.55), rgba(26,58,92,0.65));
        }
        .hero-igreja .container {
            position: relative;
            z-index: 1;
        }
        .hero-igreja h1 {
            font-weight: 700;
            font-size: 2.6rem;
            text-shadow: 0 2px 12px rgba(0,0,0,0.45);
        }
        .hero-igreja p.lead {
            font-size: 1.2rem;
            text-shadow: 0 1px 8px rgba(0,0,0,0.45);
        }
        .hero-igreja .btn-hero {
            background-color: #f0d080;
            color: #1a3a5c;
            font-weight: 600;
            border: none;
        }
        .hero-igreja .btn-hero:hover {
            background-color: #e6c267;
            color: #1a3a5c;
        }
        /* Carrossel da página Sobre — imagens inteiras (sem corte) */
        #carrosselSobre {
            background-color: #1a3a5c;
        }
        .carousel-img {
            width: 100%;
            height: auto;
            max-height: 600px;
            object-fit: contain;
            display: block;
            margin: 0 auto;
            background-color: #1a3a5c;
        }
        .carousel-caption {
            background: rgba(26, 58, 92, 0.75);
            border-radius: 8px;
            padding: 10px 18px;
            bottom: 1.5rem;
        }
        .carousel-caption h5 {
            font-weight: 700;
            margin-bottom: 4px;
        }
        /* ===== Painel administrativo ===== */
        .admin-topbar {
            background-color: #1a3a5c;
            color: #fff;
            border-radius: 12px;
            padding: 14px 20px;
        }
        .admin-topbar .admin-logo {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            background-color: #f0d080;
            color: #1a3a5c;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
            flex-shrink: 0;
        }
        .admin-topbar .admin-title {
            font-size: 1.15rem;
            font-weight: 600;
            margin: 0;
            line-height: 1.2;
        }
        .admin-topbar .admin-sub {
            font-size: 0.8rem;
            color: #cdd9e6;
        }
        .admin-topbar .btn-topbar {
            background-color: #f0d080;
            color: #1a3a5c;
            font-weight: 600;
            border: none;
        }
        .admin-topbar .btn-topbar:hover {
            background-color: #e6c267;
            color: #1a3a5c;
        }
        .stat-card {
            background-color: #eef2f6;
            border-radius: 10px;
            padding: 16px 18px;
            height: 100%;
        }
        .stat-card .stat-label {
            font-size: 0.85rem;
            color: #5b6b7b;
        }
        .stat-card .stat-ico {
            color: #185fa5;
            font-size: 1.1rem;
        }
        .stat-card .stat-num {
            font-size: 1.7rem;
            font-weight: 600;
            line-height: 1.1;
            margin-top: 4px;
            color: #1f2a37;
        }
        .stat-card .stat-foot {
            font-size: 0.78rem;
            color: #90a0b0;
        }
        .panel-card {
            background-color: #fff;
            border: 1px solid #e3e8ee;
            border-radius: 12px;
            padding: 16px 20px;
            height: 100%;
        }
        .panel-card .panel-title {
            font-size: 0.95rem;
            font-weight: 600;
            color: #1a3a5c;
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 14px;
        }
        .date-chip {
            width: 46px;
            text-align: center;
            background-color: #eef2f6;
            border-radius: 8px;
            padding: 5px 0;
            flex-shrink: 0;
        }
        .date-chip .d {
            font-size: 1.05rem;
            font-weight: 600;
            line-height: 1;
            color: #1a3a5c;
        }
        .date-chip .m {
            font-size: 0.7rem;
            color: #5b6b7b;
        }
        .bar-track {
            height: 9px;
            background-color: #eef2f6;
            border-radius: 5px;
            overflow: hidden;
        }
        .bar-fill {
            height: 9px;
            background-color: #185fa5;
            border-radius: 5px;
        }
        .panel-card .table {
            margin-bottom: 0;
        }
        .panel-card .table > :not(caption) > * > * {
            padding: 0.7rem 0.75rem;
        }
        /* ===== Botão do WhatsApp ===== */
        .btn-whats {
            background-color: #25d366;
            color: #0a3d1f;
            border: none;
            font-weight: 600;
        }
        .btn-whats:hover {
            background-color: #1eb85a;
            color: #0a3d1f;
        }
        .navbar .btn-whats,
        .navbar .btn-whats:hover {
            color: #0a3d1f !important;
        }
        /* ===== Cards com foto ===== */
        .card-foto-topo {
            width: 100%;
            height: 175px;
            object-fit: cover;
        }
        .card-foto-lado {
            width: 160px;
            object-fit: cover;
            flex-shrink: 0;
        }
        @media (max-width: 575.98px) {
            .card-foto-lado {
                width: 100%;
                height: 150px;
            }
        }
        .data-sobre {
            position: absolute;
            top: 10px;
            left: 10px;
            background-color: #fff;
            border-radius: 8px;
            padding: 5px 0;
            width: 54px;
            text-align: center;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.25);
        }
        .data-sobre .d {
            font-size: 1.15rem;
            font-weight: 700;
            color: #1a3a5c;
            line-height: 1;
        }
        .data-sobre .m {
            font-size: 0.72rem;
            color: #5b6b7b;
        }
        /* ===== Próxima missa ===== */
        .prox-missa {
            background-color: #1a3a5c;
            color: #fff;
            border-radius: 12px;
            padding: 18px 22px;
        }
        .prox-missa .rotulo {
            font-size: 0.72rem;
            color: #f0d080;
            font-weight: 700;
            letter-spacing: 1.2px;
            text-transform: uppercase;
        }
        .prox-missa .valor {
            font-size: 1.7rem;
            font-weight: 700;
            line-height: 1.15;
            margin: 2px 0;
        }
        .prox-missa .detalhe {
            font-size: 0.85rem;
            color: #cdd9e6;
        }
        /* ===== Faixa da semana ===== */
        .dia-col {
            border: 1px solid #e3e8ee;
            border-radius: 9px;
            overflow: hidden;
            text-align: center;
            background-color: #fff;
            height: 100%;
        }
        .dia-col .cab {
            background-color: #eef2f6;
            font-size: 0.72rem;
            font-weight: 700;
            color: #1a3a5c;
            padding: 6px 0;
        }
        .dia-col.hoje .cab {
            background-color: #1a3a5c;
            color: #fff;
        }
        .dia-col.domingo .cab {
            background-color: #f0d080;
            color: #5c4409;
        }
        .dia-col .corpo {
            padding: 9px 4px;
            min-height: 56px;
        }
        .dia-col .hh {
            font-size: 0.88rem;
            font-weight: 700;
            color: #1a3a5c;
        }
        .dia-col .vazio {
            color: #b4bcc4;
            font-size: 0.8rem;
        }
        /* ===== Faixa de sacramentos ===== */
        .banner-sacr {
            background-color: #fff;
            border: 1px solid #e3e8ee;
            border-left: 4px solid #b8860b;
            border-radius: 11px;
            padding: 16px 20px;
        }
        .banner-sacr .ico {
            width: 46px;
            height: 46px;
            border-radius: 50%;
            background-color: #fdecc8;
            color: #8a5a00;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
            flex-shrink: 0;
        }
        /* ===== Passo a passo ===== */
        .passo {
            display: flex;
            gap: 12px;
            margin-bottom: 14px;
        }
        .passo .num {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background-color: #1a3a5c;
            color: #fff;
            font-weight: 700;
            font-size: 0.85rem;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid px-3 px-lg-4">
            <a class="navbar-brand me-3" href="{{ route('home') }}" title="Paróquia Nossa Senhora da Glória">
                <span class="navbar-brand-logo-wrap">
                    <img src="{{ asset('images/logoigreja.png') }}" alt="" class="navbar-brand-logo" aria-hidden="true">
                </span>
                <span class="navbar-brand-text">Paróquia N. S. da Glória</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">
                            <i class="bi bi-house"></i> Início
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('missas.index') }}">
                            <i class="bi bi-clock"></i> Missas
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('eventos.index') }}">
                            <i class="bi bi-calendar-event"></i> Eventos
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('grupos.index') }}">
                            <i class="bi bi-people"></i> Grupos
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('catequese') }}">
                            <i class="bi bi-book"></i> Catequese
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('sacramentos') }}">
                            <i class="bi bi-heart"></i> Sacramentos
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('avisos.index') }}">
                            <i class="bi bi-megaphone"></i> Avisos
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('sobre') }}">
                            <i class="bi bi-info-circle"></i> Sobre
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('contato') }}">
                            <i class="bi bi-envelope"></i> Contato
                        </a>
                    </li>
                    <li class="nav-item d-flex align-items-center ms-lg-2 my-2 my-lg-0">
                        <x-whatsapp-btn
                            mensagem="Olá, vim pelo site da paróquia e gostaria de falar com a secretaria."
                            rotulo="Secretaria"
                            classe="btn btn-sm btn-whats" />
                    </li>

                    @auth
                        @if(Auth::user()->is_admin)
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.index') }}">
                                <i class="bi bi-gear"></i> Admin
                            </a>
                        </li>
                        @endif
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                                <i class="bi bi-person-circle"></i> {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item">
                                            <i class="bi bi-box-arrow-right"></i> Sair
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">
                                <i class="bi bi-person"></i> Login
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('cadastro.form') }}">
                                <i class="bi bi-person-plus"></i> Cadastrar
                            </a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- Conteúdo principal -->
    <main>
        @yield('hero')

        <div class="container mt-4">
            @if(session('sucesso'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('sucesso') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session('erro'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('erro') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @yield('content')
        </div>
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row g-4">

                {{-- Identificação e redes sociais --}}
                <div class="col-lg-5">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <span class="footer-brand-logo">
                            <img src="{{ asset('images/logoigreja.png') }}" alt="" aria-hidden="true">
                        </span>
                        <div>
                            <strong class="text-white d-block">Paróquia Nossa Senhora da Glória</strong>
                            <small>Igreja Católica Ucraniana · Rito Bizantino</small>
                        </div>
                    </div>
                    <p class="small mb-3" style="max-width: 380px;">
                        Fundada em 1952 por imigrantes ucranianos, a paróquia mantém viva a tradição
                        religiosa e cultural da comunidade de Pitanga e região.
                    </p>
                    <div class="d-flex gap-2">
                        <a href="https://www.instagram.com/pnsg_1/" target="_blank" rel="noopener"
                           class="social-link" aria-label="Instagram da paróquia" title="Instagram">
                            <i class="bi bi-instagram"></i>
                        </a>
                        <a href="https://www.facebook.com/pnsgpitanga/?locale=pt_BR" target="_blank" rel="noopener"
                           class="social-link" aria-label="Facebook da paróquia" title="Facebook">
                            <i class="bi bi-facebook"></i>
                        </a>
                    </div>
                </div>

                {{-- Navegação --}}
                <div class="col-6 col-lg-3">
                    <h6>Navegação</h6>
                    <ul class="footer-links">
                        <li><a href="{{ route('home') }}">Início</a></li>
                        <li><a href="{{ route('missas.index') }}">Horários de Missas</a></li>
                        <li><a href="{{ route('eventos.index') }}">Eventos</a></li>
                        <li><a href="{{ route('grupos.index') }}">Grupos</a></li>
                        <li><a href="{{ route('avisos.index') }}">Avisos</a></li>
                        <li><a href="{{ route('sobre') }}">Sobre a Paróquia</a></li>
                    </ul>
                </div>

                {{-- Contato --}}
                <div class="col-6 col-lg-4">
                    <h6>Contato</h6>
                    <ul class="footer-info">
                        <li>
                            <i class="bi bi-geo-alt"></i>
                            <span>Caixa Postal, 10<br>85200-000, Pitanga, Paraná</span>
                        </li>
                        <li>
                            <i class="bi bi-telephone"></i>
                            <span>(42) 3746-1336</span>
                        </li>
                        <li>
                            <i class="bi bi-envelope"></i>
                            <a href="{{ route('contato') }}">Fale conosco</a>
                        </li>
                        <li>
                            <i class="bi bi-map"></i>
                            <a href="https://www.google.com/maps/dir/?api=1&destination=Par%C3%B3quia+Nossa+Senhora+da+Gl%C3%B3ria%2C+Pitanga+-+PR"
                               target="_blank" rel="noopener">Como chegar</a>
                        </li>
                    </ul>
                </div>

            </div>

            <div class="footer-bottom text-center">
                &copy; {{ date('Y') }} Paróquia Nossa Senhora da Glória · Pitanga/PR. Todos os direitos reservados.
            </div>
        </div>
    </footer>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
