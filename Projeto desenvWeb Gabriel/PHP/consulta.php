<?php
session_start();
if(!isset($_SESSION['id']) && ($_SESSION['id'] != '')){
    header("location: index.php");
    exit;
}

$host = "localhost";
$db = "web";
$user = "root";
$pass = "Sl152naa#";

$mysqli = new mysqli($host, $user, $pass, $db);
if ($mysqli->connect_errno) {
    die("Falha na conexão com o banco de dados");
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
    <h1>Seja bem-vindo à Área de Consulta de dados</h1>
    <form action="">
        <input name="busca" value="<?php if(isset($_GET['busca'])) echo $_GET['busca']; ?>" placeholder="Digite os termos de pesquisa" type="text">
        <button type="submit">Pesquisar</button>
    </form>
    <br>
    <table>
        <tr>
            <th>Id</th>
            <th>Paciente</th>
            <th>Médico</th>
            <th>Enfermeiro</th>
            <th>Hospital</th>
        </tr>
        <?php
        if (!isset($_GET['busca'])) {
            ?>
            <tr>
                <td colspan="5">Digite algo para pesquisar...</td>
            </tr>
            <?php
        } else {
            $pesquisa = $mysqli->real_escape_string($_GET['busca']);
            $sql_code = "SELECT
                c.idconsulta, 
                p.nome_paciente, 
                m.nome_medico,
                e.nome_enfermeiro,
                h.nome_hosp 
                FROM consulta as c right join paciente as p on c.cns = p.cns 
                inner join medico as m on c.crm = m.crm
                inner join enfermeiro as e on c.coren = e.coren 
                inner join hospital as h on c.codigo_hosp = h.codigo_hosp
                where idconsulta like '%$pesquisa%'";
            $sql_query = $mysqli->query($sql_code) or die("ERRO ao consultar! " . $mysqli->error);

            if ($sql_query->num_rows == 0) {
                ?>
                <tr>
                    <td colspan="5">Nenhum resultado encontrado...</td>
                </tr>
                <?php
            } else {
                while($dados = $sql_query->fetch_assoc()) {
                    ?>
                    <tr>
                        <td><?php echo $dados['idconsulta']; ?></td>
                        <td><?php echo $dados['nome_paciente']; ?></td>
                        <td><?php echo $dados['nome_medico']; ?></td>
                        <td><?php echo $dados['nome_enfermeiro']; ?></td>
                        <td><?php echo $dados['nome_hosp']; ?></td>
                    </tr>
                    <?php
                }
            }
            ?>
            <?php
        } ?>
    </table>
    <a href="areaPrivada.php"><strong>Clique aqui para voltar</strong></a>
</div>
</body>
</html>
