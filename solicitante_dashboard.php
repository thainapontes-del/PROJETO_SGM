<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['user_perfil'] !== 'solicitante') {
    header("Location: login.php"); exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SGM - Meus Chamados</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <style>
        :root {
            --primary-blue: #5578e0;
            --urgent-wine: #7d0022;
            --soft-gray: #f8f9fc;
            --text-dark: #4e73df;
        }

        body {
            background-color: var(--soft-gray);
            font-family: 'Segoe UI', system-ui, sans-serif;
            color: #5a5c69;
        }

        /* Navbar seguindo o topo branco da foto */
        .navbar-custom {
            background: white;
            border-bottom: 1px solid #e3e6f0;
            padding: 1rem 0;
        }
        .navbar-brand {
            font-weight: 700;
            color: var(--text-dark) !important;
        }

        /* Títulos e botões */
        h2 { font-weight: 700; color: #333; }
        
        .btn-new {
            background-color: var(--primary-blue);
            border: none;
            border-radius: 10px;
            padding: 10px 20px;
            font-weight: 600;
            transition: all 0.3s;
        }
        .btn-new:hover {
            background-color: #4462c7;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(85, 120, 224, 0.3);
        }

        /* Card e Tabela */
        .main-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.1);
            background: white;
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

        .mini-thumb { 
            width: 45px; 
            height: 45px; 
            object-fit: cover; 
            cursor: pointer; 
            border-radius: 8px; 
            transition: transform 0.2s;
        }
        .mini-thumb:hover { transform: scale(1.1); }

        /* Badges de Status Personalizados */
        .badge-custom {
            padding: 6px 12px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.75rem;
        }
        .st-aberto { background: #eaecf4; color: #3a3b45; }
        .st-execucao { background: #f6c23e; color: white; }
        .st-concluido { background: #1cc88a; color: white; }
        .st-urgente { background: var(--urgent-wine); color: white; }

        .logout-link {
            color: #e74a3b;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-custom mb-4">
        <div class="container d-flex justify-content-between">
            <a class="navbar-brand" href="#">SMG | Meus Chamados</a>
            <div>
                <span class="me-3 small d-none d-sm-inline">Bem-vindo, <strong><?= $_SESSION['user_nome'] ?></strong></span>
                <a href="api/logout.php" class="logout-link"><i class="bi bi-box-arrow-right"></i> Sair</a>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Suas Solicitações</h2>
            <a href="solicitante_abrir_chamado.php" class="btn btn-primary btn-new shadow-sm">
                <i class="bi bi-plus-lg"></i> Novo Chamado
            </a>
        </div>

        <div class="card main-card">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th class="ps-4">ID</th>
                            <th>Mídia</th>
                            <th>Local / Ambiente</th>
                            <th>Descrição</th>
                            <th>Data</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody id="tabelaChamados">
                        </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalFoto" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg" style="border-radius: 20px; overflow: hidden;">
                <div class="modal-body p-0 bg-dark text-center">
                    <img src="" id="imgModal" class="img-fluid">
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-secondary rounded-pill px-4" data-bs-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function verFoto(url) {
            document.getElementById('imgModal').src = url;
            new bootstrap.Modal(document.getElementById('modalFoto')).show();
        }

        async function carregarChamados() {
            const lista = document.getElementById('tabelaChamados');
            lista.innerHTML = '<tr><td colspan="6" class="text-center py-5"><div class="spinner-border text-primary"></div></td></tr>';

            const chamados = await (await fetch('api/chamados.php')).json();
            const cores = { 
                'aberto': 'st-aberto', 
                'em_execucao': 'st-execucao', 
                'concluido': 'st-concluido',
                'urgente': 'st-urgente' 
            };

            const rowsHtml = await Promise.all(chamados.map(async c => {
                const anexos = await (await fetch(`api/anexos.php?id_chamado=${c.id_chamado}`)).json();
                const thumbHtml = anexos.length > 0 ? 
                    `<img src="${anexos[0].caminho_arquivo}" class="mini-thumb shadow-sm" onclick="verFoto('${anexos[0].caminho_arquivo}')">` : 
                    `<div class="bg-light d-flex align-items-center justify-content-center mini-thumb"><i class="bi bi-camera text-muted"></i></div>`;

                return `<tr>
                    <td class="ps-4 fw-bold">#${c.id_chamado}</td>
                    <td>${thumbHtml}</td>
                    <td>
                        <div class="fw-bold text-dark">${c.ambiente_nome}</div>
                        <small class="text-muted">${c.bloco_nome}</small>
                    </td>
                    <td class="text-truncate" style="max-width: 250px;">${c.descricao_problema}</td>
                    <td><i class="bi bi-calendar3 me-2"></i>${new Date(c.data_abertura).toLocaleDateString()}</td>
                    <td><span class="badge-custom ${cores[c.status] || 'st-aberto'}">${c.status.toUpperCase()}</span></td>
                </tr>`;
            }));

            lista.innerHTML = rowsHtml.join('');
        }
        carregarChamados();
    </script>
</body>
</html>