<?php
$db = mysqli_connect("localhost", "root", "", "gameplay");
$id = $_GET["id"];


$resulta = mysqli_query($db, "SELECT * FROM game WHERE idgame = $id");

$prod = mysqli_fetch_assoc($resulta);

if ($_POST) {
    $preco = $_POST['preco'];
    $platf = $_POST['plataforma'];


    mysqli_query($db, "UPDATE game SET preco = '$preco', plataforma='$platf' WHERE idgame = $id");
    header("location:gestao.php");
}

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edição de tabela</title>
    <link rel="stylesheet" href="../css/editar.css">

  
</head>

<body>
    <h1>Alteração de campo</h1>
   
    <p><u>Aqui você só esta autorizado a alterar ou o preço do jogo ou sua plataforma!</u></p>
     <ul>
        <li><a href="jogos.php">Cadastro de Jogos</a></li>
        <li><a href="acao.php">Ação</a></li>
        <li><a href="menu.php">Tela Principal</a></li>
        <li><a href="gestao.php">Racking</a></li>
    </ul>
    <form method="POST">
        <label>preço alterado:</label>
        <input type="text" name="preco" value=" <?= $prod['preco'] ?>">
        <input type="text" name="plataforma" value=" <?= $prod['plataforma'] ?>">
        <button>Salvar alteração</button>
    </form>
</body>

</html>