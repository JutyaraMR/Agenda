<?php

    session_start();

    function login(){

        $lista_usuarios = file_get_contents("usuario.json");
        $lista_convertida = json_decode($lista_usuarios, true);

        $login = $_POST['login'];
        $senha = $_POST['senha'];

        foreach ($lista_convertida as $usuario) {


            if ($login == $usuario['login'] && $senha == $usuario['senha']) {

                $_SESSION['nome'] = $usuario['nome'];
                $_SESSION['esta_logado'] = true;

                header("Location: index.php");

            }
        }
    }

    function logout(){
        //sair
        session_destroy();
        //redirecionar
        header("Location: login.php");
    }

    //ROTAS
    if ($_GET['acao'] == 'login'){
        login();
    }
    if ($_GET['acao'] == 'sair'){
        logout();
    }