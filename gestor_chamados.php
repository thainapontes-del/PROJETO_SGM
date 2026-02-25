<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['user_perfil'] !== 'gestor') {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SGM - Gestão de Chamados</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <style>
        :root {
            --bg-body: #f8f9fc;
            --primary-blue: #4e73df;
            --urgent-wine: #800020;
            --text-gray: #5a5c69;
        }

        body {
            background-color: var(--bg-body);
            font-family: 'Segoe UI', system-ui, sans-serif;
            color: var(--text-gray);
        }

        /* Navbar Moderna */
        .navbar-custom {
            background: #ffffff;
            border-bottom: 1px solid #e3e6f0;
            padding: 1rem 0;
        }
        .navbar-brand {
            font-weight: 700;
            color: var(--primary-blue) !important;
        }
        .nav-link {
            color: var(--text-gray) !important;
            font-weight: 500;
            transition: 0.3s;
        }
        .nav-link:hover, .nav-link.active {
            color: var(--primary-blue) !important;
        }

        /* Container de Tabela */
        .main-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.1);
            background: #fff;
            overflow: hidden;
        }

        .table thead th {
            background-color: #f8f9fc;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.05em;
            font-weight: 700;
            color: #858796;
            padding: 15px;
            border: none;
        }

        .table tbody td {
            padding: 15px;
            vertical-align: middle;
            border-bottom: 1px solid #f1f1f1;
        }

        /* Botões de Filtro Modernos */
        .btn-filter {
            border-radius: 20px;
            padding: 6px 20px;
            font-weight: 600;
            font-size: 0.85rem;
            border: 1px solid transparent;
            transition: all 0.3s;
        }

        .btn-check-filter:checked + .btn {
            background-color: var(--primary-blue);
            color: white;
            border-color: var(--primary-blue);
        }

        /* Badges e Status */
        .badge-status {
            padding: 6px 12px;
            border-radius: 8px;
            font-weight: 600;
        }

        .priority-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            display: inline-block;
            margin-right: 5px;
        }

        .bg-urgent { background-color: var(--urgent-wine); color: white; }
        .text-urgent { color: var(--urgent-wine); }
    </style>
</head>
<body>

    <header>
        <nav class="navbar navbar-expand-lg navbar-custom mb-5">
            <div class="container">
                <a class="navbar-brand" href="gestor_dashboard.php">
                    <i class="bi bi-cpu-fill me-2"></i>SGM ADMIN
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <div class="navbar-nav ms-auto align-items-center">
                        <a class="nav-link active me-3" href="gestor_chamados.php">Chamados</a>
                        <a class="nav-link me-3" href="gestor_locais.php">Locais</a>
                        <a href="api/logout.php" class="btn btn-sm btn-outline-danger px-3 rounded-pill">Sair</a>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <div class="container">
        <div class="d-flex justify-content-between align-items-end mb-4">
            <div>
                <h2 class="fw-bold text-dark mb-1">Central de Chamados</h2>
                <p class="text-muted mb-0">Gerencie e monitore todas as solicitações</p>
            </div>
            <div class="btn-group shadow-sm bg-white p-1 rounded-pill" role="group">
                <input type="radio" class="btn-check" name="filter" id="f_all" checked onclick="carregarChamados('')">
                <label class="btn btn-filter" for="f_all">Todos</label>

                <input type="radio" class="btn-check" name="filter" id="f_open" onclick="carregarChamados('aberto')">
                <label class="btn btn-filter" for="f_open">Abertos</label>

                <input type="radio" class="btn-check" name="filter" id="f_exec" onclick="carregarChamados('em_execucao')">
                <label class="btn btn-filter" for="f_exec">Em Execução</label>

                <input type="radio" class="btn-check" name="filter" id="f_done" onclick="carregarChamados('concluido')">
                <label class="btn btn-filter" for="f_done">Concluídos</label>
            </div>
        </div>

        <div class="card main-card">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Solicitante</th>
                            <th>Local / Ambiente</th>
                            <th>Prioridade</th>
                            <th>Técnico</th>
                            <th>Status</th>
                            <th class="text-center">Ações</th>
                        </tr>
                    </thead>
                    <tbody id="tabelaGeral">
                        </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        const coresPrioridade = { 
            'urgente': 'text-urgent', 
            'alta': 'text-danger', 
            'media': 'text-primary', 
            'baixa': 'text-secondary' 
        };

        const classesStatus = { 
            'aberto': 'bg-light text-dark border', 
            'em_execucao': 'bg-info text-white', 
            'concluido': 'bg-success text-white', 
            'fechado': 'bg-dark text-white' 
        };

        async function carregarChamados(status = '') {
            const body = document.getElementById('tabelaGeral');
            body.innerHTML = `<tr><td colspan="7" class="text-center py-5"><div class="spinner-border text-primary" role="status"></div></td></tr>`;
            
            try {
                const res = await fetch(`api/gestor_chamados.php?status=${status}`);
                const chamados = await res.json();

                body.innerHTML = chamados.map(c => `
                    <tr>
                        <td class="fw-bold text-primary">#${c.id_chamado}</td>
                        <td>
                            <div class="fw-bold text-dark">${c.solicitante_nome}</div>
                            <small class="text-muted">Solicitante</small>
                        </td>
                        <td>
                            <strong>${c.ambiente_nome}</strong><br>
                            <small class="badge bg-light text-muted border">${c.bloco_nome}</small>
                        </td>
                        <td class="fw-600 ${coresPrioridade[c.prioridade] || ''}">
                            <span class="priority-dot ${c.prioridade === 'urgente' ? 'bg-urgent' : 'bg-primary'}"></span>
                            ${c.prioridade.toUpperCase()}
                        </td>
                        <td>
                            ${c.tecnico_nome ? 
                                `<div class="d-flex align-items-center"><i class="bi bi-person-badge me-2"></i> ${c.tecnico_nome}</div>` : 
                                '<span class="text-muted small"><em>Aguardando Técnico</em></span>'}
                        </td>
                        <td>
                            <span class="badge badge-status ${classesStatus[c.status]}">
                                ${c.status.replace('_', ' ').toUpperCase()}
                            </span>
                        </td>
                        <td class="text-center">
                            <a href="gestor_detalhes.php?id=${c.id_chamado}" class="btn btn-sm btn-primary rounded-pill px-3 shadow-sm">
                                <i class="bi bi-gear-fill me-1"></i> Gerenciar
                            </a>
                        </td>
                    </tr>
                `).join('');
            } catch (error) {
                body.innerHTML = `<tr><td colspan="7" class="text-center text-danger py-4">Erro ao carregar dados.</td></tr>`;
            }
        }

        carregarChamados();
    </script>

  
</body>
</html>