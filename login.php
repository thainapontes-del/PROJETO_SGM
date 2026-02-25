<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SGM - Login</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <style>
        :root {
            /* Cores extraídas da sua imagem */
            --primary-blue: #5578e0; /* Cor do botão 'Gerenciar' */
            --urgent-wine: #7d0022;  /* Cor do card 'Críticos' */
            --bg-gray: #f4f7fc;      /* Fundo suave da imagem */
            --text-blue: #4a6fdc;    /* Cor do título no dashboard */
        }

        body {
            background-color: var(--bg-gray);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
            margin: 0;
        }

        .login-container {
            width: 100%;
            max-width: 400px;
            padding: 20px;
        }

        .login-card {
            background: #ffffff;
            border-radius: 15px; /* Formato seguindo os botões da imagem */
            border: none;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05); /* Sombra leve como na foto */
            padding: 40px 30px;
        }

        .brand-title {
            color: var(--text-blue);
            font-weight: 700;
            font-size: 1.5rem;
            margin-bottom: 5px;
        }

        .access-subtitle {
            color: #6c757d;
            font-size: 0.9rem;
            margin-bottom: 30px;
        }

        /* Inputs modernos */
        .form-label {
            color: #495057;
            font-size: 0.85rem;
            margin-bottom: 8px;
        }

        .input-group {
            border-bottom: 2px solid #e9ecef;
            transition: all 0.3s ease;
        }

        .input-group:focus-within {
            border-bottom-color: var(--primary-blue);
        }

        .input-group-text {
            background: transparent;
            border: none;
            padding-left: 0;
            color: #adb5bd;
        }

        .form-control {
            border: none;
            background: transparent;
            padding: 12px 10px;
            font-size: 0.95rem;
        }

        .form-control:focus {
            box-shadow: none;
            background: transparent;
        }

        /* Botão seguindo o formato da foto */
        .btn-login {
            background-color: var(--primary-blue);
            border: none;
            border-radius: 10px; /* Arredondamento igual ao da foto */
            padding: 12px;
            font-weight: 600;
            color: white;
            transition: all 0.3s ease;
            margin-top: 15px;
        }

        .btn-login:hover {
            background-color: #4462c7;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(85, 120, 224, 0.3);
        }

        /* Destaque para erros (cor Vinho da foto) */
        #mensagem {
            color: var(--urgent-wine) !important;
            font-weight: 500;
            margin-top: 15px;
        }

        .logo-box {
            width: 60px;
            height: 60px;
            background-color: #f8f9fa;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            color: var(--primary-blue);
            font-size: 1.8rem;
        }
    </style>
</head>
<body>

    <div class="login-container">
        <div class="login-card shadow-sm">
            <div class="text-center">
                <div class="logo-box">
                    <i class="bi bi-person-badge"></i>
                </div>
                <h2 class="brand-title">SMG | Gestão</h2>
                <p class="access-subtitle">Portal Administrativo</p>
            </div>

            <form id="formLogin">
                <div class="mb-3">
                    <label class="form-label fw-bold">E-mail</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                        <input type="email" id="email" class="form-control" placeholder="seu@email.com" required>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-bold">Senha</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-lock"></i></span>
                        <input type="password" id="senha" class="form-control" placeholder="••••••••" required>
                    </div>
                </div>

                <button type="submit" class="btn btn-login w-100 shadow-sm">
                    Entrar no Sistema
                </button>

                <div id="mensagem" class="text-center small"></div>
            </form>
        </div>
    </div>

    <script src="assets/js/login.js"></script>

</body>
</html>