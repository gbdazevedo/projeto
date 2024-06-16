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
<div id="form-cad">
    <h1>Cadastrar</h1>
    <form method="POST">
        <input type="text" placeholder="Nome Completo" maxlength="80" name="nome_paciente">
        <input type="number" placeholder="CNS" maxlength="15" name="cns">
        <input type="number" placeholder="Idade" maxlength="45" name="idade_paciente">
        <input type="text" placeholder="CRM do Médico" maxlength="11" name="crm">
        <input type="text" placeholder="Coren do Enfermeiro" maxlength="16" name="coren">
        <input type="text" placeholder="Período de internação" maxlength="45" name="data_consulta">
        <input type="number" placeholder="Código Hospital" name="hospitalcodigo" maxlength="45">
        <input type="submit" value="Cadastrar" id="cadastrar">
        <a href="areaPrivada.php"><strong>Clique aqui para voltar</strong></a>

    </form>
</div>

<?php

//phpinfo();

function paciente($nome_paciente, $cns, $idade_paciente, $crm, $coren, $data_consulta,$codigo_hosp)
{
    global $pdo;

    $sql = $pdo->prepare("SELECT cns FROM paciente WHERE cns = :cns");
    $sql->bindvalue(":cns", $cns);
    $sql->execute();

    if ($sql->rowCount() > 0) {
        return false;
    } else {
        $sql = $pdo->prepare("INSERT INTO paciente (nome_paciente,cns,idade_paciente) values (:np, :cns, :idadep)");
        $sql->bindValue(":np", $nome_paciente);
        $sql->bindValue(":cns", $cns);
        $sql->bindValue(":idadep", $idade_paciente);
        $sql->execute();
        $sql = $pdo->prepare("INSERT INTO consulta (cns,crm,coren,codigo_hosp,data_consulta) VALUES (:cns,:crm, :coren, :ch, :datac)");
        $sql->bindValue(":cns", $cns);
        $sql->bindValue(":crm", $crm);
        $sql->bindValue(":coren", $coren);
        $sql->bindValue(":ch", $codigo_hosp);
        $sql->bindValue(":datac", $data_consulta);
        $sql->execute();
        return true;
    }

}

function conectar($host, $nomeBD, $user, $senha)
{
    global $pdo;
    global $msg;

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$nomeBD",$user,$senha);
        $msg = "Connected successfully";

    } catch (PDOException $erro) {
        $msg = "Connection failed: " . $erro->getMessage();

    }
}

if (isset($_POST['nome_paciente'])) {
    $nome_paciente = addslashes($_POST['nome_paciente']);
    $cns = addslashes($_POST['cns']);
    $idade_paciente = addslashes($_POST['idade_paciente']);
    $crm  = addslashes($_POST['crm']);
    $coren =  addslashes($_POST['coren']);
    $data_consulta =  addslashes($_POST['data_consulta']);
    $codigo_hosp =  addslashes($_POST['hospitalcodigo']);

    if (!empty($nome_paciente)) {
        conectar("localhost","web","root","Sl152naa#");

        if (paciente($nome_paciente, $cns, $idade_paciente, $crm, $coren, $data_consulta,$codigo_hosp)) {
            ?>
            <div id="msg-sucesso">Usuário cadastrado com sucesso!</div>
            <?php
        } else {
            echo "Já cadastrado";
        }

    }
}
?>

</body>
</html>