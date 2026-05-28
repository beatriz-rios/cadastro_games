<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de movimento</title>
    <link rel="stylesheet" href="/css/acao.css">
</head>

<body>
    <h1>Cadastro de movimento</h1>

    <ul>
        <li><a href="/jogos.php">Cadastro de Jogos</a></li>
        <li><a href="/acao.php">Ação</a></li>
        <li><a href="/menu.php">Tela Principal</a></li>
        <li><a href="/gestao.php">Racking</a></li>
    </ul>

    <form method="post">

        <label>ID do jogo:</label>
        <input type="number" name="jog"><br><br>

        <label>Ação::</label>
        <input type="text" name="mov" placeholder="entrada ou saida"><br><br>

        <label>Data da Ação:</label>
        <input type="date" name="ac"><br><br>

        <label>Nome do usuário que fez a Movimentação:</label>
        <input type="text" name="usr"><br><br>

        <label>Quantidade de Unidades/Cópias deste jogo:</label>
        <input type="text" name="quant"><br><br>

         <input type="submit" value="Cadastrar">

    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $jog  = $_POST['jog'];
        $mov  = $_POST['mov'];
        $ac  = $_POST['ac'];
        $usr  = $_POST['usr'];
        $quant  = $_POST['quant'];



        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "gameplay";

        $conn = mysqli_connect($servername, $username, $password, $database);

        if (!$conn) {
            echo "<div message-error>falha na conexão: " . mysqli_connect_error() . "</div>";
        }


        $sql = "INSERT INTO acao(
    game_idgame,
    mov,
    dat,
    usuario,
    quant
    )VALUE(
        '$jog',
        '$mov',
        '$ac',
        '$usr',
        '$quant' 
    );";


        if (mysqli_query($conn, $sql)) {
            echo "<div message-sucess: Cadastro feito com sucesso!</div>";
        } else {
            echo "<div message-error: " . $sql . mysqli_error($conn) . "</div>";
        }

        mysqli_close($conn);
    }
    ?>
</body>

</html>
