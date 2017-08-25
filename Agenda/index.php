<?php

    require 'controlador_agenda.php';

    session_start();

    $existe = isset($_SESSION['esta_logado']);

    if ($existe == false){
        header("location: login.php");
    }

    $busca = null;

    if (isset($_GET['busca'])){
        $busca = $_GET['busca'];
    }

    $meusContatinhos = pegarContatinhos($busca);
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <title>Agenda</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Cherry+Swash|Nova+Square" rel="stylesheet">
    <link rel="stylesheet" href="flawless.css">

</head>
<body>
    
    <div class="container" style="margin-top: 30px;">
        <center>
            <h3 id="titulo">A agenda que você respeita</h3>
            <h4 id= "sub"> <i> #variaveisLivres </i>  </h4>
        </center>
        
        <br/>
        
        <div class="row">
            <div class="col-md-6">
                <form class="form-inline" method="get" action="busca" >
                    
                    <div class="form-group">
                        <label for="busca"></label>
                        <input name="busca" type="text" class="form-control" id="busca">
                    </div>
                    
                    <button type="submit" color="blue" class="btn btn-default" >BUSCAR</button>
                    
                    <a href="verifica_usuario.php?acao=sair" class="sair">sair</a>
                
                </form>
            </div>
        </div>
        
        <br/>

        <!-- CADASTRO-->
        <div class="row">
            <div class="col-md-12">
                <form class="form-inline" action="controlador_agenda.php?acao=cadastrar" method="post">

                <!--nome-->
                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input name="nome" type="text" class="form-control" id="nome">
                </div>

                <!--email-->
                <div class="form-group">
                    <label for="email">Email</label>
                    <input name="email" type="email" class="form-control" id="email">
                </div>

                <!--telefone-->
                <div class="form-group">
                    <label for="telefone">Telefone</label>
                    <input name="cellphone" type="text" class="form-control" id="cellphone">
                </div>

                <button type="submit" class="btn btn-default">CADASTRAR</button>

                </form>
            </div>
        </div>

        <br />

        <!--CONTATOS-->
        <div class="row">
            <div class="col-md-12">

                <!-- Conteúdo -->
                <table class="table">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Telefone</th>
                        <th>Açoes</th>
                    </tr>
                    </thead>
                    <tbody>
                    
                    <!-- repetir -->

                    <?php foreach ($meusContatinhos as $contato):?>
                    <tr>
                        <th><?= $contato[ 'id']?>                  </th>
                        <td><?= $contato[ 'nome']?>                </td>
                        <td><?= $contato[ 'email']?>               </td>
                        <td><?= $contato[ 'cellphone']?>           </td>
                        <td>
                            <a href="controlador_agenda.php?acao=excluir&id=<?= $contato['id']?>">excluir</a>
                            <a href="formulario_editar_contato.php?acao=editar&id=<?= $contato['id']?>">editar</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>