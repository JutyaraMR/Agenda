<?php
require 'controlador_agenda.php';
$contato = editarContatos($_GET['id']);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>Document</title>
</head>
<body>

<form method="post" action="index.php?acao=editarContato&id=<?= $_GET['id'] ?>">
    <input name="nome"     type="text"  value="<?= $contato['nome']?>">
    <input name="email"    type="email" value="<?= $contato['email']?>">
    <input name="cellphone" type="text"  value="<?= $contato['cellphone']?>">

    <input type="submit" value="editar">
</form>

</body>
</html>