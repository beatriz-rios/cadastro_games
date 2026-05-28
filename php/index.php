<?php
session_start();
if($_POST){
    $u = $_POST['u'];
    $s = $_POST['s'];

   if($u == 'Admin' ||   $u == 'Beatriz' && $s == '123'){
    $_SESSION['usuario'] = $u;
    header("location: menu.php");
   }else{
    echo"Erro no usuario ou senha!";
   }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <link rel="stylesheet" href="../css/index.css">
</head>
<body>
    <form method="post">
    <h1>Página de login</h1> 
    <label >Usuários:</label>
    <input type="text" name="u" required>
    <label >Senha:</label>
    <input type="password" name="s" required>
   <button>Entrar</button>
    </form>
</body>
</html>