<?php
$db = mysqli_connect("localhost", "root", "", "gameplay");
$id = $_GET["id"];

mysqli_query($db, "DELETE FROM acao WHERE game_idgame = $id");
mysqli_query($db, "DELETE FROM game WHERE idgame = $id");

header("location: /gestao");
?>
