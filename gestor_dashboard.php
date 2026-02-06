<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>
<body>
    <header>
        <nav class="navbar" style="background-color: hsla(0, 4%, 61%, 0.91);">
            <div class="container-fluid d-flex justify-content-between w-100">
                <a class="navbar-brand" style="color: hsla(0, 33%, 1%, 0.91);">SMG | Gestão Administrativa</a>
                  <a href="api/logout.php" class="text-white"> Sair </a> 
                </form>
            </div>
        </nav>
    </header>
    <main class="mt-5">
        <div class="container">
            <div class="row">
                <div class="col-sm-4 mb-3 mb-sm-0">
                    <div class="card" style="background-color:hsla(0, 24%, 13%, 0.91) ">
                    <div class="card-body">
                        <h5 class="card-title" style= "color:#ffffffe8;">Novas Solicitações</h5>
                        <h5  style= "color:#ffffffe8";> 0 </h5>
                    </div>
                    </div>
                </div>
                <div class="col-sm-4 mb-3 mb-sm-0">
                    <div class="card" style= "background-color:#67c764e8">
                    <div class="card-body">
                        <h5 class="card-title"  style= "color:#ffffffe8" ;>Em Andamento</h5>
                        <h5  style= "color:#ffffffe8" >0</h5>
                    </div>
                    </div>
                </div>
                <div class="col-sm-4 mb-3 mb-sm-0">
                    <div class="card" style="background-color:rgba(255, 103, 56, 0.91) " >
                    <div class="card-body">
                        <h5 class="card-title" style= "color:#ffffffe8"; >Críticos/Urgente</h5>
                        <h5 style= "color:#ffffffe8";>0</h5>
                    </div>
                    </div>
                </div>
                
                </div>
        </div>
</div>
<div class="row  p-4 d-flex justify-content-center">
    <button type="button" class="btn btn-secondary btn-lg col-4 m-5"><i class="bi bi-list"></i> Gerenciar os chamados</button>
    <button type="button" class="btn btn-ligth border-primary text-primary btn-lg col-3 m-5"><i class="bi bi-geo-alt"></i> Configurar os Ambientes</button>
</div>
</body>
</html>