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
    <div id="form-login">
        <h1>Entrar</h1>
        <form method="post">
            <input type="email" placeholder="Usuário" name="email" maxlength="40">
            <input type="password" placeholder="Senha" name="senha" maxlength="12">
            <input type="submit" value="Login" id="login">
            <a href="cadastrar.php">Ainda não é inscrito? <strong>Clique aqui</strong></a>
        </form>
    </div>
    <?php

        if (isset($_POST['email'])) {
            $email = addslashes($_POST['email']);
            $senha = addslashes($_POST['senha']);

            if (!empty($email)) {
                $u->conectar("localhost","web","root","Sl152naa#");

                   if ($u->logar($email, $senha)) {
                        header("location: areaPrivada.php");
                   } else {
                        ?>
                        <div class="msg-erro">Usuário não encotrado!</div>
                        <?php
                    }

            } else {
                ?>
                <div class="msg-erro">Preencha todos os campos!</div>
                <?php
            }
        }
    ?>
</body>
</html>