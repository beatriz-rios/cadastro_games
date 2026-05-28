<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Central de Jogos</title>

    <link rel="stylesheet" href="/css/gestao.css">

</head>
<body>
    <h1>Central de Jogos</h1>
     <ul>
        <li><a href="/jogos.php">Cadastro de Jogos</a></li>
        <li><a href="/acao.php">Ação</a></li>
        <li><a href="/menu.php">Tela Principal</a></li>
        <li><a href="/gestao.php">Racking</a></li>
    </ul>



<?php 
//tabela game -> g , tabela acao -> a
 $sql = "SELECT
g.idgame,
g.jogos,
g.preco,
g.plataforma,
g.categoria,
g.faixaetaria,
g.lancamento,
a.usuario,
SUM(a.quant) as estoque_total
FROM game g
INNER JOIN acao a
ON g.idgame = a.game_idgame 
WHERE g.idgame
GROUP BY g.idgame,
g.jogos,
g.preco,
g.plataforma,
g.categoria,
g.faixaetaria,
g.lancamento,
a.usuario
ORDER BY g.jogos ASC;";

$servername = "localhost";
        $username = "root";
        $password = "";
        $database = "gameplay";

        $conn = mysqli_connect($servername, $username, $password, $database);


        echo"<table border='2'>";
        echo"<tr> <th>ID</th>
        <th>Jogos</th>
        <th>Preço</th>
        <th>Plataforma disponivel</th>
        <th>categoria</th>
        <th> faixa etária</th> 
        <th>Data de Lançamento</th>
        <th>usuario que cadastrou o jogo no sistema</th> 
        <th>Estoque</th>
        <th>Ações</th> </tr>";

    $resultado = mysqli_query($conn, $sql);
    
    if($resultado){
        while($row = mysqli_fetch_assoc($resultado)){
            echo"<tr>";
            echo "<td>" . $row['idgame'] . "</td>";
            echo "<td>" . $row['jogos'] . "</td>";
            echo "<td>" . $row['preco'] . "</td>";
            echo "<td>" . $row['plataforma'] . "</td>";
            echo "<td>" . $row['categoria'] . "</td>";
            echo "<td>" . $row['faixaetaria'] . "</td>";
            echo "<td>" . $row['lancamento'] . "</td>";
            echo "<td>" . $row['usuario'] . "</td>";
            echo "<td>" . $row['estoque_total'] . "</td>";
            echo"<td> <a href='/editar.php?id=" . $row['idgame']. "'>Editar</a>|
            <a href='/excluir.php?id=" . $row['idgame']. "'>Excluir </a> </td>";
            echo"</tr>";
        }
        
    }else{
        echo "<tr><td colspan='4'> message-error: " . $sql . mysqli_error($conn) . "</td></tr>";
    }
      echo "</table>";
?>
</body>
</html>
