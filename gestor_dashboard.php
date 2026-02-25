<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SMG | Dashboard</title>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <style>
        :root {
            --bg-light: #f8f9fc;
            --accent-neutral: #6c757d;
            --accent-calm: #0dcaf0;
            --accent-urgent: #800020; /* Vinho */
        }

        body {
            background-color: var(--bg-light);
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
        }

        /* Navbar elegante */
        .navbar-custom {
            background: #ffffff;
            border-bottom: 1px solid #e3e6f0;
            padding: 1rem 0;
        }

        .navbar-brand {
            font-weight: 700;
            color: #4e73df !important;
            letter-spacing: -0.5px;
        }

        /* Cards Estilizados */
        .card-stat {
            border: none;
            border-radius: 12px;
            overflow: hidden;
            transition: all 0.3s cubic-bezier(.25,.8,.25,1);
            background: #fff;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.1);
        }

        .card-stat:hover {
            transform: translateY(-5px);
            box-shadow: 0 1rem 3rem rgba(0,0,0,0.1);
        }

        .card-stat .card-body {
            padding: 2rem 1.5rem;
            position: relative;
        }

        /* Indicadores de cores laterais */
        .border-neutral { border-left: 5px solid var(--accent-neutral) !important; }
        .border-calm { border-left: 5px solid var(--accent-calm) !important; }
        .border-urgent { border-left: 5px solid var(--accent-urgent) !important; }

        .stat-label {
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            font-weight: 700;
            margin-bottom: 5px;
            color: #858796;
        }

        .stat-value {
            font-size: 2rem;
            font-weight: 700;
            color: #5a5c69;
            margin: 0;
        }

        /* Customização para o card urgente (fundo vinho) */
        .card-urgent-main {
            background-color: var(--accent-urgent);
            color: white;
        }
        .card-urgent-main .stat-label, .card-urgent-main .stat-value {
            color: white;
        }

        /* Botões */
        .btn-modern {
            padding: 12px 25px;
            border-radius: 10px;
            font-weight: 600;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 10px;
        }

        .btn-primary-modern {
            background-color: #4e73df;
            border: none;
            color: white;
        }

        .btn-primary-modern:hover {
            background-color: #2e59d9;
            box-shadow: 0 4px 12px rgba(78, 115, 223, 0.3);
        }

        .logout-btn {
            color: #e74a3b;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>

    <header>
        <nav class="navbar navbar-custom">
            <div class="container d-flex justify-content-between align-items-center">
                <a class="navbar-brand" href="#"><i class="bi bi-cpu-fill"></i> SMG | Gestão Administrativa</a>
                <a href="api/logout.php" class="logout-btn">
                    <i class="bi bi-box-arrow-right"></i> Sair
                </a>
            </div>
        </nav>
    </header>

    <main class="mt-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card card-stat border-neutral">
                        <div class="card-body">
                            <div class="stat-label">Novas Solicitações</div>
                            <h2 class="stat-value">0</h2>
                            <i class="bi bi-plus-circle text-secondary position-absolute end-0 top-50 translate-middle-y me-4 opacity-25 fs-1"></i>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card card-stat border-calm">
                        <div class="card-body">
                            <div class="stat-label" style="color: var(--accent-calm)">Em Andamento</div>
                            <h2 class="stat-value">0</h2>
                            <i class="bi bi-clock-history position-absolute end-0 top-50 translate-middle-y me-4 opacity-25 fs-1" style="color: var(--accent-calm)"></i>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card card-stat card-urgent-main">
                        <div class="card-body">
                            <div class="stat-label">Críticos / Urgente</div>
                            <h2 class="stat-value">0</h2>
                            <i class="bi bi-exclamation-triangle position-absolute end-0 top-50 translate-middle-y me-4 opacity-50 fs-1 text-white"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-5 pt-4 justify-content-center">
                <div class="col-auto">
                    <a href="gestor_chamados.php" class="text-decoration-none">
                        <button class="btn btn-modern btn-primary-modern">
                            <i class="bi bi-list-stars fs-5"></i> Gerenciar Chamados
                        </button>
                    </a>
                </div>
                <div class="col-auto">
                    <button class="btn btn-modern btn-outline-secondary bg-white shadow-sm">
                        <i class="bi bi-geo-alt fs-5 text-primary"></i> Configurar Ambientes
                    </button>
                </div>
            </div>
        </div>
    </main>

   
</body>
</html>