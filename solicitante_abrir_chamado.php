<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['user_perfil'] !== 'solicitante') {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SGM - Nova Solicitação</title>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <style>
        :root {
            --primary-blue: #5578e0; /* Cor do botão da foto */
            --soft-gray: #f4f7fc;    /* Fundo suave da foto */
            --text-dark: #4e73df;    /* Azul do título na foto */
            --urgent-wine: #7d0022;  /* Vinho do card crítico */
        }

        body {
            background-color: var(--soft-gray);
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
            color: #5a5c69;
        }

        /* Card Modernizado */
        .main-card {
            border: none;
            border-radius: 15px; /* Arredondamento da foto */
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.1);
            background: #ffffff;
            margin-top: 3rem;
        }

        .card-title-custom {
            color: var(--text-dark);
            font-weight: 700;
            letter-spacing: -0.5px;
        }

        /* Inputs Estilizados */
        .form-label {
            font-weight: 600;
            font-size: 0.85rem;
            color: #4e73df;
            text-transform: uppercase;
            margin-bottom: 8px;
        }

        .form-select, .form-control {
            border-radius: 10px;
            border: 1px solid #d1d3e2;
            padding: 12px;
            font-size: 0.95rem;
            transition: all 0.2s ease-in-out;
        }

        .form-select:focus, .form-control:focus {
            border-color: var(--primary-blue);
            box-shadow: 0 0 0 0.25rem rgba(85, 120, 224, 0.1);
        }

        /* Botão seguindo o formato da foto */
        .btn-submit {
            background-color: var(--primary-blue);
            border: none;
            border-radius: 10px;
            padding: 12px;
            font-weight: 600;
            color: white;
            transition: all 0.3s;
        }

        .btn-submit:hover {
            background-color: #4462c7;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(85, 120, 224, 0.3);
        }

        .btn-back {
            color: #858796;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.9rem;
            transition: 0.2s;
        }

        .btn-back:hover { color: var(--urgent-wine); }

        .form-icon { margin-right: 8px; color: var(--primary-blue); }
    </style>
</head>
<body>

    <div class="container mb-5">
        <div class="card main-card mx-auto shadow-sm" style="max-width: 650px;">
            <div class="card-body p-4 p-md-5">
                
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="card-title-custom mb-0">
                        <i class="bi bi-file-earmark-plus form-icon"></i>Abrir Chamado
                    </h3>
                    <a href="solicitante_dashboard.php" class="btn-back">
                        <i class="bi bi-arrow-left"></i> Voltar
                    </a>
                </div>

                <form id="formChamado">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Bloco / Setor</label>
                            <select id="selectBloco" class="form-select" required onchange="carregarAmbientes(this.value)">
                                <option value="">Selecione...</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Ambiente / Sala</label>
                            <select id="selectAmbiente" class="form-select" required disabled>
                                <option value="">Aguardando bloco...</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tipo de Manutenção</label>
                        <select id="selectTipo" class="form-select" required>
                            <option value="">Selecione a categoria...</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Descrição da Ocorrência</label>
                        <textarea id="descricao" class="form-control" rows="4" 
                                  required placeholder="Descreva o problema detalhadamente..."></textarea>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Anexar Foto (Opcional)</label>
                        <div class="input-group">
                            <input type="file" id="foto" class="form-control" accept="image/*">
                            <span class="input-group-text bg-white"><i class="bi bi-camera"></i></span>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-submit w-100 shadow-sm">
                        Registrar Solicitação
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Mantive sua lógica funcional, apenas adicionei um feedback visual no botão ao clicar
        async function iniciar() {
            const resB = await fetch('api/localizacoes.php?acao=listar_blocos');
            const blocos = await resB.json();
            const selB = document.getElementById('selectBloco');
            blocos.forEach(b => selB.innerHTML += `<option value="${b.id_bloco}">${b.nome}</option>`);

            const resT = await fetch('api/localizacoes.php?acao=listar_tipos');
            const tipos = await resT.json();
            const selT = document.getElementById('selectTipo');
            tipos.forEach(t => selT.innerHTML += `<option value="${t.id_tipo}">${t.nome}</option>`);
        }

        async function carregarAmbientes(id_bloco) {
            const selA = document.getElementById('selectAmbiente');
            if (!id_bloco) { selA.disabled = true; return; }
            
            const res = await fetch(`api/localizacoes.php?acao=listar_ambientes&id_bloco=${id_bloco}`);
            const ambientes = await res.json();
            
            selA.innerHTML = '<option value="">Selecione a Sala...</option>';
            ambientes.forEach(a => selA.innerHTML += `<option value="${a.id_ambiente}">${a.nome}</option>`);
            selA.disabled = false;
        }

        document.getElementById('formChamado').addEventListener('submit', async (e) => {
            e.preventDefault();
            const btn = e.target.querySelector('button[type="submit"]');
            btn.disabled = true;
            btn.innerHTML = '<span class="spinner-border spinner-border-sm"></span> Enviando...';

            const formData = new FormData();
            formData.append('id_ambiente', document.getElementById('selectAmbiente').value);
            formData.append('id_tipo', document.getElementById('selectTipo').value);
            formData.append('descricao', document.getElementById('descricao').value);
            const fotoFile = document.getElementById('foto').files[0];
            if (fotoFile) formData.append('foto', fotoFile);

            try {
                const response = await fetch('api/salvar_chamado.php', { method: 'POST', body: formData });
                const result = await response.json();
                if (result.success) {
                    window.location.href = 'solicitante_dashboard.php';
                } else {
                    alert("Erro: " + result.message);
                    btn.disabled = false;
                    btn.innerText = 'Registrar Solicitação';
                }
            } catch (err) {
                alert("Erro de conexão.");
                btn.disabled = false;
            }
        });

        iniciar();
    </script>
</body>
</html>