<?php
//controlador agenda

function pegarContatinhos($nomeBuscado = null){

    $contatos = file_get_contents("contatinhos.json", true); // Lê o conteúdo de um arquivo para uma string.
    $contatos = json_decode($contatos, true); // Transforma o arquivo json em um array.

    if ($nomeBuscado != null) {

        $contatosEncontrados = [];

        foreach ($contatos as $contato){
            if ($contato['nome'] == $nomeBuscado){
                $contatosEncontrados[] = $contato;
            }
        }

        return $contatosEncontrados;

    } else {

        return $contatos;
    }
}

function cadastrar($nome,$email,$cellphone){ //$nome

    $contatos = pegarContatinhos();

    $contato = [ // interação arrays
        "id"       => uniqid(),
        "nome"     => $nome, //$nome
        "email"    => $email,
        "cellphone" => $cellphone
    ];

    array_push($contatos, $contato); // essa função adiciona as váriaveis já feitas no final do array como argumentos.

    $dados_json = json_encode($contatos, JSON_PRETTY_PRINT);//Formata os dados retornados com espaços em branco.

    file_put_contents("contatinhos.json", $dados_json); //Escreve uma string para um arquivo.
    header('Location: index.php'); //Envia um cabeçalho em HTTP.

}//fim cadastrar

function editarContatos($valorBuscado){

    $contatos = pegarContatinhos();

    foreach ($contatos as $contato){

        if ($contato['id'] == $valorBuscado) {
            return $contato;
        }
    }

    return null;
}

function editarBla($id, $nome,$email,$cellphone){

    $contatos = pegarContatinhos();

    $contatoEditato = [];

    foreach ($contatos as $contato){
       if  ($id == $contato['id']){
           $contatoEditato[] = [ // interação arrays
               "id"       => $id,
               "nome"     => $nome, //$nome
               "email"    => $email,
               "cellphone" => $cellphone
           ];
       } else {
           $contatoEditato[] = $contato;
       }
    }


    $dados_json = json_encode($contatoEditato, JSON_PRETTY_PRINT);//Formata os dados retornados com espaços em branco.

    file_put_contents("contatinhos.json", $dados_json); //Escreve uma string para um arquivo.

}

function excluirContato($idContato){

    $contatos = pegarContatinhos();

    foreach($contatos as $posicao => $contato){
        if($contato['id'] == $idContato){
            unset($contatos[$posicao]);
            break;
        }
    }

    $contatos = json_encode($contatos, JSON_PRETTY_PRINT);
    file_put_contents("contatinhos.json", $contatos);

    header('Location: index.php');

}

 //gerencionamento de rotas
if ($_GET['acao'] == 'cadastrar'){
    cadastrar($_POST['nome'], $_POST['email'], $_POST['cellphone']);
}elseif ($_GET['acao'] == 'excluir'){
    excluirContato($_GET['id']);
}elseif ($_GET['acao'] == 'editarContato'){
    editarBla($_GET['id'],$_POST['nome'], $_POST['email'], $_POST['cellphone']);
}