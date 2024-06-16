<?php
    require_once "classes/usuarios.php";
    $u = new Usuarios;
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
        <input type="text" placeholder="Nome Completo" maxlength="80" name="nome">
        <input type="text" placeholder="Telefone" maxlength="20" name="telefone">
        <input type="email" placeholder="Usuário" name="email" maxlength="30" >
        <input type="password" placeholder="Senha" name="senha" maxlength="6">
        <input type="password" placeholder="Confirmar Senha" maxlength="6">
        <input type="submit" value="Cadastrar" id="cadastrar">
        <a href="index.php"><strong>Clique aqui para voltar</strong></a>

    </form>
</div>

<?php

//phpinfo();

 if (isset($_POST['nome'])) {
    $nome = addslashes($_POST['nome']);
    $telefone = addslashes($_POST['telefone']);
    $email = addslashes($_POST['email']);
    $senha =  addslashes($_POST['senha']);

    if (!empty($nome)) {
        $u->conectar("localhost","web","root","Sl152naa#");

            if ($u->cadastrar($nome, $telefone, $email, $senha)) {
                ?>
                    <div id="msg-sucesso">Usuário cadastrado com sucesso!</div>
                <?php
            } else {
                echo "Email já cadastrado";
            }


    } else {
        echo "Preencha todos os campos!";
    }
}
?>

</body>
</html>
