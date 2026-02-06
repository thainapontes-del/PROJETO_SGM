<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>
<body>
    <header>
        <nav class="navbar" style="background-color: rgba(0, 0, 0, 0.91);">
  <div class="container-fluid">
    <a class="navbar-brand" style="color: rgba(255, 250, 250, 0.91);">SMG | Admin</a>
    <div class="section">
        <ul class="nav justify-content-end">
         <a class="nav-link disabled" aria-disabled="true">Disabled</a>
  </li>
</ul>
</div>
      <a href="api/logout.php" class="text-white"> Sair
      </form>
  </div>
</nav>
 <main class="container p-4">
        <div class="d-flex justify-content-between">
            <h1 class="text-start fs-3" >Todos os Chamados</h1>
          <button type="button" class="btn btn-outline-secondary">Todos</button>
          <button type="button" class="btn btn-outline-primary">Abertos</button>
          <button type="button" class="btn btn-outline-warning">Em Execução</button>
          <button type="button" class="btn btn-outline-success">Concluídos</button>
        </div>
<table class="table p-4">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Solicitante</th>
      <th scope="col">Local/Tipo</th>
      <th scope="col">Prioridade</th>
     <th scope="col">Técnico</th>
    <th scope="col">Status</th>
    <th scope="col">Ações</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">#1</th>
      <td>Maria Solicitante</td>
      <td>Bloco adinistrativo - Recepção</td>
      <td>Alta</td>
      <td>João Técnico</td>
      <td><button type="button" class="btn btn-secondary btn-sm">FECHADO</button></td>
      <td><button type="button" class="btn btn-primary btn-sm">Gerenciar</button></td>
    </tr>
  </tbody>
</table>
    
    </main>
    </header>
</body>
</html>