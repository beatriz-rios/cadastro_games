<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de produto</title>
    <link rel="stylesheet" href="/css/jogos.css">
   
</head>

<body>
    <h1>Cadastro de produto</h1>

    <ul>
        <li><a href="/jogos">Cadastro de Jogos</a></li>
        <li><a href="/acao">Ação</a></li>
        <li><a href="/menu">Tela Principal</a></li>
        <li><a href="/gestao">Racking</a></li>
    </ul>
    <form method="post">

        <label>Jogo:</label>
        <input type="text" name="game"><br><br>

        <label>Faixa de Preço:</label>
        <input type="number" name="preco"><br><br>

        <label>Plataforma Disponível:</label>
        <input type="text" name="plat"><br><br>

        <label>Categoria ou tipo de jogo:</label>
        <input type="text" name="catg"><br><br>

        <label>Faixa Etária:</label>
        <input type="text" name="idad"><br><br>

        <label>Data de Lançamento:</label>
        <input type="date" name="lanc"><br><br>

        <input type="submit" value="Cadastrar">

    </form>
    <?php

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $game  = $_POST['game'];
        $preco  = $_POST['preco'];
        $plat  = $_POST['plat'];
        $catg  = $_POST['catg'];
        $idad  = $_POST['idad'];
        $lanc  = $_POST['lanc'];


        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "gameplay";

        $conn = mysqli_connect($servername, $username, $password, $database);

        if (!$conn) {
            echo "<div message-error>falha de conexão" . mysqli_connect_error() . "</div>";
        }

        $sql = "INSERT INTO game(
    jogos,
    preco,
    plataforma,
    categoria,
    faixaetaria,
    lancamento
    )VALUE(
    '$game', 
    '$preco', 
    '$plat' ,
    '$catg' , 
    '$idad',
    '$lanc' 
    );";

        if (mysqli_query($conn, $sql)) {
            echo "<div message-sucess>Sucesso a cadastrar</div>";
        } else {
            echo "<div message-error>" . $sql . mysqli_error($conn) . "</div>";
        }
        mysqli_close($conn);
    }
    ?>
</body>

</html>
