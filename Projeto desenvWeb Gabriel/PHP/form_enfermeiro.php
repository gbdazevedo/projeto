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
        <input type="text" placeholder="Nome Completo" maxlength="80" name="nome_enfermeiro">
        <input type="text" placeholder="Coren" maxlength="16" name="coren">
        <input type="text" placeholder="Cargo" name="cargo_enfermeiro" maxlength="45" >
        <input type="text" placeholder="Nome Hospital" name="hospitalnome" maxlength="45">
        <input type="text" placeholder="Endereço Hospital" name="hospitalendereco" maxlength="45">
        <input type="number" placeholder="Código Hospital" name="hospitalcodigo" maxlength="45">
        <input type="submit" value="Cadastrar" id="cadastrar">
        <a href="areaPrivada.php"><strong>Clique aqui para voltar</strong></a>

    </form>
</div>

<?php

//phpinfo();

function enfermeiro($nome_enfermeiro, $coren, $cargo_enfermeiro, $nome_hosp, $endereco_hosp, $codigo_hosp)
{
    global $pdo;

    $sql = $pdo->prepare("SELECT coren FROM enfermeiro WHERE coren = :coden");
    $sql->bindvalue(":coden", $coren);
    $sql->execute();

    if ($sql->rowCount() > 0) {
        return false;
    } else {
        $sql = $pdo->prepare("INSERT INTO enfermeiro (nome_enfermeiro,coren,cargo_enfermeiro) values (:ne, :coren, :cen)");
        $sql->bindValue(":ne", $nome_enfermeiro);
        $sql->bindValue(":coren", $coren);
        $sql->bindValue(":cen", $cargo_enfermeiro);
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

if (isset($_POST['nome_enfermeiro'])) {
    $nome_enfermeiro = addslashes($_POST['nome_enfermeiro']);
    $coren = addslashes($_POST['coren']);
    $cargo_enfermeiro = addslashes($_POST['cargo_enfermeiro']);
    $nome_hosp  = addslashes($_POST['hospitalnome']);
    $endereco_hosp =  addslashes($_POST['hospitalendereco']);
    $codigo_hosp =  addslashes($_POST['hospitalcodigo']);

    if (!empty($nome_enfermeiro)) {
        conectar("localhost","web","root","Sl152naa#");

        if (enfermeiro($nome_enfermeiro, $coren, $cargo_enfermeiro, $nome_hosp, $endereco_hosp, $codigo_hosp)) {
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