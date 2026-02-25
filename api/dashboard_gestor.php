<?php
session_start();
require_once '../config/database.php';
header('Content-Type: application/json');

if (!isset($_SESSION['user_id']) || $_SESSION['user_perfil'] !== 'gestor') {
    echo json_encode(["success" => false, "message" => "Acesso negado."]);
    exit;
}

$sql = "SELECT 
            c.id_chamado, 
            u.nome as solicitante, 
            a.nome as ambiente, 
            ts.nome as tipo_servico, 
            c.prioridade, 
            c.status 
        FROM chamados c 
        INNER JOIN usuarios u ON u.id_usuario = c.id_solicitante 
        INNER JOIN ambientes a ON c.id_ambiente = a.id_ambiente 
        INNER JOIN tipos_servico ts ON ts.id_tipo = c.id_tipo_servico"; 


$res = $conn->query($sql);


$dados = $res->fetch_all(MYSQLI_ASSOC);

echo json_encode($dados);