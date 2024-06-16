<?php
session_start();
if(!isset($_SESSION['id']) && ($_SESSION['id'] != '')){
    header("location: index.php");
    exit;
}
?>
<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Documento</title>
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>
    <div class="areaprivada">
        <h1>Seja bem-vindo à Área Privada!</h1>
        <h1>Formulário de cadastro de médicos: <a href="form_medico.php">clique aqui</a></h1>
        <h1>Formulário de cadastro de enfermeiros: <a href="form_enfermeiro.php">clique aqui</a></h1>
        <h1>Formulário de cadastro de paciente: <a href="form_paciente.php">clique aqui</a></h1>
        <h1>Consulta de dados <a href="consulta.php">clique aqui</a></h1>
        <a href="sair.php"><strong>Clique aqui para sair</strong></a>
    </div>
</body>
</html>
