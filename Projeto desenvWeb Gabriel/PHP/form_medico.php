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
        <input type="text" placeholder="Nome Completo" maxlength="80" name="nomemedico">
        <input type="text" placeholder="CRM" maxlength="11" name="crm">
        <input type="text" placeholder="Especialidade" name="especialidade" maxlength="45" >
        <input type="text" placeholder="Nome Hospital" name="hospitalnome" maxlength="45">
        <input type="text" placeholder="Endereço Hospital" name="hospitalendereco" maxlength="45">
        <input type="number" placeholder="Código Hospital" name="hospitalcodigo" maxlength="45">
        <input type="submit" value="Cadastrar" id="cadastrar">
        <a href="areaPrivada.php"><strong>Clique aqui para voltar</strong></a>

    </form>
</div>

<?php

//phpinfo();

function medico($nome_medico, $crm, $espec_medico, $nome_hosp, $endereco_hosp, $codigo_hosp)
{
        global $pdo;

        $sql = $pdo->prepare("SELECT crm FROM medico WHERE crm = :crm");
        $sql->bindvalue(":crm", $crm);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            return false;
        } else {
            $sql = $pdo->prepare("INSERT INTO medico (nome_medico,crm,espec_medico) values (:nm, :crm, :em)");
            $sql->bindValue(":nm", $nome_medico);
            $sql->bindValue(":crm", $crm);
            $sql->bindValue(":em", $espec_medico);
            $sql->execute();
            $sql = $pdo->prepare("INSERT INTO hospital (nome_hosp,endereco_hosp,codigo_hosp) VALUES (:nh, :eh, :ch)");
            $sql->bindValue(":nh", $nome_hosp);
            $sql->bindValue(":eh", $endereco_hosp);
            $sql->bindValue(":ch", $codigo_hosp);
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

if (isset($_POST['nomemedico'])) {
        $nome_medico = addslashes($_POST['nomemedico']);
        $crm = addslashes($_POST['crm']);
        $espec_medico = addslashes($_POST['especialidade']);
        $nome_hosp  = addslashes($_POST['hospitalnome']);
        $endereco_hosp =  addslashes($_POST['hospitalendereco']);
        $codigo_hosp =  addslashes($_POST['hospitalcodigo']);

        if (!empty($nome_medico)) {
            conectar("localhost","web","root","Sl152naa#");

            if (medico($nome_medico, $crm, $espec_medico, $nome_hosp, $endereco_hosp, $codigo_hosp)) {
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